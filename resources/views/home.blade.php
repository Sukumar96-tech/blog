@extends('layouts.app')

@section('title', 'Home - BlogHub')

@section('content')
<div class="container-lg">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-lg-12 text-center">
            <h1 class="display-4 fw-bold mb-3">Welcome to BlogHub</h1>
            <p class="lead text-muted">Discover amazing stories and insights from our collection of blogs</p>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="filter-section">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="categoryFilter" class="form-label"><i class="fas fa-folder"></i> Category</label>
                <select id="categoryFilter" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="dateFilter" class="form-label"><i class="fas fa-calendar"></i> Date Range</label>
                <input type="date" id="dateFilter" class="form-control" placeholder="Start Date">
            </div>
            <div class="col-md-4">
                <label for="searchInput" class="form-label"><i class="fas fa-search"></i> Search</label>
                <input type="text" id="searchInput" class="form-control" placeholder="Search blogs...">
            </div>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div id="loadingSpinner" class="text-center d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Blog Cards Container -->
    <div id="blogContainer" class="row g-4">
        @include('partials.blog_cards', ['blogs' => $blogs])
    </div>

    <!-- Pagination -->
    <div id="paginationContainer" class="row mt-5">
        <div class="col-12">
            {{ $blogs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection

@section('custom-js')
<script>
$(document).ready(function() {
    // Handle category filter
    $('#categoryFilter').on('change', function() {
        filterBlogs('category', $(this).val());
    });

    // Handle date filter
    $('#dateFilter').on('change', function() {
        filterBlogs('date', $(this).val());
    });

    // Handle search filter with debounce
    let searchTimeout;
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            filterBlogs('search', $(this).val());
        }, 300);
    });

    function filterBlogs(filterType, filterValue) {
        // Show loading spinner
        $('#loadingSpinner').removeClass('d-none');
        
        // Prepare AJAX URL and data
        let url = '/';
        let ajaxData = {};

        if (filterType === 'category' && filterValue) {
            url = '{{ route("filter.category") }}';
            ajaxData = { category: filterValue };
        } else if (filterType === 'date' && filterValue) {
            url = '{{ route("filter.date") }}';
            ajaxData = { start_date: filterValue, end_date: filterValue };
        } else if (filterType === 'search' && filterValue) {
            url = '{{ route("search") }}';
            ajaxData = { q: filterValue };
        } else if (!filterValue) {
            // Reset to show all blogs
            location.reload();
            return;
        }

        // Make AJAX request
        $.ajax({
            url: url,
            type: 'GET',
            data: ajaxData,
            success: function(response) {
                $('#blogContainer').html(response);
                $('#paginationContainer').html('');
                $('#loadingSpinner').addClass('d-none');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                $('#loadingSpinner').addClass('d-none');
                alert('An error occurred while filtering blogs.');
            }
        });
    }
});
</script>
@endsection
