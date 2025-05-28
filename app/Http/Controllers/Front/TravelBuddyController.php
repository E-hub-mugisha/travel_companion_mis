<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BuddyFeedback;
use App\Models\BuddyRequest;
use App\Models\TravelBuddy;
use App\Models\TravelerProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TravelBuddyController extends Controller
{
    public function index()
    {
        $travelers = TravelerProfile::all();
        return view('front-page.buddies', compact('travelers'));
    }
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get(); // List all other users
        return view('travel_buddies.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'trip_id' => 'required|exists:trips,id',
        ]);
        // Check if the buddy request already exists
        if ($request->receiver_id == Auth::user()->id) {
            return redirect()->back()->with('error', 'You cannot send a request to yourself.');
        }
        $existingRequest = TravelBuddy::where('requester_id', Auth::id())
            ->where('receiver_id', $request->receiver_id)
            ->first();
        if ($existingRequest) {
            return redirect()->back()->with('error', 'Buddy request already sent.');
        }
        TravelBuddy::create([
            'requester_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'trip_id' => $request->trip_id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Buddy request sent!');
    }

    public function storeBuddyRequest(Request $request, $tripId)
    {
        $request->validate([
            'message' => 'required|string',
            'trip_id' => 'required|exists:trips,id',
            'receiver_id' => 'required|exists:users,id', // this assumes you're sending the ID of the trip owner
        ]);

        if ($request->receiver_id == Auth::id()) {
            return redirect()->back()->with('error', 'You cannot send a request to yourself.');
        }

        // Check if a buddy request already exists
        $existing = BuddyRequest::where('requester_id', Auth::id())
            ->where('receiver_id', $request->receiver_id)
            ->where('trip_id', $tripId)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Buddy request already sent.');
        }

        // Get requester's traveler profile
        $travelerProfile = TravelerProfile::where('user_id', Auth::id())->first();
        if (!$travelerProfile) {
            return redirect()->back()->with('error', 'You need a traveler profile to send a buddy request.');
        }

        // Create buddy request
        BuddyRequest::create([
            'requester_id' => Auth::id(),
            'trip_id' => $tripId,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Buddy request sent successfully!');
    }

    public function findMatches(Request $request)
    {
        $user = Auth::user();
        $searchTerm = $request->input('search'); // e.g., 'budget', 'adventure', etc.

        // Get the user's traveler profile
        $travelerProfile = TravelerProfile::where('user_id', $user->id)->first();
        if (!$travelerProfile) {
            return redirect()->back()->with('error', 'Please create a traveler profile first.');
        }

        $query = TravelerProfile::where('user_id', '!=', $user->id);

        // Optional: Match destination_id
        // if ($travelerProfile->destination_id) {
        //     $query->where('destination_id', $travelerProfile->destination_id);
        // }

        // Apply LIKE search across multiple columns
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('bio', 'LIKE', "%$searchTerm%")
                    ->orWhere('interests', 'LIKE', "%$searchTerm%")
                    ->orWhere('travel_preferences', 'LIKE', "%$searchTerm%")
                    ->orWhere('travel_budget', 'LIKE', "%$searchTerm%")
                    ->orWhere('travel_duration', 'LIKE', "%$searchTerm%")
                    ->orWhere('travel_companions', 'LIKE', "%$searchTerm%")
                    ->orWhere('travel_experience', 'LIKE', "%$searchTerm%")
                    ->orWhere('travel_style', 'LIKE', "%$searchTerm%")
                    ->orWhere('travel_photos', 'LIKE', "%$searchTerm%")
                    ->orWhereDate('start_date', '=', $searchTerm)
                    ->orWhereDate('end_date', '=', $searchTerm)
                    ->orWhere('price', 'LIKE', "%$searchTerm%");
            });
        }

        $travelers = $query->with('user')->get();

        return view('front-page.buddies', compact('travelers'));
    }

    public function findMatchesBuddy(Request $request)
    {
        $query = TravelerProfile::query();

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        if ($request->filled('interests')) {
            $query->where('interests', 'like', '%' . $request->interests . '%');
        }

        if ($request->filled('travel_budget')) {
            $query->where('travel_budget', $request->travel_budget);
        }

        if ($request->filled('travel_duration')) {
            $query->where('travel_duration', 'like', '%' . $request->travel_duration . '%');
        }

        if ($request->filled('travel_style')) {
            $query->where('travel_style', $request->travel_style);
        }

        $travelers = $query->with('user')->get();

        return view('front-page.buddies', compact('travelers'));
    }

    public function storeFeedback(Request $request, $buddyId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        BuddyFeedback::create([
            'buddy_id' => $buddyId,
            'user_id' => Auth::user()->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully.');
    }
}
