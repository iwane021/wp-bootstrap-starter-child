<?php

// Include php files
include get_theme_file_path('/includes/shortcodes.php');

// Enqueue needed scripts
function needed_styles_and_scripts_enqueue() {
    
    // Add-ons

    
    // Custom script
    wp_enqueue_script( 'wpbs-custom-script', get_stylesheet_directory_uri() . '/assets/javascript/script.js' , array( 'jquery' ) );

    // enqueue style
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );


}
add_action( 'wp_enqueue_scripts', 'needed_styles_and_scripts_enqueue' );

function cc_mime_types($mimes) {
$mimes['svg'] = 'image/svg+xml';
return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


add_filter( 'widget_text', 'do_shortcode' );

//Dynamic Year
function site_year(){
	ob_start();
	echo date( 'Y' );
	$output = ob_get_clean();
    return $output;
}
add_shortcode( 'site_year', 'site_year' );

// The excerpt count
function custom_letter_count($content, $limit) {
    $striped_content = strip_tags($content);
    $striped_content = strip_shortcodes($striped_content);
    $limit_content = mb_substr($striped_content, 0 , $limit );

    if( strlen($limit_content) < strlen($content) ){
        $limit_content .= "..."; 
    }
    return $limit_content;
}

// Register and enqueue navigation.js.
add_action('wp_enqueue_scripts', 'navigation_scripts_styles' );
function navigation_scripts_styles() {
    wp_enqueue_style( 'genericons', get_stylesheet_directory_uri() . '/assets/css/genericons/genericons.css', array(), '3.4.1' );
    wp_enqueue_script( 'jquery-navigation', get_stylesheet_directory_uri() . '/assets/javascript/navigation.js', array( 'jquery' ), '1.0.0' );
}

// remove meta generator version wp
remove_action('wp_head', 'wp_generator');
function custom_remove_version() {
    return '';
}
add_filter('the_generator', 'custom_remove_version');

// Remove WP Logo Admin
function remove_custom_login_logo() {
    echo '<style type="text/css">
        .login h1 a { background-image:none !important; display:unset !important; font-size:1.5em !important; font-weight:bold; }
    </style>';
}
add_filter( 'login_head', 'remove_custom_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function admin_login_logo_url_title() {
    return 'Admin Panel';
}
add_filter( 'login_headertitle', 'admin_login_logo_url_title' );

/* -- Start Custom CMS Dashboard -- */
function admin_bar_remove_logo() {
    // if ( ! current_user_can( 'manage_options' ) ) {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu( 'wp-logo' );
    // }
}
add_action( 'wp_before_admin_bar_render', 'admin_bar_remove_logo', 0 );

function admin_bar_edit_link_user() {
    if ( ! current_user_can( 'manage_options' ) ) {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu( 'edit-profile' );
    }
}
add_action( 'wp_before_admin_bar_render', 'admin_bar_edit_link_user', 0 );

function admin_remove_screen_options() { 
    if ( ! current_user_can( 'manage_options' ) ) {
        return false;
    }
        return true; 
}
add_filter('screen_options_show_screen', 'admin_remove_screen_options');

// Hide all update notifications like plugins, wordpress upgrade etc.
function admin_custom_style() {
    if ( ! current_user_can( 'manage_options' ) ) {
        echo '<style type="text/css">
        #wp-admin-bar-wp-logo, #wp-admin-bar-updates, #wp-admin-bar-comments, #wp-admin-bar-new-content,
        #dashboard_right_now .b-tags, 
        #dashboard_right_now .tags, 
        #dashboard_right_now .b-comments, 
        #dashboard_right_now .comments,#dashboard_right_now .b-posts, 
        #dashboard_right_now .posts,
        #dashboard_right_now .table_discussion, 
        #screen-meta-links, 
        .plugin-version-author-uri, .plugin-update-tr, .update-plugins, .update-nag, 
        #wp-version-message, 
        #dashboard_right_now .main p {
               display:none;
        }
        </style>';
    }
}
add_action('admin_init', 'admin_custom_style');

// Remove WP admin dashboard widgets
function admin_disable_dashboard_widgets() {
    // remove_meta_box('dashboard_right_now', 'dashboard', 'normal');// Remove "At a Glance"
    // remove_meta_box('dashboard_activity', 'dashboard', 'normal');// Remove "Activity" which includes "Recent Comments"
    // remove_meta_box('dashboard_quick_press', 'dashboard', 'side');// Remove Quick Draft
    remove_meta_box('dashboard_primary', 'dashboard', 'core');// Remove WordPress Events and News
}
add_action('admin_menu', 'admin_disable_dashboard_widgets');

// hide update notifications for other user admin else
function remove_core_updates(){
    if ( ! current_user_can( 'manage_options' ) ) {
        global $wp_version;
        return(object) array('last_checked'=> time(),'version_checked'=> $wp_version);
    }
}
add_filter('pre_site_transient_update_core','remove_core_updates'); //hide updates for WordPress itself
add_filter('pre_site_transient_update_plugins','remove_core_updates'); //hide updates for all plugins
add_filter('pre_site_transient_update_themes','remove_core_updates'); //hide updates for all themes

function admin_hide_help() { 
    $screen = get_current_screen();
    $screen->remove_help_tabs();
}
add_action('contextual_help', 'admin_hide_help');

// Remove menu if user not administrator
function admin_remove_menus() {
    if ( ! current_user_can( 'manage_options' ) ) {
        remove_menu_page( 'themes.php' );          // Appearance
        remove_menu_page( 'plugins.php' );         // Plugins
        remove_menu_page( 'users.php' );           // Users
        remove_menu_page( 'profile.php' );         // Profile
        remove_menu_page( 'tools.php' );           // Tools
        remove_menu_page( 'options-general.php' ); // Settings
    }
}
add_action( 'admin_menu', 'admin_remove_menus' );

// Hide admin footer dashboard
function change_footer_admin () { echo '<span id="footer-thankyou">Developed by IT ADR</span>'; }
add_filter('admin_footer_text', 'change_footer_admin');
function change_footer_version() { return ''; }
add_filter( 'update_footer', 'change_footer_version', 9999);