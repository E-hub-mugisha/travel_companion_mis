@extends('layouts.guest')
@section('title', 'Traveler Trips')
@section('content')

@include('front-page.includes.breadcrumb')

<div class="container-fluid packages py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Explore Tour</h5>
            <h1 class="mb-4">The World</h1>
            
        </div>

        <div class="row g-4">
            @foreach ($trips as $trip)
            <div class="packages-item col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="packages-img">
                    <img src="{{ asset('image/trips') }}/{{$trip->image }}" class="img-fluid w-100 rounded-top" alt="Image">
                    <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute" style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt me-2"></i>Thayland</small>
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt me-2"></i>3 days</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-user me-2"></i>2 Person</small>
                    </div>
                    <!-- <div class="packages-price py-2 px-4">$649.00</div> -->
                </div>
                <div class="packages-content bg-light">
                    <div class="p-4 pb-0">
                        <h5 class="mb-0">{{ $trip->title }}</h5>
                        <small class="text-uppercase">{{ $trip->destination->name }}</small>
                        <div class="mb-3">
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                        </div>
                        <p class="mb-4">{{ $trip->description }}</p>
                    </div>
                    <div class="row bg-primary rounded-bottom mx-0">
                        <div class="col-6 text-start px-0">
                            <a href="{{ route('inkindi.trips.details', $trip->slug )}}" class="btn-hover btn text-white py-2 px-4">Read More</a>
                        </div>
                        <div class="col-6 text-end px-0">
                            <a href="#" class="btn-hover btn text-white py-2 px-4">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
</div>

@endsection