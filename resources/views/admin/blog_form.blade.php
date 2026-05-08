@extends('layouts.app')
@section('title', isset($blog) ? 'Edit Blog' : 'Add Blog')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ isset($blog) ? 'Edit Blog' : 'Add Blog' }}</div>
            <div class="card-body">
                <form method="POST" action="{{ isset($blog) ? url('/admin/blog/'.$blog->id.'/update') : url('/admin/blog/store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description</label>
                        <input type="text" class="form-control" id="short_description" name="short_description" value="{{ $blog->short_description ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required>{{ $blog->content ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" name="category" value="{{ $blog->category ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if(isset($blog) && $blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Current Image" class="img-thumbnail mt-2" width="120">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ isset($blog) ? $blog->created_at->format('Y-m-d') : '' }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ isset($blog) ? 'Update' : 'Add' }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
