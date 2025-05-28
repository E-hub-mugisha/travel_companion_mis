@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Travel Buddy Requests</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Requester</th>
                <th>Receiver</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buddies as $buddy)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $buddy->requester->name }}</td>
                <td>{{ $buddy->travelerProfile->user->name }}</td>
                <td>{{ $buddy->message }}</td>
                <td>
                    <span class="badge 
                            @if($buddy->status == 'accepted') bg-success 
                            @elseif($buddy->status == 'rejected') bg-danger 
                            @else bg-secondary 
                            @endif">
                        {{ ucfirst($buddy->status) }}
                    </span>
                </td>
                <td>
                    @if ($buddy->status == 'pending')
                    <!-- Accept Button -->
                     @if($buddy->requester->id != auth()->user()->id)
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#acceptModal{{ $buddy->id }}">
                        Accept
                    </button>

                    <!-- Decline Button -->
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#declineModal{{ $buddy->id }}">
                        Decline
                    </button>

                    @else
                    <!-- Decline Button -->
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#declineModal{{ $buddy->id }}">
                        Decline
                    </button>
                    @endif
                    @else
                    <span class="text-muted">No Actions</span>
                    @endif

                    <!-- View Profile -->
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#profileModal{{ $buddy->id }}">
                        View Profile
                    </button>
                </td>
            </tr>

            <!-- Accept Modal -->
            <div class="modal fade" id="acceptModal{{ $buddy->id }}" tabindex="-1" aria-labelledby="acceptModalLabel{{ $buddy->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('travel_buddies.update', $buddy->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="accepted">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Accept Request</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to accept this travel buddy request?
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Yes, Accept</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Decline Modal -->
            <div class="modal fade" id="declineModal{{ $buddy->id }}" tabindex="-1" aria-labelledby="declineModalLabel{{ $buddy->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('travel_buddies.update', $buddy->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="rejected">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reject Request</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to reject this travel buddy request?
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Yes, Reject</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- View Profile Modal -->

            <div class="modal fade" id="profileModal{{ $buddy->id }}" tabindex="-1" aria-labelledby="profileModalLabel{{ $buddy->id }}" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Requester Profile - {{ $buddy->requester->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row gy-4 gy-lg-0">
                                <div class="col-12 col-lg-4 col-xl-3">
                                    <div class="row gy-4">
                                        <div class="col-12">
                                            <div class="card widget-card border-light shadow-sm">
                                                <div class="card-header text-bg-primary">Welcome, {{ $buddy->requester->name }}</div>
                                                <div class="card-body">
                                                    <div class="text-center mb-3">
                                                        <img src="{{ asset('image/travel_photos') }}/{{$buddy->requester->travelerProfile->travel_photos}}" class="img-fluid rounded-circle" alt="{{ $buddy->requester->name }}" height="50" width="100">
                                                    </div>
                                                    <h5 class="text-center mb-1">{{ $buddy->requester->name }}</h5>
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
                                            <p class="lead mb-3">{{ $buddy->requester->travelerProfile->bio ?? 'N/A' }}</p>
                                            <h5 class="mb-3">Preferences</h5>
                                            <div class="row">
                                                <div class="col-md-3 shadow-md mb-3">
                                                    <strong>Interests:</strong>
                                                    <p>{{ $buddy->requester->travelerProfile->interests ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-3 shadow-md mb-3">
                                                    <strong>Destination:</strong>
                                                    <p>{{ $buddy->requester->travelerProfile->destination->name ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-3 shadow-md mb-3">
                                                    <strong>Travel Preferences:</strong>
                                                    <p>{{ $buddy->requester->travelerProfile->travel_preferences ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-3 shadow-md mb-3">
                                                    <strong>Budget:</strong>
                                                    <p>{{ ucfirst($buddy->requester->travelerProfile->travel_budget) ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-3 shadow-md mb-3">
                                                    <strong>Duration:</strong>
                                                    <p>{{ $buddy->requester->travelerProfile->travel_duration ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-3 shadow-md mb-3">
                                                    <strong>Companions:</strong>
                                                    <p>{{ $buddy->requester->travelerProfile->travel_companions ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-3 shadow-md mb-3">
                                                    <strong>Experience Level:</strong>
                                                    <p>{{ $buddy->requester->travelerProfile->travel_experience ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-3 shadow-md mb-3">
                                                    <strong>Travel Style:</strong>
                                                    <p class="badge bg-primary">{{ ucfirst($buddy->requester->travelerProfile->travel_style) }}</p>
                                                </div>
                                                <div class="col-md-3 shadow-md mb-3">
                                                    <strong>Start Date:</strong>
                                                    <p>{{ \Carbon\Carbon::parse($buddy->requester->travelerProfile->start_date)->format('F d, Y') ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-3 shadow-md mb-3">
                                                    <strong>End Date:</strong>
                                                    <p>{{ \Carbon\Carbon::parse($buddy->requester->travelerProfile->end_date)->format('F d, Y') ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-3 shadow-md mb-3">
                                                    <strong>Estimated Price:</strong>
                                                    <p>${{ $buddy->requester->travelerProfile->price ?? 'N/A' }}</p>
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
            @endforeach
        </tbody>
    </table>
</div>
@endsection