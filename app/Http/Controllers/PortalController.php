<?php
// app/Http/Controllers/PortalController.php
namespace App\Http\Controllers;

use App\Models\InternetPlan;
use App\Models\UserDevice;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortalController extends Controller
{
    public function index()
    {
        $plans = InternetPlan::all();
        return view('portal.index', compact('plans'));
    }

    public function plans(Request $request)
    {
        $plans = InternetPlan::all();
        return view('admin.plans.plans', compact('plans'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'duration_minutes' => 'required|numeric',
            'speed_limit' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'required',
        ]);

        InternetPlan::create($request->all());

        return redirect()->back()->with('success', 'Plan added successfully!');
    }


    public function edit(Request $request, $id)
    {
        // dd($request->all());
        $plan = InternetPlan::find($id);
        // dd($plan);
        try{
            DB::beginTransaction(); 

        $request->validate([
            'name' => 'required',
            'duration_minutes' => 'required|numeric',
            'speed_limit' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'required',
        ]);

        $plan->update($request->all());

        DB::commit();
        return redirect()->back()->with('success', 'Plan updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('error', 'Error updating plan: ' . $e->getMessage());
        }
    }



    public function activate(InternetPlan $plan)
    {
        $plan->status = $plan->status == 'active' ? 'inactive' : 'active';
        $plan->save();

        return redirect()->back()->with('message', 'Plan ' . $plan->status == "active" ? 'activated' : 'deactivated' . ' successfully!');
    }

    public function success()
    {
        return view('portal.success');
    }

    public function destroy(InternetPlan $plan)
    {
        // dd($plan);
        $plan->delete();
        return redirect()->back()->with('success', 'Plan deleted successfully!');
    }
}
