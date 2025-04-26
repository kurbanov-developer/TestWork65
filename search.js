jQuery(function($){
    $('#city-search').on('input', function() {
        var search = $(this).val();
        $.post(cities_ajax.ajax_url, {
            action: 'filter_cities',
            search: search
        }, function(response) {
            $('#cities-table').html(response);
        });
    });
});
