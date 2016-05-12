<?php
//----------------------------------------------
//--------------add theme support for thumbnails
//----------------------------------------------
if ( function_exists( 'add_theme_support')){
	add_theme_support( 'post-thumbnails' );
}
add_image_size( 'admin-list-thumb', 80, 80, true); //admin thumbnail



//----------------------------------------------
//----------register and label Banner post type
//----------------------------------------------
$gallery_labels = array(
	'name' => _x('Banners', 'post type general name'),
	'singular_name' => _x('Banners', 'post type singular name'),
	'add_new' => _x('Add New', 'gallery'),
	'add_new_item' => __('Add New Banner'),
	'edit_item' => __('Edit Banner'),
	'new_item' => __('New Banner'),
	'view_item' => __('View Banner'),
	'search_items' => __('Search Banner'),
	'not_found' =>  __('No Banner found'),
		'not_found_in_trash' => __('No Banner found in Trash'), 
	'parent_item_colon' => ''
		
);
$gallery_args = array(
	'labels' => $gallery_labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'rewrite' => true,
	'hierarchical' => false,
	'menu_position' => 24,
	'menu_icon' => 'dashicons-slides',
	'capability_type' => 'post',
	'supports' => array('title')
	//'menu_icon' => get_bloginfo('template_directory') . '/images/photo-album.png' //16x16 png if you want an icon
); 
register_post_type('gallery', $gallery_args);
