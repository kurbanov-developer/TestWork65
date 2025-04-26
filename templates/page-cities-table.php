<?php
/**
 * Template Name: Cities Table
 */
get_header();
do_action('cities_table_before'); ?>

<div class="wrap">
    <input type="text" id="city-search" placeholder="Search cities..." />
    <div id="cities-table">
        <?php get_template_part('templates/parts/cities-table-content'); ?>
    </div>
</div>

<?php do_action('cities_table_after');
get_footer();
