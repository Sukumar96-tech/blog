<!-- Blog Form -->
<div class="row g-3">
    <div class="col-lg-8">
        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">
                <i class="fas fa-heading"></i> Blog Title <span class="text-danger">*</span>
            </label>
            <input 
                type="text" 
                class="form-control @error('title') is-invalid @enderror" 
                id="title" 
                name="title" 
                value="{{ old('title', $blog->title ?? '') }}"
                placeholder="Enter blog title"
                required
            >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label for="category" class="form-label">
                <i class="fas fa-folder"></i> Category <span class="text-danger">*</span>
            </label>
            <input 
                type="text" 
                class="form-control @error('category') is-invalid @enderror" 
                id="category" 
                name="category" 
                value="{{ old('category', $blog->category ?? '') }}"
                placeholder="e.g., Technology, Lifestyle, Business"
                required
            >
            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted d-block mt-1">
                <i class="fas fa-info-circle"></i> Enter a category to organize your blog
            </small>
        </div>

        <!-- Short Description -->
        <div class="mb-3">
            <label for="short_description" class="form-label">
                <i class="fas fa-align-left"></i> Short Description <span class="text-danger">*</span>
            </label>
            <textarea 
                class="form-control @error('short_description') is-invalid @enderror" 
                id="short_description" 
                name="short_description" 
                rows="3"
                placeholder="Enter a brief description of your blog (max 500 characters)"
                maxlength="500"
                required
            >{{ old('short_description', $blog->short_description ?? '') }}</textarea>
            <small class="form-text text-muted d-block mt-1">
                <span id="charCount">0</span> / 500 characters
            </small>
            @error('short_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Content -->
        <div class="mb-3">
            <label for="content" class="form-label">
                <i class="fas fa-pen-fancy"></i> Blog Content <span class="text-danger">*</span>
            </label>
            <textarea 
                class="form-control @error('content') is-invalid @enderror" 
                id="content" 
                name="content" 
                rows="10"
                placeholder="Enter your blog content here..."
                required
            >{{ old('content', $blog->content ?? '') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Image Upload -->
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="fas fa-image"></i> Blog Image</h6>
            </div>
            <div class="card-body">
                @if(isset($blog) && $blog->image)
                    <div class="mb-3 text-center">
                        <img src="{{ secure_asset($blog->image) }}" class="img-fluid rounded" style="max-height: 200px;">
                        <small class="d-block text-muted mt-2">Current Image</small>
                    </div>
                @endif
                
                <div class="mb-2">
                    <input 
                        type="file" 
                        class="form-control @error('image') is-invalid @enderror" 
                        id="image" 
                        name="image" 
                        accept="image/*"
                    >
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <small class="text-muted d-block">
                    <i class="fas fa-info-circle"></i> Supported formats: JPEG, PNG, JPG, GIF (Max 2MB)
                </small>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary w-100 mb-2">
                    <i class="fas fa-save"></i> {{ isset($blog) ? 'Update Blog' : 'Create Blog' }}
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Character count
document.getElementById('short_description').addEventListener('input', function() {
    document.getElementById('charCount').textContent = this.value.length;
});

// Set initial character count
document.getElementById('charCount').textContent = document.getElementById('short_description').value.length;

// Image preview
document.getElementById('image').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            if (document.querySelector('.img-preview')) {
                document.querySelector('.img-preview').remove();
            }
            const preview = document.createElement('div');
            preview.className = 'img-preview mb-3 text-center';
            preview.innerHTML = '<img src="' + e.target.result + '" class="img-fluid rounded" style="max-height: 200px;"><small class="d-block text-muted mt-2">Preview</small>';
            document.querySelector('#image').parentNode.insertBefore(preview, document.querySelector('#image').nextSibling);
        };
        reader.readAsDataURL(file);
    }
});
</script>
