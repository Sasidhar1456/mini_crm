<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

use Illuminate\Support\Facades\Storage;

Route::get('/profile-picture/{filename}', function ($filename) {
    // Ensure the user is authenticated
    if (!auth()->check()) {
        abort(403); // Unauthorized
    }

    // Get the file from private storage
    $path = storage_path('app/private/profile_pictures/' . $filename);

    if (!file_exists($path)) {
        abort(404); // File not found
    }

    // Serve the file as a response
    return response()->file($path);
})->name('profile.picture');
// Redirect the root route to the login view
Route::get('/', function () {
    return view('login'); // Ensure 'login.blade.php' exists in resources/views
});

// Login routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Protect routes with auth middleware
Route::middleware(['auth'])->group(function () {
    Route::resource('companies', CompanyController::class);
    Route::resource('employees', EmployeeController::class);
});

// Logout route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
