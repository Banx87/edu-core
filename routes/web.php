<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
* -------------------------------------------------------------------------
* Frontend Routes
* -------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'index'])->name('home');

/*
* -------------------------------------------------------------------------
* Student Routes
* -------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:student'], 'prefix' => 'student', 'as' => 'student.'], function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/become-instructor', [StudentDashboardController::class, 'becomeInstructor'])->name('become-instructor');
});

/*
* -------------------------------------------------------------------------
* Instructor Routes
* -------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:instructor'], 'prefix' => 'instructor', 'as' => 'instructor.'], function () {
    Route::get('/dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');
});


// TESTING ----------------------------------------------------------------
// DATABASE JOINS TESTING ROUTES
// TESTING ----------------------------------------------------------------
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
