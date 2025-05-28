<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\BuddyFeedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FeedbacksController extends Controller
{
    public function index()
    {
        if ( Auth::user()->role === 'admin') {
            $feedbacks = BuddyFeedback::all();
        } else {
            $feedbacks = BuddyFeedback::where('user_id', Auth::user()->id )->get();
        }
        return view('panel.feedbacks.index', compact('feedbacks'));
    }

    public function show($id)
    {
        return view('panel.feedbacks.show', ['id' => $id]);
    }

    public function create()
    {
        return view('panel.feedbacks.create');
    }

    public function edit($id)
    {
        return view('panel.feedbacks.edit', ['id' => $id]);
    }
}
