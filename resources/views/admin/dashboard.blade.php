@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard - Manage All Blogs')

@section('content')

<!-- Stats Row -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-file-alt fa-3x text-primary mb-3"></i>
                <h6 class="card-title">Total Blogs</h6>
                <h3 class="text-primary">{{ $blogs->total() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-plus-circle fa-3x text-success mb-3"></i>
                <h6 class="card-title">Quick Action</h6>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Add New Blog
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-home fa-3x text-info mb-3"></i>
                <h6 class="card-title">View Website</h6>
                <a href="{{ route('home') }}" class="btn btn-info btn-sm" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Visit
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Blogs Table -->
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-list"></i> All Blogs</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="5%">#</th>
                    <th width="40%">Title</th>
                    <th width="15%">Category</th>
                    <th width="15%">Date</th>
                    <th width="25%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td>
                        <strong>{{ $loop->iteration }}</strong>
                    </td>
                    <td>
                        <strong class="text-dark d-block">{{ Str::limit($blog->title, 40) }}</strong>
                        <small class="text-muted">{{ Str::limit($blog->short_description, 60) }}</small>
                    </td>
                    <td>
                        <span class="badge bg-info">{{ ucfirst($blog->category) }}</span>
                    </td>
                    <td>
                        <small class="text-muted">
                            <i class="fas fa-calendar"></i> 
                            {{ $blog->created_at->format('M d, Y') }}
                        </small>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-sm btn-primary" title="Edit Blog">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.blog.delete', $blog->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')" title="Delete Blog">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                            <a href="{{ route('blog.detail', $blog->id) }}" class="btn btn-sm btn-secondary" target="_blank" title="View Blog">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3 d-block" style="opacity: 0.5;"></i>
                        <p class="text-muted mb-3">No blogs found. Start by creating a new blog!</p>
                        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create First Blog
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($blogs->hasPages())
    <div class="card-footer">
        {{ $blogs->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection
