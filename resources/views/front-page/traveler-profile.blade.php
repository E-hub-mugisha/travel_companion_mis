@extends('layouts.guest')
@section('title', $traveler->user->name . ' Profile')
@section('content')

@include('front-page.includes.breadcrumb')

<style>
  .card {
    transition: transform 0.3s ease-in-out;
  }

  .card:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  .btn-primary {
    transition: background-color 0.3s ease;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }
</style>
<!-- Profile 1 - Bootstrap Brain Component -->
<section class="bg-light py-3 py-md-5 py-xl-8">

  <div class="container">
    <div class="row gy-4 gy-lg-0">
      <div class="col-12 col-lg-4 col-xl-3">
        <div class="row gy-4">
          <div class="col-12">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body">
                Welcome, {{ $traveler->user->name }}
                <div class="text-center mb-3">
                  <img src="{{ asset('image/travel_photos') }}/{{$traveler->travel_photos}}" class="img-fluid rounded-circle" alt="{{ $traveler->user->name }}" height="50" width="100">
                </div>
                <h5 class="text-center mb-1">{{ $traveler->user->name }}</h5>
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
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-8 col-xl-9">
        <div class="card widget-card border-light shadow-sm">
          <div class="card-body p-4">
            <h5 class="mb-3">About</h5>
            <p class="lead mb-3">{{ $traveler->bio ?? 'N/A' }}</p>
            <h5 class="mb-3">Preferences</h5>
            <div class="row">
              <div class="col-md-3 shadow-md mb-3">
                <strong>Interests:</strong>
                <p>{{ $traveler->interests ?? 'N/A' }}</p>
              </div>
              <div class="col-md-3 shadow-md mb-3">
                <strong>Destination:</strong>
                <p>{{ $traveler->destination->name ?? 'N/A' }}</p>
              </div>
              <div class="col-md-3 shadow-md mb-3">
                <strong>Travel Preferences:</strong>
                <p>{{ $traveler->travel_preferences ?? 'N/A' }}</p>
              </div>
              <div class="col-md-3 shadow-md mb-3">
                <strong>Budget:</strong>
                <p>{{ ucfirst($traveler->travel_budget) ?? 'N/A' }}</p>
              </div>
              <div class="col-md-3 shadow-md mb-3">
                <strong>Duration:</strong>
                <p>{{ $traveler->travel_duration ?? 'N/A' }}</p>
              </div>
              <div class="col-md-3 shadow-md mb-3">
                <strong>Companions:</strong>
                <p>{{ $traveler->travel_companions ?? 'N/A' }}</p>
              </div>
              <div class="col-md-3 shadow-md mb-3">
                <strong>Experience Level:</strong>
                <p>{{ $traveler->travel_experience ?? 'N/A' }}</p>
              </div>
              <div class="col-md-3 shadow-md mb-3">
                <strong>Travel Style:</strong>
                <p class="badge bg-primary">{{ ucfirst($traveler->travel_style) }}</p>
              </div>
              <div class="col-md-3 shadow-md mb-3">
                <strong>Start Date:</strong>
                <p>{{ \Carbon\Carbon::parse($traveler->start_date)->format('F d, Y') ?? 'N/A' }}</p>
              </div>
              <div class="col-md-3 shadow-md mb-3">
                <strong>End Date:</strong>
                <p>{{ \Carbon\Carbon::parse($traveler->end_date)->format('F d, Y') ?? 'N/A' }}</p>
              </div>
              <div class="col-md-3 shadow-md mb-3">
                <strong>Estimated Price:</strong>
                <p>${{ $traveler->price ?? 'N/A' }}</p>
              </div>
            </div>

            <!-- Show Buddy Feedback -->
            <div class="mt-4">
              <h4>Buddy Feedback</h4>
              @forelse($traveler->buddyFeedback as $feedback)
              <div class="border p-2 mb-2 rounded bg-light">
                <strong>{{ $feedback->user->name }}</strong> rated:
                <span class="text-warning">{{ str_repeat('★', $feedback->rating) }}</span>
                <br>
                <em>{{ $feedback->comment }}</em>
                <div class="text-muted small">{{ $feedback->created_at->diffForHumans() }}</div>
              </div>
              @empty
              <p>No feedback yet for this buddy.</p>
              @endforelse

              <!-- Feedback Form -->
              @if(auth()->check() && auth()->id() !== $traveler->id)
              <form action="{{ route('buddy.feedback.store', $traveler->id) }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-3">
                  <label for="rating" class="form-label">Rating (1 to 5)</label>
                  <select name="rating" class="form-select" required>
                    @for($i = 1; $i <= 5; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                      @endfor
                  </select>
                </div>
                <div class="mb-3">
                  <label for="comment" class="form-label">Feedback (optional)</label>
                  <textarea name="comment" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Feedback</button>
              </form>
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="my-4">
        <h3>Upcoming Trips</h3>
        <div class="row">
          @forelse($upcomingTrips as $trip)
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
              <img src="{{ $trip->image }}" class="card-img-top" alt="{{ $trip->title }}">
              <div class="card-body">
                <h5 class="card-title">{{ $trip->title }}</h5>
                <p class="card-text">{{ \Illuminate\Support\Str::limit($trip->description, 100) }}</p>
                <p><strong>Destination:</strong> {{ $trip->destination->name }}</p>
                <p><strong>Dates:</strong> {{ $trip->start_date }} to {{ $trip->end_date }}</p>

                <!-- Trip Status Icon with Tooltip -->
                <p><span data-bs-toggle="tooltip" data-bs-placement="top" title="Trip Status"><i class="fas fa-calendar-day text-primary"></i> Upcoming</span></p>

                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestBuddyModal{{ $trip->id }}">
                  Request a Travel Buddy <i class="fas fa-user-friends"></i>
                </button>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12">
            <p>No upcoming trips.</p>
          </div>
          @endforelse
        </div>
      </div>
      <div class="my-4">
        <h3>Completed Trips</h3>
        <ul class="list-group">
          @forelse($completedTrips as $trip)
          <li class="list-group-item">
            <div class="d-flex justify-content-between">
              <div>
                <strong>{{ $trip->title }}</strong> – {{ $trip->start_date }} to {{ $trip->end_date }} ({{ $trip->destination->name }})
              </div>
              <div class="d-flex align-items-center">
                <!-- Completed Icon with Tooltip -->
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Completed Trip">
                  <i class="fas fa-check-circle text-success"></i>
                </span>
              </div>
            </div>
          </li>
          @empty
          <li class="list-group-item">No completed trips.</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>

  <!-- Modal for Requesting a Travel Buddy -->
  @foreach($upcomingTrips as $trip)
  <!-- Modal -->
  <div class="modal fade" id="requestBuddyModal{{ $trip->id }}" tabindex="-1" aria-labelledby="requestBuddyModalLabel{{ $trip->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{ route('request.buddy', $trip->id) }}" method="POST" class="modal-content">
        @csrf
        <input type="hidden" name="trip_id" value="{{ $trip->id }}">
        <input type="hidden" name="receiver_id" value="{{ $trip->traveler->id }}">

        <div class="modal-header">
          <h5 class="modal-title" id="requestBuddyModalLabel{{ $trip->id }}">Request Travel Buddy</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="message" class="form-label">Message for Buddy</label>
            <textarea id="message" name="message" class="form-control" rows="3" required>
Hi, I found your trip to {{ $trip->destination->name }} interesting. Would you like to be travel buddies?
</textarea>

          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" title="Send a request to this buddy">
            Send Request <i class="fas fa-paper-plane"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
  @endforeach
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });
  </script>
  </div>
</section>
@endsection