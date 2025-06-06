@extends('layouts.app')
@section('title', 'Manage Blogs')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between mb-4">
        <h2>Blog Management</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBlogModal">+ Add Blog</button>
    </div>

    {{-- Blog Table --}}
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Published</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->author }}</td>
                <td>{{ $blog->is_published ? 'Yes' : 'No' }}</td>
                <td>{{ $blog->category }}</td>
                <td>{{ $blog->tags }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editBlogModal{{ $blog->id }}">Edit</button>
                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this blog?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            {{-- Edit Blog Modal --}}
            <div class="modal fade" id="editBlogModal{{ $blog->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Blog</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body row g-3">
                                <div class="col-md-6">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
                                </div>
                                <div class="col-md-6">
                                    <label>Author</label>
                                    <input type="text" name="author" class="form-control" value="{{ $blog->author }}">
                                </div>
                                <div class="col-12">
                                    <label>Content</label>
                                    <textarea name="content" class="form-control">{{ $blog->content }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label>Category</label>
                                    <input type="text" name="category" class="form-control" value="{{ $blog->category }}">
                                </div>
                                <div class="col-md-6">
                                    <label>Tags (comma-separated)</label>
                                    <input type="text" name="tags" class="form-control" value="{{ $blog->tags }}">
                                </div>
                                <div class="col-md-6">
                                    <label>Publish?</label>
                                    <select name="is_published" class="form-control">
                                        <option value="1" {{ $blog->is_published ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$blog->is_published ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Published At</label>
                                    <input type="datetime-local" name="published_at" class="form-control" 
                                           value="{{ \Carbon\Carbon::parse($blog->published_at)->format('Y-m-d\TH:i') }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Update Blog</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>
</div>

{{-- Create Blog Modal --}}
<div class="modal fade" id="createBlogModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('blogs.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Author</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label>Content</label>
                        <textarea name="content" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Category</label>
                        <input type="text" name="category" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Tags (comma-separated)</label>
                        <input type="text" name="tags" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Publish?</label>
                        <select name="is_published" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0" selected>No</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Published At</label>
                        <input type="datetime-local" name="published_at" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create Blog</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
