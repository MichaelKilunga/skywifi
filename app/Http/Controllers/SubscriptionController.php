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
            return response()->json(['status' => 'allow', 'time' => $activeSubscription->remaining_seconds]);
        }

        return response()->json(['status' => 'deny', 'time' => 0]);
    }

}
