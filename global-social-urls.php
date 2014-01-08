<?php
/*
Plugin Name: Global Social Network Profile URLs
Plugin URI: https://github.com/VitalDevTeam/global-social-urls
Description: Creates admin page in Settings menu for managing social profile URLs. Call URLs via global variable in your templates. Example: echo TWITTER_URL;
Version: 1.0
Author: Vital Dev Team
Author URI: http://vtldesign.com
*/


/*  Setup
   -------------------------------------------------------------------------- */

$vtl_social_settings = array();

if ( is_admin() ) :

    // Register settings and call sanitation functions
    function vtl_social_settings_register() {
        register_setting(
            'vtl_social_settings_options',
            'vtl_social_settings',
            'vtl_social_settings_validate'
        );
    }
    add_action( 'admin_init', 'vtl_social_settings_register' );

    // Add theme options page to the admin menu
    function vtl_social_settings_options() {
        add_options_page(
            'Social',
            'Social',
            'edit_theme_options',
            'social_settings',
            'vtl_social_settings_page'
        );
    }
    add_action( 'admin_menu', 'vtl_social_settings_options' );


    // Generate options page
    function vtl_social_settings_page() {
        global $vtl_social_settings;

        if ( ! isset( $_REQUEST['updated'] ) )
            $_REQUEST['updated'] = false; ?>

        <div class="wrap">

            <h2>Social Network Profiles</h2>
            <p>Enter the URLs of your social network profiles.</p>

            <?php if ( false !== $_REQUEST['updated'] ) : ?>
            <div class="updated fade"><p><strong><?php _e( 'Settings saved' ); ?></strong></p></div>
            <?php endif; ?>

            <form method="post" action="options.php">

                <?php $social_urls = get_option( 'vtl_social_settings', $vtl_social_settings ); ?>

                <?php settings_fields( 'vtl_social_settings_options' ); ?>

                <table class="form-table">

                    <tr valign="top">
                        <th scope="row"><label for="twitter_url">Twitter</label></th>
                        <td><code>http://</code><input id="twitter_url" name="vtl_social_settings[twitter_url]" type="text" value="<?php esc_attr_e($social_urls['twitter_url']); ?>" class="regular-text" placeholder="twitter.com/username" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="facebook_url">Facebook</label></th>
                        <td><code>http://</code><input id="facebook_url" name="vtl_social_settings[facebook_url]" type="text" value="<?php esc_attr_e($social_urls['facebook_url']); ?>" class="regular-text" placeholder="facebook.com/username" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="google_url">Google+</label></th>
                        <td><code>http://</code><input id="google_url" name="vtl_social_settings[google_url]" type="text" value="<?php esc_attr_e($social_urls['google_url']); ?>" class="regular-text" placeholder="plus.google.com/11001001" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="youtube_url">YouTube</label></th>
                        <td><code>http://</code><input id="youtube_url" name="vtl_social_settings[youtube_url]" type="text" value="<?php esc_attr_e($social_urls['youtube_url']); ?>" class="regular-text" placeholder="youtube.com/user/username" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="linkedin_url">LinkedIn</label></th>
                        <td><code>http://</code><input id="linkedin_url" name="vtl_social_settings[linkedin_url]" type="text" value="<?php esc_attr_e($social_urls['linkedin_url']); ?>" class="regular-text" placeholder="linkedin.com/company/username" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="instagram_url">Instagram</label></th>
                        <td><code>http://</code><input id="instagram_url" name="vtl_social_settings[instagram_url]" type="text" value="<?php esc_attr_e($social_urls['instagram_url']); ?>" class="regular-text" placeholder="instagram.com/username" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="pinterest_url">Pinterest</label></th>
                        <td><code>http://</code><input id="pinterest_url" name="vtl_social_settings[pinterest_url]" type="text" value="<?php esc_attr_e($social_urls['pinterest_url']); ?>" class="regular-text" placeholder="pinterest.com/username" /></td>
                    </tr>
                </table>

                <p class="submit"><input type="submit" class="button-primary" value="Save Changes" /></p>

            </form>

        </div>

        <?php
    }

    // Validate and sanitize entries
    function vtl_social_settings_validate( $input ) {
        global $vtl_social_settings;

        $social_urls = get_option( 'vtl_social_settings', $vtl_social_settings );

        $input['twitter_url'] = wp_filter_nohtml_kses( $input['twitter_url'] );
        $input['facebook_url'] = wp_filter_nohtml_kses( $input['facebook_url'] );
        $input['google_url'] = wp_filter_nohtml_kses( $input['google_url'] );
        $input['youtube_url'] = wp_filter_nohtml_kses( $input['youtube_url'] );
        $input['linkedin_url'] = wp_filter_nohtml_kses( $input['linkedin_url'] );
        $input['instagram_url'] = wp_filter_nohtml_kses( $input['instagram_url'] );
        $input['pinterest_url'] = wp_filter_nohtml_kses( $input['pinterest_url'] );

        return $input;
    }

endif;  // EndIf is_admin()


/*  Initialize and define
   -------------------------------------------------------------------------- */

global $vtl_social_settings;
$social_urls = get_option( 'vtl_social_settings', $vtl_social_settings );

if ( empty($social_urls['twitter_url']) ) {
    define('TWITTER_URL', 'http://twitter.com');
} else {
    define('TWITTER_URL', 'http://' . $social_urls['twitter_url']);
}

if ( empty($social_urls['facebook_url']) ) {
    define('FACEBOOK_URL', 'http://facebook.com');
} else {
    define('FACEBOOK_URL', 'http://' . $social_urls['facebook_url']);
}

if ( empty($social_urls['google_url']) ) {
    define('GOOGLE_URL', 'http://plus.google.com');
} else {
    define('GOOGLE_URL', 'http://' . $social_urls['google_url']);
}

if ( empty($social_urls['youtube_url']) ) {
    define('YOUTUBE_URL', 'http://youtube.com');
} else {
    define('YOUTUBE_URL', 'http://' . $social_urls['youtube_url']);
}

if ( empty($social_urls['linkedin_url']) ) {
    define('LINKEDIN_URL', 'http://linkedin.com');
} else {
    define('LINKEDIN_URL', 'http://' . $social_urls['linkedin_url']);
}

if ( empty($social_urls['instagram_url']) ) {
    define('INSTAGRAM_URL', 'http://instagram.com');
} else {
    define('INSTAGRAM_URL', 'http://' . $social_urls['instagram_url']);
}

if ( empty($social_urls['pinterest_url']) ) {
    define('PINTEREST_URL', 'http://pinterest.com');
} else {
    define('PINTEREST_URL', 'http://' . $social_urls['pinterest_url']);
}