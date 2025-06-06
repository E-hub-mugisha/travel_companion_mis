@extends('layouts.guest')
@section('content')

@include('front-page.includes.breadcrumb')

<!-- About Start -->
<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                    <img src="{{ asset('front/img/carousel-3.jpg') }}" class="img-fluid w-100 h-100" alt="">
                </div>
            </div>
            <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(front/img/about-img-1.png);">
                <h5 class="section-about-title pe-3">About Us</h5>
                <h1 class="mb-4">Inkindi Travel <span class="text-primary">Companion Finder</span></h1>
                <p class="mb-4">Inkindi Travel Companion Finder MIS is a digital platform designed to help travelers find suitable travel partners based on shared interests, destinations, budgets, and schedules. Developed for Inkindi Tour, the system addresses common travel challenges such as loneliness, safety concerns, and high costs by providing intelligent matching, user profile management, and secure communication. This MIS enhances group travel experiences, promotes cost-sharing, and strengthens customer satisfaction in the tourism industry</p>

                <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="">Read More</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

@endsection