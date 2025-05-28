@extends('layouts.app')
@section('title', 'Users')
@section('content')
<div class="container">
    <h2>Users</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>

    <table class="table mt-3">
        <thead>
            <tr><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->role }}</td>
                <td>
                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#showUserModal{{ $user->id }}">Show</button>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">Edit</button>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>

            {{-- Show Modal --}}
            <div class="modal fade" id="showUserModal{{ $user->id }}" tabindex="-1">
                <div class="modal-dialog"><div class="modal-content">
                    <div class="modal-header"><h5 class="modal-title">User Details</h5></div>
                    <div class="modal-body">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Role:</strong> {{ $user->role }}</p>
                    </div>
                </div></div>
            </div>

            {{-- Edit Modal --}}
            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
                <div class="modal-dialog"><div class="modal-content">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-header"><h5 class="modal-title">Edit User</h5></div>
                        <div class="modal-body">
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                            <input type="email" name="email" class="form-control mt-2" value="{{ $user->email }}" required>
                            <select name="role" class="form-control mt-2" required>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="traveler" {{ $user->role === 'traveler' ? 'selected' : '' }}>Traveler</option>
                                <option value="guide" {{ $user->role === 'guide' ? 'selected' : '' }}>Guide</option>
                                <option value="agent" {{ $user->role === 'agent' ? 'selected' : '' }}>Agent</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div></div>
            </div>
        @endforeach
        </tbody>
    </table>

    {{-- Add Modal --}}
    <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog"><div class="modal-content">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-header"><h5 class="modal-title">Add User</h5></div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                    <input type="email" name="email" class="form-control mt-2" placeholder="Email" required>
                    <input type="password" name="password" class="form-control mt-2" placeholder="Password" required>
                    <select name="role" class="form-control mt-2" required>
                        <option value="admin">Admin</option>
                        <option value="traveler">Traveler</option>
                        <option value="guide">Guide</option>
                        <option value="agent">Agent</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Create</button>
                </div>
            </form>
        </div></div>
    </div>
</div>
@endsection
