@extends('layouts.guest')

@section('title', 'Trip Details')
@section('meta-description', 'Explore the details of this amazing trip. Discover the itinerary, highlights, and more about this travel experience.')

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
                                 alt="{{ $trip->title }} Image"
                                 class="img-fluid w-100"
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
                            <a href="#" class="btn btn-primary px-5 py-2 rounded-pill shadow-sm">
                                Book This Trip
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Optional Back Button --}}
                <div class="text-center">
                    <a href="{{ route('trips.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        &larr; Back to All Trips
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
