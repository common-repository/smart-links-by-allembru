<?php
/*
Plugin Name: Smart Links by Allembru
Plugin URI: http://www.allembru.com/wordpress-allembru-slinks/
Description: A smart link plugin for wordpress. Automatically link commonly used words in your posts.
Version: 1.5.1
Author: Allembru.com
Author URI: http://www.allembru.com/
License: GPL2

Copyright 2012 Allembru  (email : wp-plugin@allembru.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
global $aslinks_db_version;
$aslinks_db_version = "1.2.1";

function aslinks_install() {
   global $wpdb;
   global $aslinks_db_version;

   $table_name = $wpdb->prefix . "aslinks";
   $sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL auto_increment,
  text varchar(255) NOT NULL default '',
  title varchar(255) NOT NULL default '',
  url varchar(255) NOT NULL default '',
  openin varchar(55) NOT NULL default '',
  tip_display int(11) default NULL,
  tip_style varchar(55) default NULL,
  tip_description text,
  tip_title varchar(255) default NULL,
  tip_image varchar(255) default NULL,
  UNIQUE KEY id (id)
    );";

   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);
   add_option("aslinks_db_version", $aslinks_db_version);
}
register_activation_hook(__FILE__,'aslinks_install');

function aslinks_admin_init() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');

	wp_register_style('aslinks-admin-css', plugins_url('css/admin.css', __FILE__));
	wp_enqueue_style('aslinks-admin-css');

	wp_enqueue_script('jquery');

	wp_register_script('aslinks-admin-js', plugins_url('js/admin.js', __FILE__));
	wp_enqueue_script('aslinks-admin-js');
}
add_action('admin_init', 'aslinks_admin_init');

function aslinks_header() {
	wp_register_style('aslinks-public-css', plugins_url('css/public.css', __FILE__));
	wp_enqueue_style('aslinks-public-css');

	wp_enqueue_script('jquery');

	wp_register_script('aslinks-public-js', plugins_url('js/public.js', __FILE__));
	wp_enqueue_script('aslinks-public-js');
}    
add_action('wp_head', 'aslinks_header', 0);

function aslinks_footer() {
	require_once('inc/footer.php');
}
add_action('wp_footer', 'aslinks_footer', 1);

function aslinks_create_menu() {
	//create new top-level menu
	$page_title = 'Smart Links by Allembru';
	$menu_title = 'Smart Links';
	$capability = 'administrator';
	$menu_slug	= 'aslinks-edit';
	$function 	= 'aslinks_edit_page';
	$icon_url	= plugins_url('/img/menu_icon.png', __FILE__);
	$position	= __FILE__;
	add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url);

	$parent_slug = 'aslinks-edit';
	$page_title = 'Smart Links by Allembru: New Link';
	$menu_title = "New Link";
	$capability = 'administrator';
	$menu_slug	= 'aslinks-new';
	$function 	= 'aslinks_new_page';
	add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
}
add_action('admin_menu', 'aslinks_create_menu');

function aslinks_new_page() {
	require_once('allembru-slinks-new.php');
}

function aslinks_edit_page() {
	require_once('allembru-slinks-edit.php');
}
?>