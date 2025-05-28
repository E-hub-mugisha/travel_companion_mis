<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\BuddyRequest;
use App\Models\Destination;
use App\Models\TravelerProfile;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TripController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Default query for all trips with destinations
        $tripQuery = Trip::with('destination')->latest();

        // Role-based filtering
        if ($user->role === 'traveler') {
            $travelerProfile = TravelerProfile::where('user_id', $user->id)->first();

            if ($travelerProfile) {
                $trips = $tripQuery->get();
                $destinations = Destination::all();
                $existingBuddyRequests = $user
                    ? BuddyRequest::where('requester_id', $user->id)->pluck('trip_id')->toArray()
                    : [];
            } else {
                $trips = collect(); // empty collection if no profile
            }

            return view('panel.trips.index', compact('trips', 'existingBuddyRequests', 'destinations'));
        }

        // Admin sees all trips
        if ($user->role === 'admin') {
            $trips = $tripQuery->get();
            $destinations = Destination::all();
            $existingBuddyRequests = $user
                ? BuddyRequest::where('requester_id', $user->id)->pluck('trip_id')->toArray()
                : [];

            return view('panel.trips.index', compact('trips', 'destinations', 'existingBuddyRequests'));
        }
    }

    public  function myTrips()
    {
        $user = Auth::user();
        $travelerProfile = TravelerProfile::where('user_id', $user->id)->first();

        if ($travelerProfile) {
            $trips = Trip::with('destination')->where('traveler_id', $travelerProfile->id)->latest()->get();
            $destinations = Destination::all();
            $existingBuddyRequests = $user
                ? BuddyRequest::where('requester_id', $user->id)->pluck('trip_id')->toArray()
                : [];
            return view('panel.trips.index', compact('trips', 'existingBuddyRequests', 'destinations'));
        }

        return redirect()->back()->with('error', 'No trips found for your profile.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'destination_id' => 'required|exists:destinations,id',
            'image' => 'nullable|image',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'image/trips/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $tripImage = "$profileImage";
        }

        Trip::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'destination_id' => $request->destination_id,
            'image' => $tripImage,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('trips.index')->with('success', 'Trip created successfully.');
    }


    public function update(Request $request, Trip $trip)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'destination_id' => 'required|exists:destinations,id',
            'image' => 'nullable|image',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'image/trips/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $tripImage = "$profileImage";
        }

        $trip->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'destination_id' => $request->destination_id,
            'image' => $tripImage,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('trips.index')->with('success', 'Trip updated successfully.');
    }

    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('trips.index')->with('success', 'Trip deleted successfully.');
    }

    public function tripHistory()
    {
        if (Auth::user()->role === 'admin') {
            $trips = Trip::with('destination')->latest()->get();
            return view('panel.trips.history', compact('trips'));
        }
        if (Auth::user()->role === 'traveler') {
            $travelerProfile = \App\Models\TravelerProfile::where('user_id', Auth::user()->id)->first();
            if ($travelerProfile) {
                $trips = Trip::with('destination')->where('traveler_id', $travelerProfile->id)->latest()->get();
                return view('panel.trips.history', compact('trips'));
            }
        }
    }
}
