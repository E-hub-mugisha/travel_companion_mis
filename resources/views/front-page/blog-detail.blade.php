@extends('layouts.guest')
@section('title', $blog->title)
@section('meta-description', Str::limit(strip_tags($blog->content), 160))
@section('content')

@include('front-page.includes.breadcrumb')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Blog Image --}}
            @if($blog->image)
                <div class="mb-4">
                    <img src="{{ asset('image/blogs/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid rounded shadow">
                </div>
            @endif

            {{-- Blog Title & Metadata --}}
            <h1 class="mb-3">{{ $blog->title }}</h1>
            <div class="text-muted mb-4">
                <span>By <strong>{{ $blog->author }}</strong></span> |
                <span>{{ $blog->category }}</span> |
                <span>{{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('F j, Y') : 'Unpublished' }}</span>
            </div>

            {{-- Blog Content --}}
            <div class="blog-content mb-5">
                {!! $blog->content !!}
            </div>

            {{-- Tags --}}
            @if($blog->tags)
                <div class="mt-4">
                    <h6>Tags:</h6>
                    @foreach(explode(',', $blog->tags) as $tag)
                        <span class="badge bg-primary text-white me-1">{{ trim($tag) }}</span>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</div>

@endsection
