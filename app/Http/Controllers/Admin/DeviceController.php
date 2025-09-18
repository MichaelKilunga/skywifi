<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDevice;
use Carbon\Carbon;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = UserDevice::with('subscriptions.plan')->latest()->paginate(25);
        return view('admin.devices.index', compact('devices'));
    }

    public function show(UserDevice $device)
    {
        $device->load('subscriptions.plan');
        return view('admin.devices.show', compact('device'));
    }

    public function destroy(UserDevice $device)
    {
        $device->delete();
        return redirect()->route('admin.devices.index')->with('success', 'Device removed.');
    }

    /**
     * Immediately expire all subscriptions for a device (useful to block access)
     */
    public function block(UserDevice $device)
    {
        $device->subscriptions()->update([
            'status' => 'expired',
            'end_time' => Carbon::now()
        ]);

        return redirect()->route('admin.devices.show', $device->id)->with('success', 'Device blocked (subscriptions expired).');
    }

    public function unblock(UserDevice $device)
    {
        $device->subscriptions()->update([
            'status' => 'active',
            'end_time' => null
        ]);

        return redirect()->back()->with('success', 'Device unblocked (subscriptions active).');
    }
}
