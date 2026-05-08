@extends('layouts.app')

@section('title', 'Home - BlogHub')

@section('content')

<div class="container-lg">

    <!-- Hero Section -->
    <div class="row mb-5">

        <div class="col-lg-12 text-center">

            <h1 class="display-4 fw-bold mb-3">
                Welcome to BlogHub
            </h1>

            <p class="lead text-muted">
                Discover amazing stories and insights from our collection of blogs
            </p>

        </div>

    </div>

    <!-- Filters Section -->
    <div class="filter-section">

        <div class="row g-3">

            <div class="col-md-4">

                <label for="categoryFilter" class="form-label">
                    <i class="fas fa-folder"></i>
                    Category
                </label>

                <select id="categoryFilter" class="form-select">

                    <option value="">
                        All Categories
                    </option>

                    @foreach($categories as $category)

                        <option value="{{ $category }}">

                            {{ ucfirst($category) }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-4">

                <label for="dateFilter" class="form-label">
                    <i class="fas fa-calendar"></i>
                    Date Range
                </label>

                <input type="date"
                       id="dateFilter"
                       class="form-control">

            </div>

            <div class="col-md-4">

                <label for="searchInput" class="form-label">
                    <i class="fas fa-search"></i>
                    Search
                </label>

                <input type="text"
                       id="searchInput"
                       class="form-control"
                       placeholder="Search blogs...">

            </div>

        </div>

    </div>

    <!-- Loading Spinner -->
    <div id="loadingSpinner"
         class="text-center d-none my-4">

        <div class="spinner-border text-primary"
             role="status">

            <span class="visually-hidden">
                Loading...
            </span>

        </div>

    </div>

    <!-- Blog Cards -->
    <div id="blogContainer" class="row g-4">

        @include('partials.blog_cards', ['blogs' => $blogs])

    </div>

    <!-- Pagination -->
    <div id="paginationContainer"
         class="row mt-5">

        <div class="col-12">

            {{ $blogs->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>

@endsection

@section('custom-js')

<script>

$(document).ready(function () {

    const BASE_URL = "https://blog-management-system-u4yu.onrender.com";

    // Category Filter
    $('#categoryFilter').on('change', function () {

        filterBlogs(
            'category',
            $(this).val()
        );

    });

    // Date Filter
    $('#dateFilter').on('change', function () {

        filterBlogs(
            'date',
            $(this).val()
        );

    });

    // Search Filter
    let searchTimeout;

    $('#searchInput').on('keyup', function () {

        clearTimeout(searchTimeout);

        let value = $(this).val();

        searchTimeout = setTimeout(() => {

            filterBlogs(
                'search',
                value
            );

        }, 300);

    });

    // Main Filter Function
    function filterBlogs(filterType, filterValue) {

        $('#loadingSpinner').removeClass('d-none');

        let url = '';
        let ajaxData = {};

        // Category
        if (filterType === 'category' && filterValue) {

            url = BASE_URL + '/filter-category';

            ajaxData = {
                category: filterValue
            };
        }

        // Date
        else if (filterType === 'date' && filterValue) {

            url = BASE_URL + '/filter-date';

            ajaxData = {
                start_date: filterValue,
                end_date: filterValue
            };
        }

        // Search
        else if (filterType === 'search') {

            url = BASE_URL + '/search';

            ajaxData = {
                q: filterValue
            };
        }

        // Reset
        else {

            location.reload();

            return;
        }

        // AJAX
        $.ajax({

            url: url,

            type: 'GET',

            data: ajaxData,

            success: function (response) {

                if (response.html) {

                    $('#blogContainer').html(response.html);

                } else {

                    $('#blogContainer').html(response);
                }

                $('#paginationContainer').html('');

                $('#loadingSpinner').addClass('d-none');
            },

            error: function (xhr, status, error) {

                console.log(xhr.responseText);

                $('#loadingSpinner').addClass('d-none');

                alert('Filter failed. Check console.');
            }
        });

    }

});

</script>

@endsection