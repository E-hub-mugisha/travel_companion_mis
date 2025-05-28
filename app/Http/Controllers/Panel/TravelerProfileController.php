<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\BuddyRequest;
use App\Models\Destination;
use App\Models\TravelBuddy;
use App\Models\TravelerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TravelerProfileController extends Controller
{
    public function index()
    {
        $profiles = TravelerProfile::with('destination')->latest()->get();
        $destinations = Destination::all();
        return view('panel.profile.index', compact('profiles', 'destinations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'bio' => 'nullable|string',
            'interests' => 'nullable|string',
            'destination_id' => 'required|exists:destinations,id',
            'travel_preferences' => 'nullable|string',
            'travel_budget' => 'nullable|string',
            'travel_duration' => 'nullable|string',
            'travel_companions' => 'nullable|string',
            'travel_experience' => 'nullable|string',
            'travel_style' => 'required|in:budget,adventure,luxury',
            'travel_photos' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'price' => 'nullable|string',
        ]);

        TravelerProfile::create($data);
        return redirect()->back()->with('success', 'Traveler Profile added successfully!');
    }

    public function update(Request $request, TravelerProfile $travelerProfile)
    {
        $data = $request->all();
        $travelerProfile->update($data);
        return redirect()->back()->with('success', 'Traveler Profile updated!');
    }

    public function destroy(TravelerProfile $travelerProfile)
    {
        $travelerProfile->delete();
        return redirect()->back()->with('success', 'Profile deleted!');
    }
    public function buddyRequests()
    {

        if (Auth::user()->role === 'admin') {
            $buddies = BuddyRequest::all();
        } else {
            $travelerProfile = TravelerProfile::where('user_id', Auth::user()->id)->first();

            if ($travelerProfile) {
                $buddies = BuddyRequest::where(function ($query) use ($travelerProfile) {
                    $query->where('receiver_id', $travelerProfile->id)
                        ->orWhere('requester_id', Auth::user()->id );
                })->with(['requester', 'receiver', 'trip'])->latest()->get();
            }
        }

        return view('panel.buddies.requests', compact('buddies'));
    }
    public function buddyRequestUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'in:accepted,rejected'
        ]);

        $buddy = BuddyRequest::findOrFail($id);
        $buddy->status = $request->status;
        $buddy->save();

        return redirect()->back()->with('success', 'Travel buddy request updated.');
    }
    public function profilePhoto(Request $request, $id)
    {
        $request->validate([
            'travel_photos' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $profilePhoto = TravelerProfile::find($id);
        if ($travel_photos = $request->file('travel_photos')) {
            $destinationPath = 'image/travel_photos/';
            $profileImage = date('YmdHis') . "." . $travel_photos->getClientOriginalExtension();
            $travel_photos->move($destinationPath, $profileImage);
            $profilePhoto['travel_photos'] = "$profileImage";
            $profilePhoto->save();
        }
        return redirect()->back()->with('success', 'Profile photo updated successfully!');
    }
}
