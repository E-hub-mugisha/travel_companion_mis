@extends('layouts.guest')

@section('title', 'Trip Details')
<blade
    section|(%26%2339%3Bmeta-description%26%2339%3B%2C%20%26%2339%3BExplore%20the%20details%20of%20this%20amazing%20trip.%20Discover%20the%20itinerary%2C%20highlights%2C%20and%20more%20about%20this%20travel%20experience.%26%2339%3B) />

@section('content')

@include('front-page.includes.breadcrumb')

<div class="container-fluid packages py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" style="max-width: 900px; margin: auto;">
            <h5 class="section-title px-3 text-primary text-uppercase">@yield('title')</h5>
            <h1 class="display-5 fw-bold text-dark">{{ $trip->title }}</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bg-white rounded-4 shadow-lg overflow-hidden mb-5">

                    {{-- Trip Image --}}
                    @if($trip->image)
                        <div class="position-relative overflow-hidden">
                            <img src="{{ asset('image/trips/' . $trip->image) }}"
                                alt="{{ $trip->title }} Image" class="img-fluid w-100"
                                style="max-height: 480px; object-fit: cover;">
                        </div>
                    @endif

                    <div class="p-4 p-md-5">
                        {{-- Destination and Dates --}}
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2 text-muted">
                                <i class="bi bi-geo-alt-fill me-2 text-primary"></i>
                                <span class="fw-semibold">{{ $trip->destination->name }}</span>
                            </div>
                            @if($trip->start_date && $trip->end_date)
                                <p class="text-secondary small mb-0">
                                    {{ \Carbon\Carbon::parse($trip->start_date)->format('F j, Y') }}
                                    &mdash;
                                    {{ \Carbon\Carbon::parse($trip->end_date)->format('F j, Y') }}
                                </p>
                            @endif
                        </div>

                        {{-- Description --}}
                        <div class="mb-5">
                            <h3 class="h5 fw-bold mb-3 text-dark">About this Trip</h3>
                            <p class="text-muted fs-6 lh-lg">
                                {{ $trip->description ?? 'No description provided.' }}
                            </p>
                        </div>

                        {{-- Posted Info --}}
                        <div class="d-flex justify-content-between border-top pt-3 text-muted small">
                            <div>
                                <span>Posted by </span>
                                <span class="fw-semibold text-dark">{{ $trip->traveler->name }}</span>
                            </div>
                            <div>
                                {{ $trip->created_at->format('F j, Y') }}
                            </div>
                        </div>

                        {{-- Optional Booking Button --}}
                        <div class="mt-4 text-center">

                            <button type="button" class="btn btn-primary  px-5 py-2 rounded-pill shadow-sm"
                                data-bs-toggle="modal" data-bs-target="#requestBuddyModal{{ $trip->id }}">
                                Request a Travel Buddy to this Trip <i class="fas fa-user-friends"></i>
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="requestBuddyModal{{ $trip->id }}" tabindex="-1"
                            aria-labelledby="requestBuddyModalLabel{{ $trip->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('request.buddy', $trip->id) }}"
                                    method="POST" class="modal-content">
                                    @csrf
                                    <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                                    <input type="hidden" name="receiver_id" value="{{ $trip->traveler->id }}">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="requestBuddyModalLabel{{ $trip->id }}">Request
                                            Travel Buddy</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="message" class="form-label">Message for Buddy</label>
                                            <textarea id="message" name="message" class="form-control" rows="3"
                                                required>
              Hi, I found your trip to {{ $trip->destination->name }} interesting. Would you like to be travel buddies?
            </textarea>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                            title="Send a request to this buddy">
                                            Send Request <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Optional Back Button --}}
                <div class="text-center">
                    <a href="{{ route('trips.index') }}"
                        class="btn btn-outline-secondary rounded-pill px-4">
                        &larr; Back to All Trips
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
