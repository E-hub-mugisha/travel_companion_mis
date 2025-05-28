@extends('layouts.guest')
@section('title', 'Travel Buddy')
@section('content')

@include('front-page.includes.breadcrumb')

<div class="container-fluid packages py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">@yield('title')</h5>
            <h1 class="mb-0">Awesome @yield('title')</h1>
        </div>
        <div class="">
            <div class="row">
                @foreach ($travelers as $traveler)
                <div class="packages-item col-md-4 mb-4">
                    <div class="packages-img">
                        <img src="{{ asset('image/travel_photos') }}/{{$traveler->travel_photos}}" class="img-fluid w-100 rounded-top" alt="Image">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute" style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt me-2"></i>{{ $traveler->destination->name }}</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt me-2"></i>{{ $traveler->travel_duration }}</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user me-2"></i>2 Person</small>
                        </div>
                        <div class="packages-price py-2 px-4">$549.00</div>
                    </div>
                    <div class="packages-content bg-light">
                        <div class="p-4 pb-0">
                            <h5 class="mb-0">{{ $traveler->user->name }}</h5>
                            <small class="text-uppercase">{{ $traveler->travel_companions }}</small>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p class="mb-4">{{ Str::limit($traveler->bio, 60 )}}</p>
                        </div>
                        <div class="row bg-primary rounded-bottom mx-0">
                            <div class="col-6 text-start px-0">
                                <a href="{{ route('traveler-profile', $traveler->id ) }}" class="btn-hover btn text-white py-2 px-4">Read More</a>
                            </div>
                            <div class="col-6 text-end px-0">
                                <form action="{{ route('request-travelers.store') }}" method="POST" class="col-md-12">
                                    @csrf
                                    <input type="hidden" name="receiver_id" value="{{ $traveler->id }}">
                                    <button type="submit" class="btn-hover btn text-white py-2 px-">Request Buddy</button>
                                </form>
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