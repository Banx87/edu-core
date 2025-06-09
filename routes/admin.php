<?php

use App\Http\Controllers\Admin\AboutUsSectionController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\BecomeInstructorSectionController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandSectionController;
use App\Http\Controllers\Admin\CertificateBuilderController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseContentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseLanguageController;
use App\Http\Controllers\Admin\CourseLevelController;
use App\Http\Controllers\Admin\CourseSubCategoryController;
use App\Http\Controllers\Admin\CustomPageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\FeaturedInstructorController;
use App\Http\Controllers\Admin\FooterColumnOneController;
use App\Http\Controllers\Admin\FooterColumnTwoController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\InstructorRequestController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\PayoutGatewayController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\WithdrawRequestController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\LatestCourseSectionController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TopBarController;
use App\Http\Controllers\Admin\VideoSectionController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "guest:admin", "prefix" => "admin", "as" => "admin."], function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

// Admin routes
Route::group(["middleware" => "auth:admin", "prefix" => "admin", "as" => "admin."], function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // Instructor Request Routes
    Route::get('instructor-doc-download/{user}', [InstructorRequestController::class, 'downloadDoc'])->name('instructor-doc-download');
    Route::resource('instructor-request', InstructorRequestController::class);

    // Course Language Routes
    Route::resource('course-languages', CourseLanguageController::class);

    // Course Level Routes
    Route::resource('course-levels', CourseLevelController::class);

    // Course Categories Routes
    Route::resource('course-categories', CourseCategoryController::class);

    // Course SUB Categories Routes
    Route::get('{course_category}/sub-categories', [CourseSubCategoryController::class, 'index'])->name('course-sub-categories.index');
    Route::get('{course_category}/sub-categories/create', [CourseSubCategoryController::class, 'create'])->name('course-sub-categories.create');
    Route::get('{course_category}/sub-categories/{course_sub_category}/edit', [CourseSubCategoryController::class, 'edit'])->name('course-sub-categories.edit');
    Route::put('{course_category}/sub-categories/{course_sub_category}', [CourseSubCategoryController::class, 'update'])->name('course-sub-categories.update');
    Route::post('{course_category}/sub-categories', [CourseSubCategoryController::class, 'store'])->name('course-sub-categories.store');
    Route::delete('{course_category}/sub-categories/{course_sub_category}', [CourseSubCategoryController::class, 'destroy'])->name('course-sub-categories.destroy');

    // Course Module Routes
    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    Route::put('courses/{course}/update-approval', [CourseController::class, 'updateApproval'])->name('courses.update-approval');
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

    // Order Routes
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Payment Setting Routes
    Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
    Route::put('paypal-settings', [PaymentSettingController::class, 'paypalSettings'])->name('paypal-settings.update');
    Route::put('stripe-settings', [PaymentSettingController::class, 'stripeSettings'])->name('stripe-settings.update');
    Route::put('razorpay-settings', [PaymentSettingController::class, 'razorpaySettings'])->name('razorpay-settings.update');
    Route::put('nordea-settings', [PaymentSettingController::class, 'nordeaSettings'])->name('nordea-settings.update');

    //  Site Settings Routes
    Route::get('general-settings', [SettingsController::class, 'index'])->name('settings.general-settings');
    Route::post('general-settings', [SettingsController::class, 'updateGeneralSettings'])->name('general-settings.update');

    Route::get('commission', [SettingsController::class, 'CommissionIndex'])->name('settings.commissions.index');
    Route::post('commission', [SettingsController::class, 'updateCommission'])->name('settings.commissions.update');

    Route::get('smtp-settings', [SettingsController::class, 'smtpSetting'])->name('settings.smtp-settings');
    Route::post('smtp-settings', [SettingsController::class, 'updateSmtpSettings'])->name('smtp-settings.update');

    Route::get('logo-settings', [SettingsController::class, 'LogoSettingIndex'])->name('settings.logo.index');
    Route::post('logo-settings', [SettingsController::class, 'updateLogoSettings'])->name('settings.logo.update');

    // Payout Gateway Routes
    Route::resource('payout-gateway', PayoutGatewayController::class);

    // Withdraw Request Routes
    Route::get('withdraw-request', [WithdrawRequestController::class, 'index'])->name('withdraw-request.index');
    Route::get('withdraw-request/{withdrawal}/details', [WithdrawRequestController::class, 'show'])->name('withdraw-request.show');
    Route::post('withdraw-request/{withdrawal}/status', [WithdrawRequestController::class, 'updateStatus'])->name('withdraw-request.status.update');

    // Certificate Builder Routes
    Route::get('certificate-builder', [CertificateBuilderController::class, 'index'])->name('certificate-builder.index');
    Route::post('certificate-builder', [CertificateBuilderController::class, 'update'])->name('certificate-builder.update');
    Route::post('certificate-item-position', [CertificateBuilderController::class, 'itemPositionUpdate'])->name('certificate-item-position.update');

    /* HERO ROUTES */
    Route::resource('hero', HeroController::class);

    /* FEATURE ROUTES */
    Route::resource('feature', FeatureController::class);

    /* FEATURE ROUTES */
    Route::resource('about-section', AboutUsSectionController::class);

    /* LATEST COURSES ROUTES */
    Route::resource('latest-courses-section', LatestCourseSectionController::class);

    /* BECOME INSTRUCTOR ROUTES */
    Route::resource('become-instructor-section', BecomeInstructorSectionController::class);

    /* VIDEO SECTION ROUTES */
    Route::resource('video-section', VideoSectionController::class);

    /* BRAND SECTION ROUTES */
    Route::resource('brand-section', BrandSectionController::class);

    /* FEATURED INSTRUCTOR SECTION ROUTES */
    Route::get('get-instructor-courses/{id}', [FeaturedInstructorController::class, 'getInstructorCourses'])->name('get-instructor-courses');
    Route::resource('featured-instructor-section', FeaturedInstructorController::class);

    /* TESTIMONIAL SECTION ROUTES */
    Route::resource('testimonial-section', TestimonialController::class);

    /* ABOUT COUNTER SECTION ROUTES */
    Route::resource('counter-section', CounterController::class);

    /* CONTACT ROUTES */
    Route::resource('contact', ContactController::class);

    /* CONTACT SETTING ROUTES */
    Route::resource('contact-setting', ContactSettingController::class);

    /* REVIEW ROUTES */
    Route::resource('reviews', ReviewController::class);

    /* TOP BAR ROUTES */
    Route::resource('top-bar', TopBarController::class);

    /* FOOTER ROUTES */
    Route::resource('footer', FooterController::class);
    Route::resource('footer-column-one', FooterColumnOneController::class);
    Route::resource('footer-column-two', FooterColumnTwoController::class);

    /* BLOG ROUTES */
    Route::resource('blog-categories', BlogCategoryController::class);
    Route::resource('blogs', BlogController::class);

    /* SOCIAL LINKS ROUTES */
    Route::resource('social-links', SocialLinkController::class);

    /* CUSTOM PAGE ROUTES */
    Route::resource('custom-page', CustomPageController::class);




    // Laravel File Manager (lfm) Routes
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth:admin']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
