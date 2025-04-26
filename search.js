jQuery(document).ready(function ($) {
    $('#city-search').on('input', function () {
        const searchTerm = $(this).val();

        $.ajax({
            url: cities_ajax.ajax_url,
            type: 'GET',
            dataType: 'json',
            data: {
                action: 'search_cities',
                term: searchTerm
            },
            success: function (data) {
                $('#cities-table tbody tr').each(function () {
                    const cityName = $(this).find('.city-name').text().toLowerCase();
                    if (cityName.includes(searchTerm.toLowerCase())) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });
    });
});
