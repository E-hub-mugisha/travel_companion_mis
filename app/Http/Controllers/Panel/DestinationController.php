<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    //
    public function index()
    {
        // Fetch all destinations
        $destinations = Destination::all();
        return view('panel.destinations.index', compact('destinations'));
    }
    public function create()
    {
        return view('panel.destinations.create');
    }
    public function store(Request $request)
    {
        // Validate and store the destination
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:destinations',
            'country' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        // Store the destination logic here
        $destination = new Destination();
        $destination->name = $request->name;
        $destination->slug = str_replace(' ', '-', strtolower($request->name));
        $destination->country = $request->country;
        $destination->description = $request->description;
        
        if ($image = $request->file('image')) {
            $destinationPath = 'image/destinations/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $destination['image'] = "$profileImage";
        }
        $destination->save();

        return redirect()->route('destinations.index')->with('success', 'Destination created successfully.');
    }
    public function edit($id)
    {
        // Fetch the destination by ID
        $destination = Destination::findOrFail($id);
        return view('panel.destinations.edit', compact('destination'));
    }
    public function update(Request $request, $id)
    {
        // Validate and update the destination
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:destinations',
            'country' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        // Update the destination logic here
        $destination = Destination::findOrFail($id);
        $destination->name = $request->name;
        $destination->slug = str_replace(' ', '-', strtolower($request->name));
        $destination->country = $request->country;
        $destination->description = $request->description;
        
        if ($image = $request->file('image')) {
            $destinationPath = 'image/destinations/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $destination['image'] = "$profileImage";
        }
        $destination->save();

        return redirect()->route('destinations.index')->with('success', 'Destination updated successfully.');
    }
    public function destroy($id)
    {
        // Delete the destination logic here
        $destination = Destination::findOrFail($id);
        $destination->delete();

        return redirect()->route('destinations.index')->with('success', 'Destination deleted successfully.');
    }
}
