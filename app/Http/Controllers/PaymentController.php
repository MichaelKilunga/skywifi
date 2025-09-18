<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\InternetPlan;
use App\Models\UserDevice;
use App\Models\Subscription;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\MpesaService;

class PaymentController extends Controller
{
    protected $mpesa;

    public function __construct(MpesaService $mpesa)
    {
        $this->mpesa = $mpesa;
    }

    public function checkout(Request $r)
    {
        try {
            DB::beginTransaction();
            $data = $r->validate([
                'plan_id'    => 'required|exists:internet_plans,id',
                'provider'   => 'required|string',
                'phone'      => 'required|string',
                'mac'        => 'required|string',
                'device_name' => 'nullable|string',
            ]);

            $plan = InternetPlan::findOrFail($data['plan_id']);

            $device = UserDevice::firstOrCreate(
                ['mac_address' => $data['mac']],
                ['device_name' => $data['device_name'] ?? null]
            );

            $subscription = Subscription::create([
                'user_device_id'    => $device->id,
                'internet_plan_id'  => $plan->id,
                'status'            => 'pending',
                'start_time'        => now(),
                'end_time'          => now()->addMinutes((int)$plan->duration_minutes),
            ]);

            // Ensure unique transaction ID
            $txn = null;
            do{
            $txn = Str::uuid()->toString();
            } while (Payment::where('transaction_id', $txn)->exists());

            $payment = Payment::create([
                'subscription_id'   => $subscription->id,
                'transaction_id'    => $txn,
                'amount'            => $plan->price,
                'phone'             => $data['phone'],
                'status'            => 'pending',
            ]);

            DB::commit();

            return response()->json([
                'success'     => true,
                'message'     => 'Payment initiated. Please wait for confirmation.',
                'checkout_id' => $txn
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Checkout error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Could not initiate payment: ' . $e->getMessage()
            ], 500);
        }
    }

    public function status($id, Request $request)
    {
        try {
            $payment = Payment::where('transaction_id', $id)->first();
            if (!$payment) {
                return response()->json(['success' => false, 'message' => 'Payment not found'], 404);
            }

            // If payment still pending (i.e. not yet initiated to the gateway),
            // then call pay() internally (or direct Vodacom C2B initiation) but without waiting for response
            if ($payment->status === 'pending') {
                // mark initiated so this doesn’t happen again
                $payment->update(['status' => 'initiated']);

                // Fire off request to payment gateway (Vodacom) asynchronously / non-blocking
                try {
                    $this->callMpesaC2B($payment);
                } catch (\Exception $e) {
                    Log::error("Mpesa initiation in status() error: " . $e->getMessage());
                    // we’ll still return current status; frontend will keep polling
                }
            }

            // Now check the gateway payment status (if it's initiated or beyond)
            // $currentStatus = $this->checkStatusFromMpesa($payment->transaction_id);
            $currentStatus = $this->checkStatusFromMpesa(new Request(['conversation_id' => $payment->transaction_id]));

            // If gateway returns successful or failed, update local DB
            if ($currentStatus === 'successful' && $payment->status !== 'successful') {
                $payment->update(['status' => 'successful']);
                $payment->subscription->update(['status' => 'active']);
                //update radius tables
                $this->radiusTables($payment, $payment->subscription);

            } elseif ($currentStatus === 'failed' && $payment->status !== 'failed') {
                $payment->update(['status' => 'failed']);
                $payment->subscription->update(['status' => 'cancelled']);
            }
            // else, leave as is (initiated or pending)

            $redir = ($payment->status === 'successful') ? url('/portal/success') : null;

            return response()->json([
                'success' => true,
                'status'  => $payment->status,
                'redir'   => $redir
            ]);
        } catch (\Exception $e) {
            Log::error("Status check error: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function pay(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric',
            'msisdn' => 'required|string|min:12',
            'reference' => 'required|string',
        ]);

        $payment = $this->mpesa->c2bPayment([
            'amount' => $request->amount,
            'msisdn' => $request->msisdn,
            'reference' => $request->reference,
            'description' => 'Invoice Payment',
        ]);

        return response()->json($payment);
    }

    public function checkStatusFromMpesa(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|string',
        ]);

        $status = $this->mpesa->checkTransactionStatus($request->conversation_id);

        return response()->json($status);
    }

    /**
     * Fire off C2B initiation without waiting
     */
    protected function callMpesaC2B(Payment $payment)
    {
        // Calling pay() internally but without waiting for response
        $this->pay(new Request([
            'reference' => $payment->transaction_id,
            'amount'    => $payment->amount,
            'msisdn'    => $payment->phone,
        ]));
    }

    public function radiusTables(Payment $payment, Subscription $subscription)
    {
        $user = $payment->subscription->device;
        $plan = $payment->subscription->plan;
        $generatedPassword = $payment->transaction_id; // or generate a random password

         // Insert into radius tables
        DB::table('radcheck')->insert([
            'username' => $user->mac_address, // or email, phone, etc.
            'attribute' => 'Cleartext-Password',
            'op' => ':=',
            'value' => $generatedPassword,
        ]);

        DB::table('radreply')->insert([
            'username' => $user->mac_address,
            'attribute' => 'Session-Timeout',
            'op' => ':=',
            'value' => $plan->duration_minutes*60, // in seconds
        ]);
    }
}
