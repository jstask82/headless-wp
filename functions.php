<?php
//Theme Features
add_theme_support('custom-logo');
add_theme_support('menus');
add_theme_support('post-thumbnails');

//Custom post types
function headlesswp_custom_post_types(){
  register_post_type('portfolio',[
    'labels' =>[
      'name' => __('Portfolio'),
      'singular_name' => __('Portfolio')
    ],
    'public' => true,
    'show_in_admin_bar' => true,
    'show_in_rest' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-pressthis',
    'supports' => ['title', 'thumbnail', 'editor', 'excerpt']
    ]);
}

add_action( 'init', 'headlesswp_custom_post_types' );

// Remove toolbar items
function headlesswp_remove_toolbar_node($wp_admin_bar) {
	
  $wp_admin_bar->remove_node('wp-logo');
  $wp_admin_bar->remove_node('customize');
  $wp_admin_bar->remove_node('comments');
  $wp_admin_bar->remove_node('edit');
  $wp_admin_bar->remove_node('search');
	
}
add_action('admin_bar_menu', 'headlesswp_remove_toolbar_node', 999);


// Check for Plugins
// see http://tgmpluginactivation.com/configuration/ for detailed documentation.
require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'headlesswp_register_required_plugins' );
function headlesswp_register_required_plugins() {

	 // Array of plugin arrays. Required keys are name and slug.
	 // If the source is NOT from the .org repo, then source is also required.
	$plugins = [

		[
			'name'      => 'WP API Menus',
			'slug'      => 'wp-api-menus',
			'required'  => true,
		],
		[
			'name'      => 'Advanced Custom Fields',
			'slug'      => 'advanced-custom-fields',
			'required'  => true,
		],
		[
			'name'      => 'ACF to REST API',
			'slug'      => 'acf-to-rest-api',
			'required'  => true,
		],
		[
			'name'      => 'WP REST API favicon',
			'slug'      => 'wp-rest-api-favicon',
			'source'    => 'https://github.com/jstask82/wp-rest-api-favicon/archive/master.zip',
			'required'  => true,
		],
		[
			'name'      => 'WP REST API logo',
			'slug'      => 'wp-rest-api-logo',
			'source'    => 'https://github.com/jstask82/wp-rest-api-logo/archive/master.zip',
			'required'  => true,
		],
	];

	$config = [
		'id'           => 'headlesswordpress',     // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => false,                   // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	];

	tgmpa( $plugins, $config );
}
//Advanced Custom Fileds Import
require_once get_template_directory() . '/includes/acf.php';