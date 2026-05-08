/**
 * Blog AJAX Functionality
 */

$(document).ready(function () {

    // IMPORTANT: use current origin to avoid mixed-content (http/https) issues
    const BASE_URL = window.location.origin;

    initializeTooltips();

    /**
     * Filter Blogs
     */
    function filterBlogs(filterType, filterValue) {

        showLoadingState();

        let url = '';
        let ajaxData = {};

        // Category Filter
        if (filterType === 'category' && filterValue) {

            url = BASE_URL + '/filter-category';

            ajaxData = {
                category: filterValue
            };
        }

        // Date Filter
        else if (filterType === 'date' && filterValue) {

            url = BASE_URL + '/filter-date';

            ajaxData = {
                start_date: filterValue,
                end_date: filterValue
            };
        }

        // Search Filter
        else if (filterType === 'search' && filterValue) {

            url = BASE_URL + '/search';

            ajaxData = {
                q: filterValue
            };
        }

        // Reset
        else if (!filterValue) {

            location.reload();

            return;
        }

        // AJAX Request
        $.ajax({

            url: url,

            type: 'GET',

            data: ajaxData,

            success: function (response) {

                console.log("SUCCESS RESPONSE:", response);

                // JSON response
                if (response.html) {

                    $('#blogContainer').html(response.html);

                } else {

                    $('#blogContainer').html(response);
                }

                $('#paginationContainer').html('');

                hideLoadingState();
            },

            error: function (xhr, status, error) {

                console.log("STATUS:", status);

                console.log("ERROR:", error);

                console.log("FULL RESPONSE:", xhr.responseText);

                hideLoadingState();

                alert("Check browser console for actual Laravel error.");
            }
        });
    }

    /**
     * Show Loading
     */
    function showLoadingState() {

        if ($('#loadingSpinner').length) {

            $('#loadingSpinner').removeClass('d-none');
        }
    }

    /**
     * Hide Loading
     */
    function hideLoadingState() {

        if ($('#loadingSpinner').length) {

            $('#loadingSpinner').addClass('d-none');
        }
    }

    /**
     * Tooltips
     */
    function initializeTooltips() {

        if (typeof bootstrap !== 'undefined') {

            const tooltipTriggerList = [].slice.call(
                document.querySelectorAll('[data-bs-toggle="tooltip"]')
            );

            tooltipTriggerList.map(function (tooltipTriggerEl) {

                return new bootstrap.Tooltip(tooltipTriggerEl);

            });
        }
    }

    // Global functions
    window.filterBlogs = filterBlogs;
});