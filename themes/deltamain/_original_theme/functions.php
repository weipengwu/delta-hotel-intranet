<?php

if (!is_admin())
{
	wp_enqueue_style( '', get_stylesheet_uri() );
}

add_filter('show_admin_bar', '__return_false');

function mytheme_customize_register( $wp_customize )
{

$wp_customize->add_section( 'subsite_settings' , array(
    'title'      => __('Site Settings','mytheme'),
    'priority'   => 30,
	) );

$wp_customize->add_setting( 'main_logo' , array(
    'default'     => '#000000',
    'transport'   => 'refresh',
	) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'main_logo', array(
	'label'        => __( 'Main Logo Image', 'mytheme' ),
	'section'    => 'subsite_settings',
	'settings'   => 'main_logo',
	) ) );

}

add_action( 'customize_register', 'mytheme_customize_register' );


function create_gallery_post_type() {
	$args = array(
			'labels' => array(
				'name' => __( 'Gallery' ),
				'singular_name' => __( 'Gallery' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'gallery'),
			'publicly_queryable' => true,
	        'show_ui' => true, 
	        'show_in_menu' => true, 
	        'query_var' => true,
	        'rewrite' => true,
	        'capability_type' => 'post',
	        'has_archive' => true, 
	        'hierarchical' => false,
	        'menu_position' => null,
	        'supports' => array(
	        	'title',
	            'editor',
	            'thumbnail',
	            'excerpt',
	            'page-attributes',
	        )
		);
	register_post_type( 'services', $args);
}

add_action( 'init', 'create_gallery_post_type' );