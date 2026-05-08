@extends('layouts.admin')

@section('title', 'Edit Blog: ' . $blog->title)
@section('page-title', 'Edit Blog: ' . Str::limit($blog->title, 50))

@section('content')

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-edit"></i> Edit Blog Post</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.blog.update', $blog->id) }}" enctype="multipart/form-data" novalidate>
            @csrf
            @include('admin.blog.form', ['blog' => $blog])
        </form>
    </div>
</div>

@endsection