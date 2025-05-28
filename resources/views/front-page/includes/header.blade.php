<!-- Topbar Start -->
<div class="container-fluid bg-primary px-5 d-none d-lg-block">
    <div class="row gx-0">
        <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-twitter fw-normal"></i></a>
                <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-linkedin-in fw-normal"></i></a>
                <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
                <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i class="fab fa-youtube fw-normal"></i></a>
            </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                @guest
                <a href="{{ route('register') }}">
                    <small class="me-3 text-light"><i class="fa fa-user me-2"></i>Register</small>
                </a>
                <a href="{{ route('login') }}">
                    <small class="me-3 text-light"><i class="fa fa-sign-in-alt me-2"></i>Login</small>
                </a>
                @endguest

                @auth
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown">
                        <small><i class="fa fa-home me-2"></i> My Dashboard</small>
                    </a>
                    <div class="dropdown-menu rounded">
                        <a href="" class="dropdown-item">
                            <i class="fas fa-user-alt me-2"></i> My Profile
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-comment-alt me-2"></i> Inbox
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-bell me-2"></i> Notifications
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-cog me-2"></i> Account Settings
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item" type="submit">
                                <i class="fas fa-power-off me-2"></i> Log Out
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>

        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="{{ route('home') }}" class="navbar-brand p-0">
            <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Inkindi Tours</h1>
            <!-- <img src="img/logo.png" alt="Logo"> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
                <a href="{{ route('travel-buddies.index') }}" class="nav-item nav-link">Buddies</a>
                <a href="{{ route('inkindi.trips') }}" class="nav-item nav-link">Trips</a>
                <a href="{{ route('blog') }}" class="nav-item nav-link">Blog</a>
                <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
            </div>
            <button type="button" data-bs-toggle="modal" data-bs-target="#searchModal" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Find Buddy</button>
        </div>
    </nav>

</div>
@php
$destinations = \App\Models\Destination::all();
@endphp
<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('find-buddies') }}" method="GET" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Search Travel Buddies</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label for="destination_id" class="form-label">Destination</label>
                    <select name="destination_id" class="form-select">
                        <option value="">Any</option>
                        @foreach($destinations as $destination)
                        <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="interests" class="form-label">Interests</label>
                    <input type="text" name="interests" class="form-control" placeholder="e.g., hiking, beaches">
                </div>

                <div class="mb-3">
                    <label for="travel_budget" class="form-label">Budget</label>
                    <select name="travel_budget" class="form-select">
                        <option value="">Any</option>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="travel_duration" class="form-label">Duration</label>
                    <input type="text" name="travel_duration" class="form-control" placeholder="e.g., 1 week, 2 weeks">
                </div>

                <div class="mb-3">
                    <label for="travel_style" class="form-label">Style</label>
                    <select name="travel_style" class="form-select">
                        <option value="">Any</option>
                        <option value="budget">Budget</option>
                        <option value="adventure">Adventure</option>
                        <option value="luxury">Luxury</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </form>
    </div>
</div>