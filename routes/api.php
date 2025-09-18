<?php

use App\Http\Controllers\PortalController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/check-auth', [PortalController::class, 'checkAuth']);

// GET /api/user/{username}/mac/{mac}?action=authorize
// GET /api/user/{username}/mac/{mac}?action=authenticate
// POST /api/user/{username}/sessions/{session_id}?action=preacct
// POST /api/user/{username}/sessions/{session_id}?action=accounting
// POST /api/user/{username}/mac/{mac}?action=post-auth

Route::get('/user/{username}/mac/{mac}', [SubscriptionController::class, 'handleUserMacAction']);
Route::post('/user/{username}/sessions/{session_id}', [SubscriptionController::class, 'handleUserSessionAction']);
Route::post('/user/{username}/mac/{mac}', [SubscriptionController::class, 'handleUserMacPostAuthAction']);