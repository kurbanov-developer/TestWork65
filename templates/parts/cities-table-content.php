<?php
global $wpdb;

$search = sanitize_text_field($_POST['search'] ?? '');
$sql = "SELECT p.ID, p.post_title AS city, t.name AS country
        FROM {$wpdb->prefix}posts p
        LEFT JOIN {$wpdb->prefix}term_relationships tr ON p.ID = tr.object_id
        LEFT JOIN {$wpdb->prefix}term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        LEFT JOIN {$wpdb->prefix}terms t ON tt.term_id = t.term_id
        WHERE p.post_type = 'city' AND p.post_status = 'publish'
        " . ($search ? $wpdb->prepare("AND p.post_title LIKE %s", '%' . $wpdb->esc_like($search) . '%') : '');

$results = $wpdb->get_results($sql);

echo "<table><thead><tr><th>Country</th><th>City</th><th>Temperature</th></tr></thead><tbody>";
foreach ($results as $row) {
    $lat = get_post_meta($row->ID, '_latitude', true);
    $lon = get_post_meta($row->ID, '_longitude', true);
    $temp = 'N/A';

    if ($lat && $lon) {
        $api_key = 'YOUR_OPENWEATHERMAP_API_KEY';
        $response = wp_remote_get("https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&units=metric&appid=$api_key");
        if (!is_wp_error($response)) {
            $data = json_decode(wp_remote_retrieve_body($response));
            $temp = $data->main->temp ?? 'N/A';
        }
    }

    echo "<tr><td>{$row->country}</td><td>{$row->city}</td><td>{$temp} °C</td></tr>";
}
echo "</tbody></table>";
