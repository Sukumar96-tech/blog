@forelse($blogs as $blog)

    <div class="col-md-6 col-lg-4">

        <div class="card blog-card h-100 shadow-sm">

            @if($blog->image)

                <img src="{{ secure_asset($blog->image) }}"
                     class="card-img-top"
                     alt="{{ $blog->title }}"
                     style="height: 220px; object-fit: cover;">

            @else

                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center"
                     style="height: 220px;">

                    <i class="fas fa-image text-white"
                       style="font-size: 3rem; opacity: 0.5;"></i>

                </div>

            @endif

            <div class="blog-card-body d-flex flex-column">

                <span class="card-category">
                    {{ ucfirst($blog->category) }}
                </span>

                <h5 class="card-title mt-2">
                    {{ Str::limit($blog->title, 60) }}
                </h5>

                <p class="card-text text-muted flex-grow-1"
                   style="min-height: 60px;">

                    {{ Str::limit($blog->short_description, 100) }}

                </p>

                <div class="d-flex justify-content-between align-items-center mt-3">

                    <small class="card-date">

                        <i class="fas fa-calendar-alt"></i>

                        {{ $blog->created_at->format('M d, Y') }}

                    </small>

                    <a href="{{ secure_url('/blog/' . $blog->id) }}"
                       class="btn btn-sm btn-primary">

                        Read More
                        <i class="fas fa-arrow-right ms-1"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

@empty

    <div class="col-12">

        <div class="no-results text-center py-5">

            <i class="fas fa-inbox mb-3"
               style="font-size: 4rem; opacity: 0.5;"></i>

            <h4>No Blogs Found</h4>

            <p class="text-muted">
                Try adjusting your search or filter criteria.
            </p>

        </div>

    </div>

@endforelse