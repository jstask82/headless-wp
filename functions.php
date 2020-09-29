<?php
add_theme_support('custom-logo');
add_theme_support('menus');

// remove toolbar items
// https://digwp.com/2016/06/remove-toolbar-items/
function headlesswp_remove_toolbar_node($wp_admin_bar) {
	
	// replace 'updraft_admin_node' with your node id
  $wp_admin_bar->remove_node('wp-logo');
  $wp_admin_bar->remove_node('customize');
  $wp_admin_bar->remove_node('comments');
  $wp_admin_bar->remove_node('edit');
  $wp_admin_bar->remove_node('search');
	
}
add_action('admin_bar_menu', 'headlesswp_remove_toolbar_node', 999);