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
        // Check if the user is an admin
        if (Auth::user()->role === 'admin') {
            $travelerProfile = TravelerProfile::all();


            $now = Carbon::now();

            $trips = Trip::all();

            $upcomingTrips = $trips->filter(fn($trip) => Carbon::parse($trip->start_date)->gt($now));
            $ongoingTrips = $trips->filter(fn($trip) => $now->between($trip->start_date, $trip->end_date));
            $pastTrips = $trips->filter(fn($trip) => Carbon::parse($trip->end_date)->lt($now));

            $topDestinations = $trips->groupBy('destination_id')
                ->map(fn($group) => $group->count())
                ->sortDesc()
                ->take(3);

            $buddies = BuddyRequest::all();
        }
        // If the user is not an admin, get their own trips and buddies
        else {
            $travelerProfile = TravelerProfile::where('user_id', Auth::id())->first();

            if (!$travelerProfile) {
                return redirect()->route('traveler-profiles.create')->with('error', 'Please create a traveler profile first.');
            }

            $now = Carbon::now();

            $trips = Trip::where('traveler_id', $travelerProfile->id)->get();

            $upcomingTrips = $trips->filter(fn($trip) => Carbon::parse($trip->start_date)->gt($now));
            $ongoingTrips = $trips->filter(fn($trip) => $now->between($trip->start_date, $trip->end_date));
            $pastTrips = $trips->filter(fn($trip) => Carbon::parse($trip->end_date)->lt($now));

            $topDestinations = $trips->groupBy('destination_id')
                ->map(fn($group) => $group->count())
                ->sortDesc()
                ->take(3);

            $buddies = BuddyRequest::where(function ($query) use ($travelerProfile) {
                $query->where('receiver_id', $travelerProfile->id)
                    ->orWhere('requester_id', Auth::id());
            })->get();
        }
    

        return view('panel.dashboard', compact(
            'upcomingTrips',
            'ongoingTrips',
            'pastTrips',
            'topDestinations',
            'buddies',
            'travelerProfile',
        ));
    }
}
