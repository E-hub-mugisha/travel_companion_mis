@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Traveler Feedbacks</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                @if(auth()->user()->role == 'admin')
                <th>Buddy</th>
                <th>User</th>
                @endif
                <th>Rating</th>
                <th>Comment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedbacks as $feedback)
            <tr>
                <td>{{ $loop->iteration }}</td>
                @if( Auth::user()->role == 'admin')
                <td>{{ $feedback->buddy->user->name ?? 'N/A' }}</td>
                <td>{{ $feedback->user->name ?? 'N/A' }}</td>
                @endif
                <td>{{ $feedback->rating }}</td>
                <td>{{ $feedback->comment }}</td>
                <td>
                    <!-- Edit -->
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $feedback->id }}">Edit</button>
                    <!-- Delete -->
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $feedback->id }}">Delete</button>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal{{ $feedback->id }}" tabindex="-1">
              <div class="modal-dialog">
                <form method="POST" action="{{ route('panel.feedbacks.update', $feedback->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Feedback</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Rating</label>
                                <input type="number" name="rating" value="{{ $feedback->rating }}" min="1" max="5" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Comment</label>
                                <textarea name="comment" class="form-control" required>{{ $feedback->comment }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Update</button>
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
              </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal{{ $feedback->id }}" tabindex="-1">
              <div class="modal-dialog">
                <form method="POST" action="{{ route('panel.feedbacks.destroy', $feedback->id) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this feedback?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
              </div>
            </div>

            @endforeach
        </tbody>
    </table>
</div>
@endsection
