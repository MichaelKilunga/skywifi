<?php
Route::get('/check-auth', [PortalController::class, 'checkAuth']);

// GET /api/user/{username}/mac/{mac}?action=authorize
// GET /api/user/{username}/mac/{mac}?action=authenticate
// POST /api/user/{username}/sessions/{session_id}?action=preacct
// POST /api/user/{username}/sessions/{session_id}?action=accounting
// POST /api/user/{username}/mac/{mac}?action=post-auth