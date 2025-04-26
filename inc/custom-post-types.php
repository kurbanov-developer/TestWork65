<?php
// Регистрируем CPT Cities
function register_cpt_cities() {
    $labels = [
        'name' => 'Cities',
        'singular_name' => 'City',
        'add_new' => 'Add New City',
        'edit_item' => 'Edit City',
        'new_item' => 'New City',
        'view_item' => 'View City',
        'search_items' => 'Search Cities',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'supports' => ['title'],
        'menu_icon' => 'dashicons-location',
        'show_in_rest' => true,
    ];

    register_post_type('city', $args);
}
add_action('init', 'register_cpt_cities');
