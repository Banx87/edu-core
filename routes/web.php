<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// If user is logged in, redirect to the dashboard
Route::get('/dashboard', function () {
    if (Auth::user()->role == 'student') {
        return redirect()->route('student.dashboard');
    } elseif (Auth::user()->role == 'instructor') {
        return redirect()->route('instructor.dashboard');
    }
    abort(404);
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
    Route::post('/become-instructor/{user}', [StudentDashboardController::class, 'becomeInstructorUpdate'])->name('become-instructor.update');

    // Profile Routes
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::post('profile/update-social', [ProfileController::class, 'updateSocial'])->name('profile.update-social');
});

/*
* -------------------------------------------------------------------------
* Instructor Routes
* -------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:instructor'], 'prefix' => 'instructor', 'as' => 'instructor.'], function () {
    Route::get('/dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('profile', [ProfileController::class, 'instructorIndex'])->name('profile.index');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::post('profile/update-social', [ProfileController::class, 'updateSocial'])->name('profile.update-social');
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