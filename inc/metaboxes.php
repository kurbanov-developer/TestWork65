<?php
// Добавляем метабокс
function add_city_meta_box() {
    add_meta_box('city_coords', 'Географические координаты', 'render_city_coords_box', 'city', 'normal', 'default');
}
add_action('add_meta_boxes', 'add_city_meta_box');

function render_city_coords_box($post) {
    $latitude = get_post_meta($post->ID, '_latitude', true);
    $longitude = get_post_meta($post->ID, '_longitude', true);
    wp_nonce_field('save_city_meta', 'city_meta_nonce');
    ?>
    <label>Широта:</label>
    <input type="text" name="latitude" value="<?php echo esc_attr($latitude); ?>" /><br>
    <label>Долгота:</label>
    <input type="text" name="longitude" value="<?php echo esc_attr($longitude); ?>" />
    <?php
}

function save_city_meta($post_id) {
    if (!isset($_POST['city_meta_nonce']) || !wp_verify_nonce($_POST['city_meta_nonce'], 'save_city_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, '_latitude', sanitize_text_field($_POST['latitude']));
    update_post_meta($post_id, '_longitude', sanitize_text_field($_POST['longitude']));
}
add_action('save_post', 'save_city_meta');
