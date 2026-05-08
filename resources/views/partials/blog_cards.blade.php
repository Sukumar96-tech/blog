@forelse($blogs as $blog)
    <div class="col-md-6 col-lg-4">
        <div class="card blog-card h-100">
            @if($blog->image)
                <img src="{{ asset($blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
            @else
                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="fas fa-image text-white" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            @endif
            
            <div class="blog-card-body">
                <span class="card-category">{{ ucfirst($blog->category) }}</span>
                
                <h5 class="card-title">{{ Str::limit($blog->title, 60) }}</h5>
                
                <p class="card-text text-muted" style="min-height: 60px;">
                    {{ Str::limit($blog->short_description, 100) }}
                </p>
                
                <div class="d-flex justify-content-between align-items-center">
                    <small class="card-date">
                        <i class="fas fa-calendar-alt"></i> 
                        {{ $blog->created_at->format('M d, Y') }}
                    </small>
                    
                    <a href="{{ route('blog.detail', $blog->id) }}" class="btn btn-sm btn-primary">
                        Read More <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="no-results">
            <i class="fas fa-inbox"></i>
            <h4>No Blogs Found</h4>
            <p class="text-muted">Try adjusting your search or filter criteria.</p>
        </div>
    </div>
@endforelse
