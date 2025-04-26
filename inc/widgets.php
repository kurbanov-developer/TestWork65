<?php
class City_Temperature_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct('city_temp_widget', 'City Temperature Widget');
    }

    public function form($instance) {
        $selected = isset($instance['city_id']) ? $instance['city_id'] : '';
        $cities = get_posts(['post_type' => 'city', 'numberposts' => -1]);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('city_id'); ?>">Select City:</label>
            <select name="<?php echo $this->get_field_name('city_id'); ?>" id="<?php echo $this->get_field_id('city_id'); ?>">
                <?php foreach ($cities as $city): ?>
                    <option value="<?php echo $city->ID; ?>" <?php selected($selected, $city->ID); ?>>
                        <?php echo esc_html($city->post_title); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        return ['city_id' => (int)$new_instance['city_id']];
    }

    public function widget($args, $instance) {
        $city_id = $instance['city_id'];
        $city_name = get_the_title($city_id);
        $lat = get_post_meta($city_id, '_latitude', true);
        $lon = get_post_meta($city_id, '_longitude', true);

        $api_key = 'YOUR_OPENWEATHERMAP_API_KEY';
        $response = wp_remote_get("https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&units=metric&appid=$api_key");

        if (!is_wp_error($response)) {
            $data = json_decode(wp_remote_retrieve_body($response));
            $temp = $data->main->temp ?? 'N/A';
            echo "<p><strong>{$city_name}</strong>: {$temp} °C</p>";
        }
    }
}
add_action('widgets_init', function() {
    register_widget('City_Temperature_Widget');
});
