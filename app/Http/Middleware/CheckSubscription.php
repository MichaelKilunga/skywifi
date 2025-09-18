<?php
// app/Http/Middleware/CheckSubscription.php
namespace App\Http\Middleware;

use Closure;
use App\Models\UserDevice;

class CheckSubscription
{
    public function handle($request, Closure $next) {
        $mac = $request->mac; // assume captured from router
        $device = UserDevice::where('mac_address', $mac)->first();

        if (!$device || !$device->subscriptions()->where('status', 'active')->where('end_time', '>', now())->exists()) {
            return redirect()->route('portal.index');
        }

        return $next($request);
    }
}
        