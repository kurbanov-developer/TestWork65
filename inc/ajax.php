<?php
function ajax_filter_cities_table() {
    include get_stylesheet_directory() . '/templates/parts/cities-table-content.php';
    wp_die();
}
add_action('wp_ajax_filter_cities', 'ajax_filter_cities_table');
add_action('wp_ajax_nopriv_filter_cities', 'ajax_filter_cities_table');
