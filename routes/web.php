<?php

use App\Http\Controllers\Frontend\InstructorDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
* -------------------------------------------------------------------------
* Student Routes
* -------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:student'], 'prefix' => 'student', 'as' => 'student.'], function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

/*
* -------------------------------------------------------------------------
* Instructor Routes
* -------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:instructor'], 'prefix' => 'instructor', 'as' => 'instructor.'], function () {
    Route::get('/dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');
});


// Admin routes
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');


// DATABASE JOINS TESTING ROUTES
use Illuminate\Support\Facades\DB;

Route::get('/join', function () {
    // INNER JOIN
    $usersWithOrders = DB::table('users')
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->select('users.name', 'orders.product_name', 'orders.total_price')
        ->get();

    dd($usersWithOrders);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';