<nav id="sidebar" class="active">
    <div class="sidebar-header">
        <h3 class="text-black"><i class="fa fa-map-marker-alt me-3"></i>Inkindi Tours</h3>
    </div>

    <ul class="list-unstyled components text-secondary">

        <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>

        @auth
        <li><a href="/trips"><i class="fas fa-chart-bar"></i> Trips</a></li>
        <li><a href="/trips"><i class="fas fa-chart-bar"></i> Trip History</a></li>
        @if(Auth::user()->role === 'traveler')
        <!-- my trip -->
        <li><a href="my-trips"><i class="fas fa-chart-bar"></i> My Trips</a></li>
        <li><a href="/traveler/profiles"><i class="fas fa-icons"></i> Traveller</a></li>
        <li><a href="/traveler/requests"><i class="fas fa-icons"></i> Traveller Requests</a></li>
        <li><a href="{{ route('panel.feedbacks.index') }}"><i class="fas fa-comments"></i> Feedbacks</a></li>
        @endif

        @if(in_array(Auth::user()->role, ['admin']))
        <li><a href="/traveler/profiles"><i class="fas fa-icons"></i> Traveller</a></li>
        <li><a href="/traveler/requests"><i class="fas fa-icons"></i> Traveller Requests</a></li>
        <li><a href="/users"><i class="fas fa-user-friends"></i> Users</a></li>
        <li><a href="/blogs"><i class="fas fa-blog"></i> Blogs</a></li>
        <li><a href="/destinations"><i class="fas fa-map-marked-alt"></i> Destinations</a></li>
        <li><a href="{{ route('panel.feedbacks.index') }}"><i class="fas fa-comments"></i> Feedbacks</a></li>
        @endif
        @endauth

    </ul>
</nav>