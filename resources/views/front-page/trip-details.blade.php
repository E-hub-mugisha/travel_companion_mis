@extends('layouts.guest')

@section('content')

@include('front-page.includes.breadcrumb')

<section class="bg-gray-50 py-10">
    <div class="max-w-5xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            {{-- Trip Image --}}
            @if($trip->image)
                <img src="{{ asset('image/trips/' . $trip->image) }}" 
                     alt="Trip Image" 
                     class="w-full h-80 object-cover md:h-[450px]">
            @endif

            <div class="p-8">
                {{-- Title and Destination --}}
                <div class="mb-6">
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $trip->title }}</h1>
                    <div class="flex items-center gap-2 text-gray-500 text-sm">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 4.25 7 13 7 13s7-8.75 7-13c0-3.87-3.13-7-7-7z" />
                        </svg>
                        <span>{{ $trip->destination->name }}</span>
                    </div>
                    @if($trip->start_date && $trip->end_date)
                        <p class="text-gray-400 text-sm mt-1">
                            {{ \Carbon\Carbon::parse($trip->start_date)->format('F j, Y') }}
                            &mdash;
                            {{ \Carbon\Carbon::parse($trip->end_date)->format('F j, Y') }}
                        </p>
                    @endif
                </div>

                {{-- Description --}}
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-3">About this Trip</h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $trip->description ?? 'No description provided.' }}
                    </p>
                </div>

                {{-- Author and Date --}}
                <div class="mt-10 border-t pt-4 flex justify-between items-center text-sm text-gray-500">
                    <div>
                        Posted by 
                        <span class="font-medium text-gray-700">{{ $trip->traveler->name }}</span>
                    </div>
                    <div>
                        {{ $trip->created_at->format('F j, Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
