<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CourseContentController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\CoursePageController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.pages.course-page');
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
Route::get('/courses', [CoursePageController::class, 'index'])->name('courses.index');
Route::get('/course/{slug}', [CoursePageController::class, 'show'])->name('courses.show');

// Cart Routes
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('add-to-cart/{course}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove-from-cart');

// Payment routes
Route::get('checkout', CheckoutController::class)->name('checkout.index'); //Invokable controller

// Paypal
Route::get('paypal/payment',  [PaymentController::class, 'payWithPayPal'])->name('paypal.payment');
Route::get('paypal/success',  [PaymentController::class, 'payPalSuccess'])->name('paypal.success');
Route::get('paypal/cancel',  [PaymentController::class, 'payPalCancel'])->name('paypal.cancel');

// Stripe
Route::get('stripe/payment',  [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
Route::get('stripe/success',  [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
Route::get('stripe/cancel',  [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');

Route::get('order-success', [PaymentController::class, 'orderSuccess'])->name('order-success');
Route::get('order-failed', [PaymentController::class, 'orderFailed'])->name('order-failed');
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

    // Course Routes
    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('courses/create', [CourseController::class, 'storeBasicInfo'])->name('courses.store-basic-info');
    Route::get('courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::post('courses/update', [CourseController::class, 'update'])->name('courses.update');

    Route::get('course-content/{course}/create-chapter', [CourseContentController::class, 'createChapterModal'])->name('course-content.create-chapter');
    Route::post('course-content/{course}/create-chapter', [CourseContentController::class, 'storeChapter'])->name('course-content.store-chapter');
    Route::get('course-content/{chapter}/edit-chapter', [CourseContentController::class, 'editChapterModal'])->name('course-content.edit-chapter');
    Route::post('course-content/{chapter}/update-chapter', [CourseContentController::class, 'updateChapterModal'])->name('course-content.update-chapter');
    Route::delete('course-content/{chapter}/chapter', [CourseContentController::class, 'destroyChapter'])->name('course-content.destroy-chapter');

    Route::get('course-content/create-lesson', [CourseContentController::class, 'createLesson'])->name('course-content.create-lesson');
    Route::post('course-content/store-lesson', [CourseContentController::class, 'storeLesson'])->name('course-content.store-lesson');
    Route::get('course-content/edit-lesson', [CourseContentController::class, 'editLesson'])->name('course-content.edit-lesson');
    Route::post('course-content/{id}/update-lesson', [CourseContentController::class, 'updateLesson'])->name('course-content.update-lesson');
    Route::delete('course-content/{id}/destroy-lesson', [CourseContentController::class, 'destroyLesson'])->name('course-content.destroy-lesson');
    Route::post('course-content/{chapter}/sort-lesson', [CourseContentController::class, 'sortChapterLessons'])->name('course-content.sort-chapter');

    Route::get('course-content/{course}/sort-chapter', [CourseContentController::class, 'sortChapters'])->name('course-content.sort-chapter');
    Route::post('course-content/{course}/sort-chapter', [CourseContentController::class, 'updateSortChapter'])->name('course-content.update-sort-chapter');





    // Laravel File Manager (lfi) Routes
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
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
