<?php
// Подключение основных файлов функционала
require_once get_stylesheet_directory() . '/inc/custom-post-types.php';
require_once get_stylesheet_directory() . '/inc/custom-taxonomies.php';
require_once get_stylesheet_directory() . '/inc/metaboxes.php';
require_once get_stylesheet_directory() . '/inc/widgets.php';
require_once get_stylesheet_directory() . '/inc/ajax.php';

// Подключение JavaScript для AJAX-поиска по городам
function cities_table_scripts() {
    wp_enqueue_script(
        'cities-search',
        get_stylesheet_directory_uri() . '/search.js',
        ['jquery'],
        null,
        true
    );

    // Передаём URL для AJAX-запросов в JS
    wp_localize_script('cities-search', 'cities_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'cities_table_scripts');
