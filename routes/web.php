<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\UserRegistrationController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\DemoBookingController;
use App\Http\Controllers\Admin\CourseEnrollmentController;
use App\Http\Controllers\Admin\TeamMemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/courses', [HomeController::class, 'courses'])->name('courses');
Route::get('/course/{id}', [HomeController::class, 'courseDetails'])->name('course.details');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/join', [HomeController::class, 'join'])->name('join');
Route::post('/join', [HomeController::class, 'joinSubmit'])->name('join.submit');
Route::get('/offers', [HomeController::class, 'offers'])->name('offers');
Route::get('/offer/{id}', [HomeController::class, 'offerDetails'])->name('offer.details');
Route::get('/team', [HomeController::class, 'team'])->name('team');
Route::get('/team/{id}', [HomeController::class, 'teamMember'])->name('team.member');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest admin routes (accessible when not authenticated)
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Protected admin routes (accessible when authenticated)
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        
        // Category Manager
        Route::resource('categories', CategoryController::class);
        
        // Course Manager
        Route::resource('courses', CourseController::class);
        
        // Gallery Manager
        Route::resource('galleries', GalleryController::class);
        
        // FAQ Manager
        Route::resource('faqs', FaqController::class);
        
        // User Registration Manager
        Route::resource('user-registrations', UserRegistrationController::class);
        
        // Testimonial Manager
        Route::resource('testimonials', TestimonialController::class);
        
        // Offer Manager
        Route::resource('offers', OfferController::class);
        
        // Demo Booking Manager
        Route::resource('demo-bookings', DemoBookingController::class);
        Route::patch('demo-bookings/{demoBooking}/status', [DemoBookingController::class, 'updateStatus'])->name('demo-bookings.update-status');
        
        // Course Enrollment Manager
        Route::resource('course-enrollments', CourseEnrollmentController::class);

        // Team Members Manager
        Route::resource('team', TeamMemberController::class);
    });
});
