<?php
/*
Plugin Name: MainWP RankMath NoIndex
Description: Sets RankMath to noindex for posts created from MainWP Dashboard.
Version: 1.3
Author: Joshua Garza
Author URI: https://mysocialpractice.com
*/

function ensure_rankmath_noindex_meta($post_id) {
    // Check if the post was created via MainWP by checking for the '_selected_clients' meta key
    if (get_post_meta($post_id, '_selected_clients', true)) {
        // Check if the post has the RankMath noindex meta set correctly
        $rankmath_meta = get_post_meta($post_id, 'rank_math_robots', true);
        error_log('RankMath current value for post ID ' . $post_id . ': ' . print_r($rankmath_meta, true)); // Log current value for debugging

        if ($rankmath_meta !== array('noindex')) {
            // Update RankMath SEO meta in serialized format
            update_post_meta($post_id, 'rank_math_robots', array('noindex'));
            error_log('RankMath noindex meta corrected for post ID: ' . $post_id); // Log the update for debugging
        }
    }
}
add_action('publish_post', 'ensure_rankmath_noindex_meta');
