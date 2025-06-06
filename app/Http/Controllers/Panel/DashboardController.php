<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\BuddyRequest;
use App\Models\TravelerProfile;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $now = Carbon::now();

    // Admin user: show all traveler profiles and trips
    if (Auth::user()->role === 'admin') {
        $travelerProfiles = TravelerProfile::all(); // Plural, it's a collection
        $trips = Trip::all();

        $upcomingTrips = $trips->filter(function ($trip) use ($now) {
            return Carbon::parse($trip->start_date)->gt($now);
        });

        $ongoingTrips = $trips->filter(function ($trip) use ($now) {
            return $now->between($trip->start_date, $trip->end_date);
        });

        $pastTrips = $trips->filter(function ($trip) use ($now) {
            return Carbon::parse($trip->end_date)->lt($now);
        });

        $topDestinations = $trips->groupBy('destination_id')
            ->map(fn($group) => $group->count())
            ->sortDesc()
            ->take(3);

        $buddies = BuddyRequest::all();

        return view('panel.dashboard', compact(
            'travelerProfiles',
            'upcomingTrips',
            'ongoingTrips',
            'pastTrips',
            'topDestinations',
            'buddies'
        ));
    }

    // Regular user: show only their own data
    $travelerProfile = TravelerProfile::where('user_id', Auth::id())->first();

    if (!$travelerProfile) {
        return redirect()->route('traveler-profiles.create')->with('error', 'Please create a traveler profile first.');
    }

    $trips = Trip::where('traveler_id', $travelerProfile->id)->get();

    $upcomingTrips = $trips->filter(function ($trip) use ($now) {
        return Carbon::parse($trip->start_date)->gt($now);
    });

    $ongoingTrips = $trips->filter(function ($trip) use ($now) {
        return $now->between($trip->start_date, $trip->end_date);
    });

    $pastTrips = $trips->filter(function ($trip) use ($now) {
        return Carbon::parse($trip->end_date)->lt($now);
    });

    $topDestinations = $trips->groupBy('destination_id')
        ->map(fn($group) => $group->count())
        ->sortDesc()
        ->take(3);

    $buddies = BuddyRequest::where(function ($query) use ($travelerProfile) {
        $query->where('traveler_profile_id', $travelerProfile->id)
              ->orWhere('requester_id', Auth::id());
    })->get();

    return view('panel.dashboard', compact(
        'travelerProfile',
        'upcomingTrips',
        'ongoingTrips',
        'pastTrips',
        'topDestinations',
        'buddies'
    ));
}

}
