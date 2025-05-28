@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Manage Destinations</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Add Destination</button>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('destinations.store') }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Destination</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" id="name" class="form-control mb-2" placeholder="Name" required>
                    <input type="text" name="slug" id="slug" class="form-control mb-2" placeholder="Slug (auto-generated)" required readonly>
                    <input type="text" name="country" class="form-control mb-2" placeholder="Country" required>
                    <input type="file" name="image" class="form-control mb-2">
                    <textarea name="description" class="form-control" placeholder="Description"></textarea>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-success">Save</button></div>
            </form>
        </div>
    </div>

    <!-- Destinations Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Country</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($destinations as $index => $dest)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $dest->name }}</td>
                <td>{{ $dest->slug }}</td>
                <td>{{ $dest->country }}</td>
                <td>
                    @if($dest->image)
                    <img src="{{ asset('image/destinations') }}/{{$dest->image}}" alt="{{ $dest->name }}" width="60">
                    @else
                    N/A
                    @endif
                </td>
                <td>
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#showModal{{ $dest->id }}">Show</button>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $dest->id }}">Edit</button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $dest->id }}">Delete</button>
                </td>
            </tr>

            <!-- Show Modal -->
            <div class="modal fade" id="showModal{{ $dest->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Destination Details</h5>
                        </div>
                        <div class="modal-body">
                            <p><strong>Name:</strong> {{ $dest->name }}</p>
                            <p><strong>Slug:</strong> {{ $dest->slug }}</p>
                            <p><strong>Country:</strong> {{ $dest->country }}</p>
                            <p><strong>Description:</strong> {{ $dest->description }}</p>
                            @if($dest->image)
                            <img src="{{ asset('image/destinations') }}/{{$dest->image}}" class="img-fluid mt-2">
                            @endif
                        </div>
                    </div>
                </div>
            </div>



            @endforeach
        </tbody>
    </table>

    @foreach($destinations as $index => $dest)
    <div class="modal fade" id="editModal{{ $dest->id }}" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('destinations.update', $dest->id) }}" enctype="multipart/form-data" class="modal-content">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Destination</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" id="name" value="{{ $dest->name }}" class="form-control mb-2" required>
                    <input type="text" name="slug" id="slug" value="{{ $dest->slug }}" class="form-control mb-2" required>
                    <input type="text" name="country" value="{{ $dest->country }}" class="form-control mb-2" required>
                    <input type="file" name="image" class="form-control mb-2">
                    <textarea name="description" class="form-control">{{ $dest->description }}</textarea>
                </div>
                <div class="modal-footer"><button class="btn btn-primary">Update</button></div>
            </form>
        </div>
    </div>
    @endforeach
    
    @foreach($destinations as $index => $dest)
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $dest->id }}" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('destinations.destroy', $dest->id) }}" class="modal-content">
                @csrf @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Delete Destination</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong>{{ $dest->name }}</strong>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        nameInput.addEventListener('input', function() {
            let slug = nameInput.value
                .toLowerCase()
                .replace(/[^\w\s-]/g, '') // Remove special chars
                .trim()
                .replace(/\s+/g, '-') // Replace spaces with hyphens
                .replace(/-+/g, '-'); // Remove multiple hyphens

            slugInput.value = slug;
        });
    });
</script>

@endsection