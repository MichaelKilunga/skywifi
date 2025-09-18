<?php

namespace App\Http\Controllers;

use App\Models\InternetPlan;
use App\Models\Subscription;
use App\Models\UserDevice;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //implement all logics for auth, login and logout here

    public function index()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        // count devices
        $devices = UserDevice::count();
        $activeDevices = UserDevice::with('subscriptions', function($query) {
            $query->where('status', 'active');
        })->count();
        // active plans
        $activePlans = InternetPlan::where('status', 'active')->count();
        // active subscriptions
        $activeSubscriptions = Subscription::where('status', 'active')->count();
        // inactive subscriptions
        $subscriptions = Subscription::count();
        return view('admin.index', compact('devices', 'activeDevices', 'activePlans', 'activeSubscriptions', 'subscriptions'));
    }

    public function logout()
    {
        // auth()->logout();
        return redirect()->route('index');
    }
}
