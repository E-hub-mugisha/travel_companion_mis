@extends('layouts.app')
@section('content')

<div class="container mt-4">
    @include('profile.partials.profile-information')

    <div class="row g-4">
        <div class="col-md-4">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="col-md-4">
            @include('profile.partials.update-password-form')
        </div>

        <div class="col-md-4">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>
@endsection