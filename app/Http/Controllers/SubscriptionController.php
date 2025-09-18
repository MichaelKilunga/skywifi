<?php
// app/Http/Controllers/SubscriptionController.php
namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\UserDevice;
use App\Models\InternetPlan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request, $planId)
    {
        $plan = InternetPlan::findOrFail($planId);

        $device = UserDevice::firstOrCreate(
            ['mac_address' => $request->mac],
            ['device_name' => $request->device_name]
        );

        $subscription = $device->subscriptions()->create([
            'internet_plan_id' => $plan->id,
            'status' => 'pending'
        ]);

        // Redirect to payment page
        return redirect()->route('portal.pay', $subscription->id);
    }

    public function checkAuth(Request $request)
    {
        $mac = $request->mac;
        $client = UserDevice::where('mac_address', $mac)->first();        
        
        if (!$client) {
            return response()->json(['status' => 'deny', 'time' => 0]);
        }

        $activeSubscription = $client->subscriptions()->where('status', 'active')->first();

        if ($activeSubscription) {
            return response()->json(['status' => 'allow', 'time' => $activeSubscription->remainingTime()]);
        }

        return response()->json(['status' => 'deny', 'time' => 0]);
    }

    public function handleUserMacAction(Request $request, $username, $mac)
    {
        $action = $request->query('action');

        if ($action === 'authorize' || $action === 'authenticate') {
            return $this->checkAuth($request);
        }

        return response()->json(['error' => 'Invalid action'], 400);
    }

    public function handleUserSessionAction(Request $request, $username, $session_id)
    {
        $action = $request->query('action');

        if ($action === 'preacct' || $action === 'accounting') {
            // Handle pre-accounting or accounting logic here
            return response()->json(['status' => 'success']);
        }

        return response()->json(['error' => 'Invalid action'], 400);
    }

    public function handleUserMacPostAuthAction(Request $request, $username, $mac)
    {
        $action = $request->query('action');

        if ($action === 'post-auth') {
            // Handle post-auth logic here
            return response()->json(['status' => 'success']);
        }

        return response()->json(['error' => 'Invalid action'], 400);
    }

}
