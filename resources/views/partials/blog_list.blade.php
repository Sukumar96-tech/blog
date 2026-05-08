<div class="row">
    @forelse($blogs as $blog)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $blog->title }}</h5>
                    <p class="card-text">{{ $blog->short_description }}</p>
                    <p class="card-text"><small class="text-muted">{{ $blog->category }} | {{ $blog->created_at->format('M d, Y') }}</small></p>
                    <a href="{{ url('/blog/' . $blog->id) }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">No blogs found.</div>
        </div>
    @endforelse
</div>
