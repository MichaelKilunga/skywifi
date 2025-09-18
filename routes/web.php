<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\DeviceController;
use App\Models\InternetPlan;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LanguageController;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;


Route::get('/', function (Request $request) {
    // Get the raw loginurl string from request instance
    $loginurl = Request::instance()->loginurl;

    // Parse URL into components
    $parsedUrl = parse_url($loginurl);

    // Extract query part (the string after ?)
    $queryString = $parsedUrl['query'] ?? '';

    // Convert query string into an associative array
    parse_str($queryString, $params);

    // convert parameters to eloquent collection
    // $params = collect($params);


    // Fetch all internet plans from the database
    $plans = InternetPlan::all();

    // Example: dump results
    // dd($params);
    // dd($plans);

        session(['locale' => session('locale') ? session('locale'):'sw']);
        app()->setLocale(session('locale'));
    return view('index', [
        'params' => $params,
        'plans' => $plans
    ]);
})->name('index');

Route::get('/uam/login', function () {
    return "Portal login handler works!";
});


// routes/web.php
Route::get('/portal', [PortalController::class, 'index'])->name('portal.index');
Route::get('/portal/subscribe/{plan}', [SubscriptionController::class, 'subscribe'])->name('portal.subscribe');
Route::get('/portal/pay/{subscription}', [PaymentController::class, 'pay'])->name('portal.pay');
Route::post('/portal/payment/callback', [PaymentController::class, 'callback'])->name('portal.payment.callback');
Route::get('/portal/success', [PortalController::class, 'success'])->name('portal.success');


Route::post('/plans', [PortalController::class, 'store'])->name('plans.store');
Route::put('/plans/{plan}', [PortalController::class, 'edit'])->name('plans.edit');
Route::delete('/plans/{plan}', [PortalController::class, 'destroy'])->name('plans.destroy');
Route::get('/activate/{plan}', [PortalController::class, 'activate'])->name('portal.activate');

//verified no editing
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/devices', [DeviceController::class, 'index'])->name('admin.devices.index');
// block device
Route::post('/admin/devices/block/{device}', [DeviceController::class, 'block'])->name('admin.devices.block');  
Route::post('/admin/devices/unblock/{device}', [DeviceController::class, 'unblock'])->name('admin.devices.unblock');
// delete device
Route::delete('/admin/devices/{device}', [DeviceController::class, 'destroy'])->name('admin.devices.destroy');

// manually toggle subscription status
Route::post('/admin/subscriptions/toggle-status/{subscription}', [SubscriptionController::class, 'toggleStatus'])->name('admin.subscriptions.manually-toggle-status');
Route::get('/admin/subscriptions', [SubscriptionController::class, 'index'])->name('admin.subscriptions.index');

Route::get('/admin/plans', [PortalController::class, 'plans'])->name('admin.plans.index');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');



//payment
Route::post('/payments/checkout', [PaymentController::class, 'checkout']);
Route::get('/payments/checkout/{id}', [PaymentController::class, 'status']);
Route::get('/pay', [PaymentController::class, 'pay'])->name('pay');

// toggle locale 
Route::get('/locale/{locale}', [LanguageController::class, 'switch'])->name('locale.switch');

