<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InternetPlan;

class PlanController extends Controller
{
    // Optionally add middleware('auth') if you want to protect admin
    public function index()
    {
        $plans = InternetPlan::latest()->paginate(15);
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'speed_limit' => 'nullable|integer|min:0',
        ]);

        InternetPlan::create($data);

        return redirect()->route('admin.plans.index')->with('success', 'Plan created.');
    }

    public function edit(InternetPlan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, InternetPlan $plan)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'speed_limit' => 'nullable|integer|min:0',
        ]);

        $plan->update($data);

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated.');
    }

    public function destroy(InternetPlan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted.');
    }
}
