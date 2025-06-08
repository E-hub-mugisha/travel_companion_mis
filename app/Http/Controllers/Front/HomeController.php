<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\TravelerProfile;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $travelers = TravelerProfile::inRandomOrder()->take(6)->get();
        $tours = Trip::with('destination')->inRandomOrder()->take(6)->get();
        $blogs = Blog::inRandomOrder()->take(6)->get();
        return view('front-page.home', compact('travelers', 'tours', 'blogs'));
    }

    public function about()
    {
        return view('front-page.about');
    }

    public function contact()
    {
        return view('front-page.contact');
    }
    public function destinations()
    {
        return view('front-page.destinations');
    }
    public function trips()
    {
        $trips = Trip::with('destination')->inRandomOrder()->take(6)->get();
        return view('front-page.trips', compact('trips'));
    }
    public function tripDetails($slug)
    {
        $trip = Trip::where('slug', $slug)->with(['destination', 'traveler'])->firstOrFail();
        return view('front-page.trip-details', compact('trip'));
    }
    public function travelerProfile($id)
    {
        $traveler = TravelerProfile::findOrFail($id);
        $today = Carbon::today();

        $upcomingTrips = $traveler->trips->filter(function ($trip) use ($today) {
            return Carbon::parse($trip->start_date)->gte($today);
        });

        $completedTrips = $traveler->trips->filter(function ($trip) use ($today) {
            return Carbon::parse($trip->end_date)->lt($today);
        });
        return view('front-page.traveler-profile', compact('traveler', 'upcomingTrips', 'completedTrips'));
    }
    public function blog()
    {
        $blogs = Blog::simplePaginate(6);
        return view('front-page.blog', compact('blogs'));
    }
    public function blogPost($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('front-page.blog-detail', compact('blog'));
    }
}
