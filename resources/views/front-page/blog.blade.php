@extends('layouts.guest')
@section('title', 'Our Blog')
@section('content')

@include('front-page.includes.breadcrumb')

<div class="container-fluid packages py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Latest Insights</h5>
            <h1 class="mb-4">From Our Blog</h1>
            <p class="mb-0">Stay informed and inspired with travel tips, stories, and updates from our blog. Explore articles written by travelers and travel experts.</p>
        </div>

        <div class="row g-4">
            @foreach ($blogs as $blog)
            <div class="packages-item col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="packages-img position-relative">
                    <img src="{{ asset('image/blogs/' . $blog->image) }}" class="img-fluid w-100 rounded-top" alt="{{ $blog->title }}">
                </div>
                <div class="packages-content bg-light">
                    <div class="p-4 pb-0">
                        <h5 class="mb-1">{{ $blog->title }}</h5>
                        <small class="text-muted d-block mb-2">
                            By {{ $blog->author }} | {{ $blog->category }} | {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') : '' }}
                        </small>
                        <p class="mb-4">
                            {{ Str::limit(strip_tags($blog->content), 100, '...') }}
                        </p>
                    </div>
                    <div class="row bg-primary rounded-bottom mx-0">
                        <div class="col-12 text-center px-0">
                            <a href="{{ route('blog.post', $blog->slug) }}" class="btn-hover btn text-white py-2 px-4">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>

@endsection
