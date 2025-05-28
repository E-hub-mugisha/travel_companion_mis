@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Trip History Management</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTripModal">Add Trip History</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Traveler</th>
                <th>Destination</th>
                <th>Status</th>
                <th>Dates</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trips as $trip)
            
            <tr>
                <td>{{ $trip->title }}</td>
                <td>{{ $trip->traveler->user->name ?? 'N/A' }}</td>
                <td>{{ $trip->destination->name ?? 'N/A' }}</td>
                <td>{{ $trip->status }}</td>
                <td>{{ $trip->start_date }} - {{ $trip->end_date }}</td>
                <td>
                    @auth
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#showModal{{ $trip->traveler->user->id }}">Profile</button>

                    <!-- Show Modal -->
                    <div class="modal fade" id="showModal{{ $trip->traveler->user->id }}" tabindex="-1">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Profile Details</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row gy-4 gy-lg-0">
                                            <div class="col-12 col-lg-4 col-xl-3">
                                                <div class="row gy-4">
                                                    <div class="col-12">
                                                        <div class="card widget-card border-light shadow-sm">
                                                            <div class="card-header text-bg-primary">Welcome, {{ $trip->traveler->user->name }}</div>
                                                            <div class="card-body">
                                                                <div class="text-center mb-3">
                                                                    <img src="{{ asset('image/travel_photos') }}/{{$trip->traveler->user->travel_photos}}" class="img-fluid rounded-circle" alt="{{ $trip->traveler->user->name }}" height="50" width="100">
                                                                </div>
                                                                <h5 class="text-center mb-1">{{ $trip->traveler->user->name }}</h5>
                                                                <p class="text-center text-secondary mb-4">Project Manager</p>
                                                                <ul class="list-group list-group-flush mb-0">
                                                                    <li class="list-group-item">
                                                                        <strong class="mb-1">
                                                                            Education
                                                                        </strong>
                                                                        <span>M.S Computer Science</span>
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <strong class="mb-1">
                                                                            Location
                                                                        </strong>
                                                                        <span>Mountain View, California</span>
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <strong class="mb-1">
                                                                            Company
                                                                        </strong>
                                                                        <span>GitHub Inc</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-8 col-xl-9">
                                                <div class="card widget-card border-light shadow-sm">
                                                    <div class="card-body p-4">
                                                        <h5 class="mb-3">About</h5>
                                                        <p class="lead mb-3">{{ $trip->traveler->bio ?? 'N/A' }}</p>
                                                        <h5 class="mb-3">Preferences</h5>
                                                        <div class="row">
                                                            <div class="col-md-3 shadow-md mb-3">
                                                                <strong>Interests:</strong>
                                                                <p>{{ $trip->traveler->interests ?? 'N/A' }}</p>
                                                            </div>
                                                            <div class="col-md-3 shadow-md mb-3">
                                                                <strong>Destination:</strong>
                                                                <p>{{ $trip->traveler->destination->name ?? 'N/A' }}</p>
                                                            </div>
                                                            <div class="col-md-3 shadow-md mb-3">
                                                                <strong>Travel Preferences:</strong>
                                                                <p>{{ $trip->traveler->travel_preferences ?? 'N/A' }}</p>
                                                            </div>
                                                            <div class="col-md-3 shadow-md mb-3">
                                                                <strong>Budget:</strong>
                                                                <p>{{ ucfirst($trip->traveler->travel_budget) ?? 'N/A' }}</p>
                                                            </div>
                                                            <div class="col-md-3 shadow-md mb-3">
                                                                <strong>Duration:</strong>
                                                                <p>{{ $trip->traveler->travel_duration ?? 'N/A' }}</p>
                                                            </div>
                                                            <div class="col-md-3 shadow-md mb-3">
                                                                <strong>Companions:</strong>
                                                                <p>{{ $trip->traveler->travel_companions ?? 'N/A' }}</p>
                                                            </div>
                                                            <div class="col-md-3 shadow-md mb-3">
                                                                <strong>Experience Level:</strong>
                                                                <p>{{ $trip->traveler->travel_experience ?? 'N/A' }}</p>
                                                            </div>
                                                            <div class="col-md-3 shadow-md mb-3">
                                                                <strong>Travel Style:</strong>
                                                                <p class="badge bg-primary">{{ ucfirst($trip->traveler->travel_style) }}</p>
                                                            </div>
                                                            <div class="col-md-3 shadow-md mb-3">
                                                                <strong>Start Date:</strong>
                                                                <p>{{ \Carbon\Carbon::parse($trip->traveler->start_date)->format('F d, Y') ?? 'N/A' }}</p>
                                                            </div>
                                                            <div class="col-md-3 shadow-md mb-3">
                                                                <strong>End Date:</strong>
                                                                <p>{{ \Carbon\Carbon::parse($trip->traveler->end_date)->format('F d, Y') ?? 'N/A' }}</p>
                                                            </div>
                                                            <div class="col-md-3 shadow-md mb-3">
                                                                <strong>Estimated Price:</strong>
                                                                <p>${{ $trip->traveler->price ?? 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->role === 'traveler')
                    @if(!in_array($trip->id, $existingBuddyRequests))
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#showTripModal{{ $trip->id }}">Show</button>

                    <!-- Request Buddy Button -->
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#requestBuddyModal{{ $trip->id }}">
                        Request Buddy
                    </button>

                    <!-- Request Buddy Modal -->
                    <div class="modal fade" id="requestBuddyModal{{ $trip->id }}" tabindex="-1" aria-labelledby="requestBuddyLabel{{ $trip->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('request.buddy', $trip->id) }}" method="POST" class="modal-content">
                                @csrf
                                <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                                <input type="hidden" name="receiver_id" value="{{ $trip->traveler->id ?? '' }}">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="requestBuddyLabel{{ $trip->id }}">Request Travel Buddy</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message for Buddy</label>
                                        <textarea id="message" name="message" class="form-control" rows="3" required>
Hi, I found your trip to {{ $trip->destination->name }} interesting. Would you like to be travel buddies?
</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Send Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @else
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#showTripModal{{ $trip->id }}">Show</button>
                    <span class="badge bg-secondary mt-1">Request Sent</span>
                    @endif

                    @elseif(Auth::user()->role === 'admin')
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#showTripModal{{ $trip->id }}">Show</button>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTripModal{{ $trip->id }}">Edit</button>
                    <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    @endif
                    @endauth
                </td>
            </tr>

            <!-- Show Modal -->
            <div class="modal fade" id="showTripModal{{ $trip->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Trip Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Title:</strong> {{ $trip->title }}</p>
                            <p><strong>Description:</strong> {{ $trip->description }}</p>
                            <p><strong>Destination:</strong> {{ $trip->destination->name ?? '' }}</p>
                            <p><strong>Dates:</strong> {{ $trip->start_date }} to {{ $trip->end_date }}</p>
                            @if($trip->image)
                            <img src="{{ asset('image/trips') }}/{{$trip->image }}" alt="Image" class="img-fluid mt-2">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editTripModal{{ $trip->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="modal-header">
                                <h5>Edit Trip</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $trip->title }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Slug</label>
                                    <input type="text" name="slug" class="form-control" value="{{ $trip->slug }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Destination</label>
                                    <select name="destination_id" class="form-control" required>
                                        @foreach ($destinations as $destination)
                                        <option value="{{ $destination->id }}" {{ $trip->destination_id == $destination->id ? 'selected' : '' }}>
                                            {{ $destination->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ $trip->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Start Date</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ $trip->start_date }}">
                                </div>
                                <div class="mb-3">
                                    <label>End Date</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ $trip->end_date }}">
                                </div>
                                <div class="mb-3">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @if($trip->image)
                                    <img src="{{ asset('image/trips') }}/{{$trip->image }}" class="mt-2" width="100">
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addTripModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('trips.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Trip</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Destination</label>
                        <select name="destination_id" class="form-control" required>
                            @foreach ($destinations as $destination)
                            <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection