@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 page-header">
            <div class="page-pretitle">Overview</div>
            <h2 class="page-title">Dashboard</h2>
        </div>
    </div>

    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Upcoming Trips</h5>
                    <p class="h3 text-info">{{ $upcomingTrips->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Ongoing Trips</h5>
                    <p class="h3 text-success">{{ $ongoingTrips->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Past Trips</h5>
                    <p class="h3 text-muted">{{ $pastTrips->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Buddy Requests</h5>
                    <p class="h3 text-primary">{{ $buddies->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    @if ($topDestinations->count())
    <div class="mb-4">
        <h4>Top Destinations</h4>
        <ul class="list-group">
            @foreach ($topDestinations as $destinationId => $count)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ \App\Models\Destination::find($destinationId)?->name ?? 'Unknown' }}
                <span class="badge bg-secondary">{{ $count }} visits</span>
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="mt-4">
    <h4>Your Travel Buddies</h4>
    <ul class="list-group mb-3">
        @forelse ($buddies as $buddy)
            @php
                // Identify the other user's ID in the buddy request
                $buddyUserId = $buddy->receiver_id === auth()->id() ? $buddy->requester_id : $buddy->receiver_id;

                // Get their traveler profile
                $profile = \App\Models\TravelerProfile::where('user_id', $buddyUserId)->first();
            @endphp

            @if($profile)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $profile->user->name }}
                <a href="{{ route('traveler-profiles.show', $profile->id) }}" class="btn btn-outline-primary btn-sm">View</a>
            </li>
            @endif
        @empty
            <li class="list-group-item">No buddies yet.</li>
        @endforelse
    </ul>
</div>


    <div class="mt-4">
        <h4>Upcoming Trips</h4>
        <ul class="list-group mb-3">
            @forelse ($upcomingTrips as $trip)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $trip->title }} ({{ \Carbon\Carbon::parse($trip->start_date)->format('M d, Y') }})
                <a href="" class="btn btn-outline-info btn-sm">View</a>
            </li>
            @empty
            <li class="list-group-item">No upcoming trips.</li>
            @endforelse
        </ul>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="content">
                    <div class="head">
                        <h5 class="mb-0">Upcoming Trips</h5>
                    </div>
                    <div class="canvas-wrapper">
                        <table class="table table-striped">
                            <thead class="success">
                                <tr>
                                    <th>Name</th>
                                    <th class="text-end">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($upcomingTrips as $trip)
                                <tr>
                                    <td> {{ $trip->title }}</td>
                                    <td class="text-end">{{ \Carbon\Carbon::parse($trip->start_date)->format('M d, Y') }}</td>
                                </tr>
                                @empty
                                <li class="list-group-item">No upcoming trips.</li>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="content">
                    <div class="head">
                        <h5 class="mb-0">Most Visited Pages</h5>
                        <p class="text-muted">Current year website visitor data</p>
                    </div>
                    <div class="canvas-wrapper">
                        <table class="table table-striped">
                            <thead class="success">
                                <tr>
                                    <th>Page Name</th>
                                    <th class="text-end">Visitors</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>/about.html <a href="#"><i class="fas fa-link blue"></i></a></td>
                                    <td class="text-end">8,340</td>
                                </tr>
                                <tr>
                                    <td>/special-promo.html <a href="#"><i class="fas fa-link blue"></i></a></td>
                                    <td class="text-end">7,280</td>
                                </tr>
                                <tr>
                                    <td>/products.html <a href="#"><i class="fas fa-link blue"></i></a></td>
                                    <td class="text-end">6,210</td>
                                </tr>
                                <tr>
                                    <td>/documentation.html <a href="#"><i class="fas fa-link blue"></i></a></td>
                                    <td class="text-end">5,176</td>
                                </tr>
                                <tr>
                                    <td>/customer-support.html <a href="#"><i class="fas fa-link blue"></i></a></td>
                                    <td class="text-end">4,276</td>
                                </tr>
                                <tr>
                                    <td>/index.html <a href="#"><i class="fas fa-link blue"></i></a></td>
                                    <td class="text-end">3,176</td>
                                </tr>
                                <tr>
                                    <td>/products-pricing.html <a href="#"><i class="fas fa-link blue"></i></a></td>
                                    <td class="text-end">2,176</td>
                                </tr>
                                <tr>
                                    <td>/product-features.html <a href="#"><i class="fas fa-link blue"></i></a></td>
                                    <td class="text-end">1,886</td>
                                </tr>
                                <tr>
                                    <td>/contact-us.html <a href="#"><i class="fas fa-link blue"></i></a></td>
                                    <td class="text-end">1,509</td>
                                </tr>
                                <tr>
                                    <td>/terms-and-condition.html <a href="#"><i class="fas fa-link blue"></i></a></td>
                                    <td class="text-end">1,100</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection