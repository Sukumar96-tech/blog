@extends('layouts.admin')

@section('title', 'Create New Blog')
@section('page-title', 'Create New Blog')

@section('content')

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Create New Blog Post</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data" novalidate>
            @csrf
            @include('admin.blog.form', ['blog' => null])
        </form>
    </div>
</div>

@endsection