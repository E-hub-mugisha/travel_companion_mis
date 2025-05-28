@php 
    use App\Models\TravelerProfile;
    use App\Models\Destination;
    $profile = TravelerProfile::where('user_id', auth()->id())->first();
    $destinations = Destination::all();
@endphp

@if ($profile->user->id == auth()->id())
<!-- Profile Information Section -->
<div class="container">
    <div class="row gy-4 gy-lg-0">
        <div class="col-12 col-lg-4 col-xl-3">
            <div class="row gy-4">
                <div class="col-12">
                    <div class="card widget-card border-light shadow-sm">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="{{ asset('image/travel_photos') }}/{{$profile->travel_photos}}" class="img-fluid rounded-circle" alt="{{ $profile->user->name }}" height="50" width="100">
                            </div>
                            <h5 class="text-center mb-1">{{ $profile->user->name }}</h5>
                            <p class="text-center text-secondary mb-4">Project Manager</p>
                            <ul class="list-group list-group-flush mb-0">
                                <li class="list-group-item">
                                    <strong class="mb-1">
                                        Education
                                    </strong>
                                    <span>M.S Computer Science</span>
                                </li>
                                <li class="list-group-item">
                                    <strong class="mb-1">
                                        Location
                                    </strong>
                                    <span>Mountain View, California</span>
                                </li>
                                <li class="list-group-item">
                                    <strong class="mb-1">
                                        Company
                                    </strong>
                                    <span>GitHub Inc</span>
                                </li>
                            </ul>
                            <div class="d-grid m-0">
                                <button data-bs-toggle="modal" data-bs-target="#profilePhotoModal{{ $profile->id }}" class="btn btn-outline-primary" type="button">Add Photo Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8 col-xl-9">
            <div class="card widget-card border-light shadow-sm">
                <div class="card-body p-4">
                    <h5 class="mb-3">About</h5>
                    <p class="lead mb-3">{{ $profile->bio ?? 'N/A' }}</p>
                    <h5 class="mb-3">Preferences</h5>
                    <div class="row">
                        <div class="col-md-3 shadow-md mb-3">
                            <strong>Interests:</strong>
                            <p>{{ $profile->interests ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-3 shadow-md mb-3">
                            <strong>Destination:</strong>
                            <p>{{ $profile->destination->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-3 shadow-md mb-3">
                            <strong>Travel Preferences:</strong>
                            <p>{{ $profile->travel_preferences ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-3 shadow-md mb-3">
                            <strong>Budget:</strong>
                            <p>{{ ucfirst($profile->travel_budget) ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-3 shadow-md mb-3">
                            <strong>Duration:</strong>
                            <p>{{ $profile->travel_duration ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-3 shadow-md mb-3">
                            <strong>Companions:</strong>
                            <p>{{ $profile->travel_companions ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-3 shadow-md mb-3">
                            <strong>Experience Level:</strong>
                            <p>{{ $profile->travel_experience ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-3 shadow-md mb-3">
                            <strong>Travel Style:</strong>
                            <p class="badge bg-primary">{{ ucfirst($profile->travel_style) }}</p>
                        </div>
                        <div class="col-md-3 shadow-md mb-3">
                            <strong>Start Date:</strong>
                            <p>{{ \Carbon\Carbon::parse($profile->start_date)->format('F d, Y') ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-3 shadow-md mb-3">
                            <strong>End Date:</strong>
                            <p>{{ \Carbon\Carbon::parse($profile->end_date)->format('F d, Y') ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-3 shadow-md mb-3">
                            <strong>Estimated Price:</strong>
                            <p>${{ $profile->price ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Photo Modal -->
<div class="modal fade" id="profilePhotoModal{{ $profile->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('traveler-profiles.photo.store', $profile->id ) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Add Profile Photo</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Profile Photo</label>
                        <input type="file" name="travel_photos" id="travel_photos" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $profile->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('traveler-profiles.update', $profile->id) }}">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Traveler Profile</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="mb-2">
                        <label>Bio</label>
                        <textarea name="bio" class="form-control">{{ $profile->bio }}</textarea>
                    </div>
                    <div class="mb-2">
                        <label>Interests</label>
                        <input type="text" name="interests" class="form-control" value="{{ $profile->interests }}">
                    </div>
                    <div class="mb-2">
                        <label>Destination</label>
                        <select name="destination_id" class="form-control">
                            @foreach($destinations as $dest)
                            <option value="{{ $dest->id }}" @selected($profile->destination_id == $dest->id)>{{ $dest->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Travel Preferences</label>
                        <input type="text" name="travel_preferences" class="form-control" value="{{ $profile->travel_preferences }}">
                    </div>
                    <div class="mb-2">
                        <label>Travel Style</label>
                        <select name="travel_style" class="form-control">
                            @foreach(['budget','adventure','luxury'] as $style)
                            <option value="{{ $style }}" @selected($profile->travel_style == $style)>{{ ucfirst($style) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Travel Budget</label>
                        <input type="text" name="travel_budget" class="form-control" value="{{ $profile->travel_budget }}">
                    </div>
                    <div class="mb-2">
                        <label>Travel Duration</label>
                        <input type="text" name="travel_duration" class="form-control" value="{{ $profile->travel_duration }}">
                    </div>
                    <div class="mb-2">
                        <label>Travel Companions</label>
                        <input type="text" name="travel_companions" class="form-control" value="{{ $profile->travel_companions }}">
                    </div>
                    <div class="mb-2">
                        <label>Travel Experience</label>
                        <input type="text" name="travel_experience" class="form-control" value="{{ $profile->travel_experience }}">
                    </div>

                    <div class="mb-2">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $profile->start_date }}">
                    </div>
                    <div class="mb-2">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $profile->end_date }}">
                    </div>
                    <div class="mb-2">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" value="{{ $profile->price }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endif