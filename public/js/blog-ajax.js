/**
 * Blog AJAX Functionality
 * Handles all AJAX requests for blog filtering, searching, and dynamic updates
 */

$(document).ready(function() {
    
    /**
     * Initialize tooltips (if using Bootstrap tooltips)
     */
    initializeTooltips();
    
    /**
     * Blog filtering via AJAX
     */
    function filterBlogs(filterType, filterValue) {
        // Show loading state
        showLoadingState();
        
        // Prepare AJAX URL and data
        let url = '/';
        let ajaxData = {};

        if (filterType === 'category' && filterValue) {
            url = '{{ route("filter.category") }}' || '/filter-category';
            ajaxData = { category: filterValue };
        } else if (filterType === 'date' && filterValue) {
            url = '{{ route("filter.date") }}' || '/filter-date';
            ajaxData = { start_date: filterValue, end_date: filterValue };
        } else if (filterType === 'search' && filterValue) {
            url = '{{ route("search") }}' || '/search';
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
            dataType: 'html',
            success: function(response) {
                $('#blogContainer').html(response);
                $('#paginationContainer').html('');
                hideLoadingState();
                
                // Show success message
                showNotification('Blogs loaded successfully', 'success');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                hideLoadingState();
                
                // Show error message
                showNotification('An error occurred while filtering blogs. Please try again.', 'error');
            }
        });
    }
    
    /**
     * Show loading spinner
     */
    function showLoadingState() {
        if ($('#loadingSpinner').length) {
            $('#loadingSpinner').removeClass('d-none');
        }
    }
    
    /**
     * Hide loading spinner
     */
    function hideLoadingState() {
        if ($('#loadingSpinner').length) {
            $('#loadingSpinner').addClass('d-none');
        }
    }
    
    /**
     * Show notifications
     */
    function showNotification(message, type) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        
        const alert = $(`
            <div class="alert ${alertClass} alert-dismissible fade show m-3" role="alert">
                <i class="fas ${icon}"></i> ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `);
        
        $('main').prepend(alert);
        
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            alert.fadeOut(() => alert.remove());
        }, 5000);
    }
    
    /**
     * Initialize Bootstrap tooltips
     */
    function initializeTooltips() {
        if (typeof bootstrap !== 'undefined') {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    }
    
    /**
     * Make filterBlogs function globally available
     */
    window.filterBlogs = filterBlogs;
    window.showNotification = showNotification;
});

