<?php
// Регистрируем таксономию Countries
function register_taxonomy_countries() {
    $labels = [
        'name' => 'Countries',
        'singular_name' => 'Country',
        'search_items' => 'Search Countries',
        'all_items' => 'All Countries',
        'edit_item' => 'Edit Country',
        'add_new_item' => 'Add New Country',
    ];

    $args = [
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
    ];

    register_taxonomy('country', 'city', $args);
}
add_action('init', 'register_taxonomy_countries');
