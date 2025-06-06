<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\TravelBuddyController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\DestinationController;
use App\Http\Controllers\Panel\TravelerProfileController;
use App\Http\Controllers\Panel\TripController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [HomeController::class, 'blogPost'])->name('blog.post');
Route::get('/destinations', [HomeController::class, 'destinations'])->name('destinations');
Route::get('/inkindi/trips', [HomeController::class, 'trips'])->name('inkindi.trips');
Route::get('/inkindi/trip/{slug}', [HomeController::class, 'tripDetails'])->name('inkindi.trips.details');
Route::get('/travel-buddies', [TravelBuddyController::class, 'index'])->name('travel-buddies.index');
Route::get('/traveler-profile/{id}', [HomeController::class, 'travelerProfile'])->name('traveler-profile');

Route::get('/find-buddies', [TravelBuddyController::class, 'findMatchesBuddy'])->name('find-buddies');
Route::get('/find-matches', [TravelBuddyController::class, 'findMatches'])->name('find.matches');

Route::post('/buddies/{buddy}/feedback', [TravelBuddyController::class, 'storeFeedback'])->name('buddy.feedback.store')->middleware('auth');

Route::post('/request-buddy/{tripId}', [TravelBuddyController::class, 'storeBuddyRequest'])->name('request.buddy')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/request-buddies', [TravelBuddyController::class, 'store'])->name('request-travelers.store');

    Route::resource('users', UserController::class);
    Route::resource('destinations', DestinationController::class);

    Route::resource('trips', TripController::class);
    Route::get('my-trips', [TripController::class, 'myTrips']);

    Route::get('traveler/profiles', [TravelerProfileController::class, 'index'])->name('traveler-profiles.index');
    Route::post('traveler_profiles', [TravelerProfileController::class, 'store'])->name('traveler-profiles.store');
    Route::put('traveler/profiles/{travelerProfile}', [TravelerProfileController::class, 'update'])->name('traveler-profiles.update');
    Route::delete('traveler/profiles/{travelerProfile}', [TravelerProfileController::class, 'destroy'])->name('traveler-profiles.destroy');
    Route::get('traveler/profiles/create', [TravelerProfileController::class, 'create'])->name('traveler-profiles.create');
    Route::get('traveler/profiles/{travelerProfile}/edit', [TravelerProfileController::class, 'edit'])->name('traveler-profiles.edit');
    Route::put('traveler/profiles/photo/{id}', [TravelerProfileController::class, 'profilePhoto'])->name('traveler-profiles.photo.store');

    Route::get('traveler/requests', [TravelerProfileController::class, 'buddyRequests'])->name('buddies.index.requests');
    Route::put('travel/buddies/status/{id}', [TravelerProfileController::class, 'buddyRequestUpdate'])->name('travel_buddies.update');

    Route::resource('blogs', BlogController::class);
    Route::get('feedbacks', [\App\Http\Controllers\Panel\FeedbacksController::class, 'index'])->name('panel.feedbacks.index');
    Route::get('feedbacks/{id}', [\App\Http\Controllers\Panel\FeedbacksController::class, 'show'])->name('panel.feedbacks.show');
    Route::get('feedbacks/create', [\App\Http\Controllers\Panel\FeedbacksController::class, 'create'])->name('panel.feedbacks.create');
    Route::get('feedbacks/{id}/edit', [\App\Http\Controllers\Panel\FeedbacksController::class, 'edit'])->name('panel.feedbacks.edit');
    Route::post('feedbacks', [\App\Http\Controllers\Panel\FeedbacksController::class, 'store'])->name('panel.feedbacks.store');
    Route::put('feedbacks/{id}', [\App\Http\Controllers\Panel\FeedbacksController::class, 'update'])->name('panel.feedbacks.update');
    Route::delete('feedbacks/{id}', [\App\Http\Controllers\Panel\FeedbacksController::class, 'destroy'])->name('panel.feedbacks.destroy');
    Route::get('feedbacks/{id}/approve', [\App\Http\Controllers\Panel\FeedbacksController::class, 'approve'])->name('panel.feedbacks.approve');
    Route::get('feedbacks/{id}/reject', [\App\Http\Controllers\Panel\FeedbacksController::class, 'reject'])->name('panel.feedbacks.reject');
});

require __DIR__ . '/auth.php';
