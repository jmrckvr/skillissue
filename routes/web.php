<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\Employer\CompanyController;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Employer\TeamMemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Forum\ThreadController;
use App\Http\Controllers\Forum\CommentController;
use App\Http\Controllers\Forum\ReactionController;
use App\Http\Controllers\Auth\{RegisterController, LoginController, ForgotPasswordController, ResetPasswordController, VerificationController};

// All Listings
Route::get('/', function () {
    return view('listings', [
        'heading' => 'Latest Listings',
        'listings' => Listing::all()
    ]);
});

// Single Listing
Route::get('/listings/{id}', function ($id) {
    return view('listing', [
        'listing' => Listing::find($id)
    ]);
});

// Auth routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Email verification
Route::get('/email/verify', [VerificationController::class, 'notice'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');

// Password reset
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Admin routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('users', AdminUserController::class);
    Route::resource('jobs', AdminJobController::class)->only(['index', 'edit', 'update', 'destroy']);
});

// Employer routes
Route::middleware(['auth', 'verified', 'role:employer'])->prefix('employer')->group(function () {
    Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('employer.dashboard');
    Route::resource('companies', CompanyController::class);
    Route::resource('jobs', JobController::class);
    Route::resource('team-members', TeamMemberController::class);
});

// Applicant routes
Route::middleware(['auth', 'verified', 'role:applicant'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('jobs.apply');
});

// Forum routes
Route::middleware(['auth', 'verified'])->prefix('forum')->group(function () {
    Route::resource('threads', ThreadController::class);
    Route::resource('threads.comments', CommentController::class)->shallow();
    Route::post('reactions/toggle', [ReactionController::class, 'toggle'])->name('forum.reactions.toggle');
    Route::delete('threads/{thread}', [ThreadController::class, 'destroy'])
        ->middleware('can:moderate-forum')
        ->name('forum.threads.destroy');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])
        ->middleware('can:moderate-forum')
        ->name('forum.comments.destroy');
});
