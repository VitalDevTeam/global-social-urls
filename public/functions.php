<?php
if (!defined('ABSPATH')) exit;

if (!function_exists('get_social_url')) {

    /**
     * Get social profile URL option from the database
     */
    function get_social_url($id = null) {
        if ($id === null) return;
        $url = get_option('snp_' . $id . '_url');
        if (!empty($url)) {
            return $url;
        }
    }

}