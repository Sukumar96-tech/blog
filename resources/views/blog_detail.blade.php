@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<div class="container-lg">
    <div class="row">
        <!-- Main Blog Content -->
        <div class="col-lg-8">
            <!-- Blog Header -->
            <div class="mb-4">
                @if($blog->image)
                    <img src="{{ asset($blog->image) }}" class="img-fluid rounded" alt="{{ $blog->title }}" style="max-height: 500px; object-fit: cover; width: 100%;">
                @else
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="height: 400px;">
                        <i class="fas fa-image text-white" style="font-size: 5rem; opacity: 0.5;"></i>
                    </div>
                @endif
            </div>

            <!-- Blog Meta Information -->
            <div class="mb-4">
                <div class="d-flex flex-wrap gap-3 align-items-center mb-3">
                    <span class="badge bg-primary">{{ ucfirst($blog->category) }}</span>
                    <small class="text-muted">
                        <i class="fas fa-calendar-alt"></i> 
                        Published on {{ $blog->created_at->format('F d, Y \a\t g:i A') }}
                    </small>
                </div>
            </div>

            <!-- Blog Title -->
            <h1 class="mb-3 fw-bold">{{ $blog->title }}</h1>

            <!-- Blog Short Description -->
            <p class="lead text-muted mb-4">{{ $blog->short_description }}</p>

            <!-- Divider -->
            <hr class="my-4">

            <!-- Blog Content -->
            <div class="blog-content mb-5">
                {!! nl2br(e($blog->content)) !!}
            </div>

            <!-- Back to Home Button -->
            <div class="mb-5">
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-arrow-left"></i> Back to Blogs
                </a>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Related Blogs -->
            @if($relatedBlogs->count() > 0)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-link"></i> Related Blogs</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($relatedBlogs as $related)
                        <a href="{{ route('blog.detail', $related->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ Str::limit($related->title, 50) }}</h6>
                                    <small class="text-muted d-block">{{ $related->created_at->format('M d, Y') }}</small>
                                </div>
                                <i class="fas fa-chevron-right text-primary"></i>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Blog Stats -->
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title mb-3">Blog Information</h5>
                    <div class="row">
                        <div class="col-6 mb-2">
                            <strong class="d-block text-primary">
                                <i class="fas fa-folder"></i> Category
                            </strong>
                            <small>{{ ucfirst($blog->category) }}</small>
                        </div>
                        <div class="col-6 mb-2">
                            <strong class="d-block text-primary">
                                <i class="fas fa-calendar-check"></i> Updated
                            </strong>
                            <small>{{ $blog->updated_at->format('M d, Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.blog-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #333;
}

.blog-content p {
    margin-bottom: 1rem;
}
</style>

@endsection
