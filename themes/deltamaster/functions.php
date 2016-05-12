<?php

header("Access-Control-Allow-Origin: *");

function switch_language ()
{
	global $sitepress;

	$sitepress->switch_lang($_REQUEST['switch_language']);

	DenUser::set_meta_field('language', $_REQUEST['switch_language']);

	die;
}
add_action( "wp_ajax_switch_lang", "switch_language" ); // when logged in
add_action( "wp_ajax_nopriv_switch_lang", "switch_language" );//when logged out 

add_filter('template_redirect', 'my_404_override' );
function my_404_override() {
    global $wp_query;

    if (isset($_REQUEST['blog_id']) && isset($_REQUEST['tid'])) 
    {
        status_header( 200 );
        $wp_query->is_404=false;
    }
}

add_filter( 'template_include', 'den_home_remote_blog', 99 );

function den_home_remote_blog( $template ) {

	if (isset($_REQUEST['blog_id']) && isset($_REQUEST['tid'])) {

		$new_template = locate_template( array( 'single.php' ) );

		if ( '' != $new_template ) {
			return $new_template ;
		}
	}

	return $template;
}

/* Delta Master Theme Functions*/
define('theme_url',get_bloginfo('template_url'));
add_theme_support('post-thumbnails');


add_filter( 'locale', 'my_theme_localized' );
function my_theme_localized( $locale )
{
	if (strpos(DenUser::get_meta_field('language'), 'fr') !== false)
	{
		return 'fr_FR';
	}
	else
	{
		return 'en_EN';	
	}

	return $locale;
}

/*Wpml Support Function do not remove this*/
add_action('after_setup_theme', 'deltamaster');
function deltamaster(){
    load_theme_textdomain('deltamain', get_template_directory());
}

//include_once('custom_functions.php');

if (function_exists('add_theme_support')) {
    add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
   
}

add_action( 'pre_get_posts' ,'exclude_this_page' );
function exclude_this_page( $query ) {
	if( !is_admin() )
		return $query;

	global $pagenow;

	// WordPress 3.0
	
	// if( 'edit.php' == $pagenow && ( get_query_var('post_type') && 'page' == get_query_var('post_type') ) )
	// 	$query->set( 'post__not_in', array(70) );
	
	return $query;
}

add_filter('show_admin_bar', '__return_false');

/* like button for post */
include "post-like.php";
include_once('inc/coustom-function.php');
include_once('inc/metaboxalert.php');
include_once('inc/coustom-dashboard.php');
include_once('inc/shortcode.php');
//include_once('inc/multi-image-metabox.php');
/* like button for post */
/*Renaming post to Headlines*/
// function admin_change_post_label() {
//     global $menu;
//     global $submenu;
//     $menu[5][0] = 'Headlines';
//     $submenu['edit.php'][5][0] = 'Headlines';
//     $submenu['edit.php'][10][0] = 'Add Headlines';
//     $submenu['edit.php'][16][0] = 'Headlines Tags';
//     echo '';
// }
// function admin_change_post_object() {
//     global $wp_post_types;
//     $labels = &$wp_post_types['post']->labels;
//     $labels->name = 'Headlines';
//     $labels->singular_name = 'Headlines';
//     $labels->add_new = 'Add Headlines';
//     $labels->add_new_item = 'Add Headlines';
//     $labels->edit_item = 'Edit Headlines';
//     $labels->new_item = 'Headlines';
//     $labels->view_item = 'View Headlines';
//     $labels->search_items = 'Search Headlines';
//     $labels->not_found = 'No Headlines found';
//     $labels->not_found_in_trash = 'No Headlines found in Trash';
//     $labels->all_items = 'All Headlines';
//     $labels->menu_name = 'Headlines';
//     $labels->name_admin_bar = 'Headlines';
// }
 
// add_action( 'admin_menu', 'admin_change_post_label' );
// add_action( 'init', 'admin_change_post_object' );



/*function mytheme_customize_register( $wp_customize )
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




add_action( 'customize_register', 'mytheme_customize_register' );*/

function get_override_template($path)
{
	if (file_exists('wp-content/themes/' . get_stylesheet() . '/' . $path))
		require('wp-content/themes/' . get_stylesheet() . '/' . $path);
	else
		require('wp-content/themes/deltamaster/' . $path);
}


function sc_delta_tree_menu($atts) {
    // extract(shortcode_atts(array('root' => 'Start',), $atts));  //default if empty.
    // $page = get_page_by_title($root);

    $args = array(
        //'child_of' => $atts,
        'date_format' => get_option('date_format'),
        'depth' => 1,
        'echo' => 0,
        'post_type' => 'den-resource',
        'post_status' => 'publish',
        'sort_column' => 'menu_order',
        'title_li' => ''
    );
    echo ' <ul class="yellowBullet">' . wp_list_pages($args) . '</ul>';
}
add_shortcode('delta_tree_menu', 'sc_delta_tree_menu');

function sc_delta_child_menu($atts) {

    $args = array(
        'child_of' => $atts,
        'date_format' => get_option('date_format'),
        'depth' => 1,
        'echo' => 0,
        'post_type' => 'den-resource',
        'post_status' => 'publish',
        'sort_column' => 'menu_order',
        'title_li' => ''
    );
    echo ' <ul class="yellowBullet">' . wp_list_pages($args) . '</ul>';
}

function create_resource_post_type() {
	$args = array(
			'labels' => array(
				'name' => __( 'Resources' ),
				'singular_name' => __( 'Resource' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'den-resource'),
			'publicly_queryable' => true,
	        'show_ui' => true, 
	        'show_in_menu' => true, 
	        'query_var' => true,
	        'rewrite' => true,
	        'capability_type' => 'page',
	        'has_archive' => true, 
	        'hierarchical' => true,
	        'menu_position' => null,
	        'supports' => array(
	        	'title',
	            'editor',
	            'thumbnail',
	            'excerpt',
	            'page-attributes','template'
	        )
		);
	register_post_type( 'den-resource', $args);
}
/*Getting Related posts from same Author*/
/*function get_related_author_posts() {
    global $authordata, $post;

    $authors_posts = get_posts( array( 'author' => $authordata->ID, 'post__not_in' => array( $post->ID ), 'posts_per_page' => 5 ) );

    $output = '<ul class="yellowBullet">';
    foreach ( $authors_posts as $authors_post ) {
        $output .= '<li><a href="' . get_permalink( $authors_post->ID ) . '">' . apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) . '</a></li>';
    }
    $output .= '</ul>';

    return $output;
}*/
/*Pagination*/

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_activities',
		'title' => 'Activities',
		'fields' => array (
			// array (
			// 	'key' => 'field_546951af48894',
			// 	'label' => 'Activity Link',
			// 	'name' => 'activity_link',
			// 	'type' => 'text',
			// 	'default_value' => '',
			// 	'placeholder' => '',
			// 	'prepend' => '',
			// 	'append' => '',
			// 	'formatting' => 'html',
			// 	'maxlength' => '',
			// ),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'activity',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'permalink',
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_popular-resource',
		'title' => 'Popular Resource',
		'fields' => array (
			// array (
			// 	'key' => 'field_546954569d238',
			// 	'label' => 'Resource Link',
			// 	'name' => 'resource_link',
			// 	'type' => 'text',
			// 	'required' => 1,
			// 	'default_value' => '',
			// 	'placeholder' => '',
			// 	'prepend' => '',
			// 	'append' => '',
			// 	'formatting' => 'html',
			// 	'maxlength' => '',
			// ),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'popular',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'permalink',
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_calendar',
		'title' => 'Calendar',
		'fields' => array (
			array (
				'key' => 'field_547cae8ca02ad',
				'label' => 'Calendar URL',
				'name' => 'calendar_url',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-calendar.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
				7 => 'slug',
				8 => 'author',
				9 => 'format',
				10 => 'featured_image',
				11 => 'categories',
				12 => 'tags',
				13 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}



function delta_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
	
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'><ul>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a><li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
         echo "<ul></div>\n";
     }
}
/*
function posts_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}*/
add_action( 'init', 'create_resource_post_type' );

/*Getting Related posts from same Author*/
function get_related_author_posts() {
    global $authordata, $post, $wpdb;

$output=array();


 $author_id= get_the_author_meta('ID');
 $bid = get_current_blog_id();
if(DenUser::field('language') == 'en'){
	if($bid == "1"){
		$get_post = 'select * from wp_posts inner join wp_icl_translations on wp_posts.ID = wp_icl_translations.element_id where wp_icl_translations.element_type = "post_post" and wp_posts.post_status = "publish" and wp_icl_translations.language_code = "en" and wp_posts.post_author = '.$author_id;
	}else{
		$get_post = 'select * from wp_'.$bid.'_posts inner join wp_'.$bid.'_icl_translations on wp_'.$bid.'_posts.ID = wp_'.$bid.'_icl_translations.element_id where wp_'.$bid.'_icl_translations.element_type = "post_post" and wp_'.$bid.'_posts.post_status = "publish" and wp_'.$bid.'_icl_translations.language_code = "en" and wp_'.$bid.'_posts.post_author = '.$author_id;
	}
}else{
	if($bid == "1"){
		$get_post = 'select * from wp_posts inner join wp_icl_translations on wp_posts.ID = wp_icl_translations.element_id where wp_icl_translations.element_type = "post_post" and wp_posts.post_status = "publish" and wp_icl_translations.language_code = "fr" and wp_posts.post_author = '.$author_id;			
	}else{
		$get_post = 'select * from wp_'.$bid.'_posts inner join wp_'.$bid.'_icl_translations on wp_'.$bid.'_posts.ID = wp_'.$bid.'_icl_translations.element_id where wp_'.$bid.'_icl_translations.element_type = "post_post" and wp_'.$bid.'_posts.post_status = "publish" and wp_'.$bid.'_icl_translations.language_code = "fr" and wp_'.$bid.'_posts.post_author = '.$author_id;			
	}
}

 //$authors_posts = get_posts('author='.$author_id.'&post_type=post&post_status=published&posts_per_page=-1');
//print_r($authors_posts);
$authors_posts = $wpdb->get_results($get_post);

     foreach ( $authors_posts as $authors_post ) {
     	if (!DenUser::is_member($bid) && get_post_meta($authors_post->ID, '_member_post', true) == 'members' || $authors_post->ID == $post->ID){
			continue;
     	}
$d = strtotime($authors_post->post_date_gmt);
$authors_post->permalink =  get_permalink($authors_post->ID);
$output[$d]=$authors_post;
    }



krsort($output);
$output = array_slice($output, 0, 10);
return $output;
}
function the_related_author_posts(){
	
	$html='<ul class="yellowBullet">';
	$r_posts =  get_related_author_posts();
	foreach($r_posts as $posts){
		$html.='<li><a href="' . $posts->permalink. '">' . apply_filters( 'the_title', $posts->post_title, $posts->ID ) . '</a></li>'; 
	}
	$html.='</ul>';
	return $html;
}
/*function start for home page posts*/


							
				/* get load more */
				
				function get_blog_posts() {
				    global $authordata, $post, $wpdb;
				
				
				$output=array();

				$author_id= get_the_author_meta('ID');
					// switch_to_blog(get_current_blog_id());
				 	
				
				$bid = get_current_blog_id();
					// $authors_posts = get_posts('posts_per_page=-1');
				if(DenUser::field('language') == 'en'){
					$get_post = 'select * from wp_'.$bid.'_posts inner join wp_'.$bid.'_icl_translations on wp_'.$bid.'_posts.ID = wp_'.$bid.'_icl_translations.element_id where wp_'.$bid.'_icl_translations.element_type = "post_post" and wp_'.$bid.'_posts.post_status = "publish" and wp_'.$bid.'_icl_translations.language_code = "en"';
				}else{
					$get_post = 'select * from wp_'.$bid.'_posts inner join wp_'.$bid.'_icl_translations on wp_'.$bid.'_posts.ID = wp_'.$bid.'_icl_translations.element_id where wp_'.$bid.'_icl_translations.element_type = "post_post" and wp_'.$bid.'_posts.post_status = "publish" and wp_'.$bid.'_icl_translations.language_code = "fr"';				
				}
				$authors_posts = $wpdb->get_results($get_post);

				    foreach ( $authors_posts as $authors_post ) 
				    {
				    	if(!DenUser::is_member(get_current_blog_id()) && get_post_meta($authors_post->ID, '_member_post', true) == 'members') continue;
				  //    	$url = get_permalink($authors_post->ID));

						// $url_data = parse_url($url);
						// $url_data['host'] = $_SERVER['SERVER_NAME'];

						//$authors_post = get_post(icl_object_id($authors_post->ID, 'post', false));

						

						$d = strtotime($authors_post->post_date_gmt);

				
						$authors_post->permalink = get_permalink($authors_post->ID);
						// $authors_post->permalink = get_permalink($authors_post->ID) . '?blog_id=' . $bid;
						$authors_post->blogUrl =  get_bloginfo('url');
						$authors_post->blogName =  get_bloginfo('name');
						$authors_post->commentcount = get_comments_number($authors_post->ID);
						$authors_post->thumbnail =wp_get_attachment_url( get_post_thumbnail_id($authors_post->ID) );
						$authors_post->theme_excerpt =theme_excerpt('');
						$output[$d]=$authors_post;
				    }


				
				
				
				// restore_current_blog();
				// wp_reset_postdata();
				// switch_to_blog( $blog_id );
				// echo "<pre>";
				// print_r($output);
				krsort($output);
				
				// print_r($output);
				// echo '</pre>';
				//$output = array_slice($output, 0, 3);
				
				return $output;
				}

/*function ends for home page posts*/






/* function for Top Activites (Popular) */

function create_popular_alerts_type() {
	$args = array(
			'labels' => array(
				'name' => __( 'Popular' ),
				'singular_name' => __( 'Popular' ),
				'add_new_item' => 'Add Popular Resource',
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'popular'),
			'publicly_queryable' => true,
	        'show_ui' => true, 
		'menu_icon' => 'dashicons-star-filled',
		'show_in_menu' => true, 
	        'query_var' => true,
	        'rewrite' => true,
	        'capability_type' => 'link',
	        'has_archive' => false, 
	        'hierarchical' => false,
		'menu_position' => 20,
	           'supports' => array(
	        	'title',
	        )
		);
	register_post_type( 'popular', $args);
	flush_rewrite_rules();

	$args = array(
			'labels' => array(
				'name' => __( 'Activities' ),
				'singular_name' => __( 'Activity' ),
				'add_new_item' => 'Add New Activity',
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'activity'),
			'publicly_queryable' => true,
	        'show_ui' => true, 

		'menu_icon' => 'dashicons-star-filled',
		'show_in_menu' => true, 
	        'query_var' => true,
	        'rewrite' => true,
	        'capability_type' => 'link',
	        'has_archive' => false, 
	        'hierarchical' => false,
		'menu_position' => 20,
	           'supports' => array('title')
	        
		);
	register_post_type( 'activity', $args);
	flush_rewrite_rules();


	/* post type End popular*/
	
	if (get_current_blog_id() == 1)
	{
	/* post type Alert*/
	$args = array(
			'labels' => array(
				'name' => __( 'Alerts' ),
				'singular_name' => __( 'Alerts' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'alerts'),
			'publicly_queryable' => true,
	        'show_ui' => true, 
		'menu_icon' => 'dashicons-info',
		'show_in_menu' => true, 
	        'query_var' => true,
	        'rewrite' => true,
	        'capability_type' => 'post',
	        'has_archive' => true, 
	        'hierarchical' => true,
		'menu_position' => 22,
	           'supports' => array(
	        	'title',
	            'editor'
	        )
		);

	
		register_post_type( 'alerts', $args);
		flush_rewrite_rules();
	}
	/*End alerts*/
	
	
	/* post type Banners */
	
	$args = array(
			'labels' => array(
				'name' => __( 'Banners' ),
				'singular_name' => __( 'Banners' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'banners'),
			'publicly_queryable' => true,
	        'show_ui' => true, 
		'menu_icon' => 'dashicons-slides',
		'show_in_menu' => true, 
	        'query_var' => true,
	        'rewrite' => true,
	        'capability_type' => 'post',
	        'has_archive' => true, 
	        'hierarchical' => true,
		'menu_position' => null,
	           'supports' => array(
	        	'title',	            
	            'thumbnail',	            
	            'page-attributes','template'
	        )
		);
	//register_post_type( 'banners', $args);
	//flush_rewrite_rules();
	
	/*End alerts*/
	/**** home carousel   *****/
	$args = array(
			'labels' => array(
				'name' => __( 'Home Carousel' ),
				'singular_name' => __( 'Home Carousel' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'home_carousel'),
			'publicly_queryable' => true,
	        'show_ui' => true, 
		'menu_icon' => 'dashicons-slides',
		'show_in_menu' => true, 
	        'query_var' => true,
	        'rewrite' => true,
	        'capability_type' => 'post',
	        'hierarchical' => true,
		'menu_position' => 5,
	           'supports' => array(
	        	'title'
	        )
		);
	register_post_type( 'home_carousel', $args);
	flush_rewrite_rules();
}

add_action( 'init', 'create_popular_alerts_type' );


/*function End for Top Activites (Popular) */


/*admin area css starts*/
add_action('admin_head', 'custom_admin_css');

function custom_admin_css() {
	//echo theme_url;
  wp_enqueue_style( 'custom_admin', theme_url.('/stylesheets/custom_admin.css'));
}
/*admin area css ends*/

/*adding sidebar*/
function theme_slug_widgets_init() {
    /*register_sidebar( array(
        'name' => __( 'Upcoming Events', 'theme-slug' ),
        'description' => __( 'Widgets area for google calendar events.', 'theme-slug' ),
        'title'=>'Upcoming Events',
        'before_widget' => '<ul>',
		'after_widget'  => '</ul>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );*/
    register_sidebar( array(
    'name'          => 'Left Side Bar',
	'before_widget' => '<section class="list-panel events">',
	'after_widget'  => '</section>',
	'before_title'  => '<h3 class="header">',
	'after_title'   => '</h3>',
	) );
    register_sidebar( array(
        'name'          => 'Right Side Bar',
		'before_widget' => '<section class="panel">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="header">',
		'after_title'   => '</h3>'
		) );
        
    
}
add_action( 'widgets_init', 'theme_slug_widgets_init' );
/* Removing customizing menu for non admin*/
function remove_admin_menus(){
  
  remove_menu_page( 'edit.php?post_type=gce_feed' );                  	//Google Calendar Events
  remove_menu_page( 'youtube-my-preferences' );     //Youtube
  remove_menu_page( 'plugins.php' );                //Plugins
  remove_menu_page( 'users.php' );    				//Users
  remove_menu_page( 'tools.php' );                  //Tools
  remove_menu_page( 'options-general.php' );        //Settings
  remove_menu_page( 'sitepress-multilingual-cms/menu/languages.php' );          	//WPML
  remove_menu_page( 'upload.php' );                 //Media
  
  remove_menu_page( 'themes.php' );                 //Appearance
  
  
  
}

if ( !is_super_admin() ) {
add_action( 'admin_menu', 'remove_admin_menus' );
//hide custom fields
add_filter('acf/settings/show_admin', '__return_false');
}
add_action('admin_menu','wphidenag');
function wphidenag() {
	//hide wordpress upgrade notice
	remove_action( 'admin_notices', 'update_nag', 3 );
}


add_image_size("sidebar_banner","185","274",true);
add_image_size("crusal_thumbnail","174","99",true);
add_image_size("crusal_banner","689","388",true);
add_image_size("post_thumbnail","172","166",true);

/*shortcode support for widget*/
add_filter('widget_text', 'do_shortcode');
/**/

add_action('admin_head', 'disable_icl_metabox',99);
function disable_icl_metabox() {
global $post;
if ($post)
	remove_meta_box('icl_div_config',$post->posttype,'normal');
}
/**
 * Get excerpt from string
 */
function theme_excerpt($num, $readmore = true) {
	
	
	 $limit = $num;
	if(!$limit) $limit = 55;
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...'.$link;
	} else {
		$excerpt = implode(" ",$excerpt).$link;
	}	
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}

add_action( 'wp_footer', 'delta_scripts' );
function delta_scripts(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('foundation', theme_url.'/js/foundation.js');
	wp_enqueue_script('foundation.min', theme_url.'/js/foundation.min.js');
	wp_enqueue_script('app', theme_url.'/js/app.js');
	wp_enqueue_script('jquery-ui', theme_url.'/js/jquery-ui.js');
	wp_enqueue_script('jquery.cookie', theme_url.'/js/jquery.cookie.js');
	wp_enqueue_script('foundation', theme_url.'/js/foundation.min.js');
	wp_enqueue_script('slick.min', theme_url.'/js/slick/slick.min.js');	
	wp_enqueue_script('custom_scripts', theme_url.'/js/custom.js');
	wp_enqueue_script('third_party', theme_url.'/js/thirdparty.js');	
	}
add_action('wp_footer','delta_style');
function delta_style(){
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/stylesheets/custom.css');
}
if (is_admin()) :
function remove_delta_dashboard_meta_boxes() {
  remove_meta_box('icl_dashboard_widget', 'dashboard', 'normal');
  remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'normal');
  remove_meta_box('dashboard-widgets-wrap', 'dashboard', 'normal');
  remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
  remove_meta_box('dashboard_activity', 'dashboard', 'normal');
  }
add_action( 'admin_menu', 'remove_delta_dashboard_meta_boxes' );
endif;

function extractExcerpt($postContent, $len = 150){
	$excerpt = preg_replace('/\[(.*)\]/', '', $postContent);
	$excerpt = mb_substr( wp_strip_all_tags( $excerpt ),0, $len);

	$endings = array(".", "!");

	foreach ($endings as $value) {
		$end = strrpos($excerpt, $value);
		if($end){
			return substr($excerpt, 0, $end + 1);
		}
	}	

	/*if($end){
		return substr($excerpt, 0, $end + 1);
	}*/

	return $excerpt . "...";

}
function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


add_action( 'show_user_profile', 'add_extra_info' );
add_action( 'edit_user_profile', 'add_extra_info' );

function add_extra_info( $user )
{
    ?>
        <h3>Extra Information</h3>

        <table class="form-table">
            <tr>
                <th><label for="job_title">Job Title</label></th>
                <td><input type="text" name="job_title" value="<?php echo esc_attr(get_the_author_meta( 'job_title', $user->ID )); ?>" class="regular-text" /></td>
            </tr>

            <tr>
                <th><label for="user_department">Department</label></th>
                <td><input type="text" name="user_department" value="<?php echo esc_attr(get_the_author_meta( 'user_department', $user->ID )); ?>" class="regular-text" /></td>
            </tr>

            <tr>
                <th><label for="user_phone">Phone</label></th>
                <td><input type="text" name="user_phone" value="<?php echo esc_attr(get_the_author_meta( 'user_phone', $user->ID )); ?>" class="regular-text" /></td>
            </tr>
        </table>
    <?php
}
add_action( 'personal_options_update', 'save_extra_info' );
add_action( 'edit_user_profile_update', 'save_extra_info' );
function save_extra_info( $user_id )
{
    update_user_meta( $user_id,'job_title', sanitize_text_field( $_POST['job_title'] ) );
    update_user_meta( $user_id,'user_department', sanitize_text_field( $_POST['user_department'] ) );
    update_user_meta( $user_id,'user_phone', sanitize_text_field( $_POST['user_phone'] ) );
}

add_action( "wp_ajax_load_more", "the_blog_posts_ajax" ); // when logged in
add_action( "wp_ajax_nopriv_load_more", "the_blog_posts_ajax" );//when logged out 
function load_more_func(){
	$numPosts = (isset($_GET['perpage'])) ? $_GET['perpage'] : 3;
$page = (isset($_GET['page'])) ? $_GET['page'] : 0;


$args = array(

    'posts_per_page' => $numPosts,
    'offset'          => ($page-1)*$numPosts,
    'suppress_filters' => 0,
    'post_status' => 'publish',
);


$ajaxposts = get_posts($args);//print_r(get_posts($args));?>
<?php 
global $post;
foreach ($ajaxposts as $post) :
	setup_postdata( $post ); ?>

<div class="feed row">
    <? if(has_post_thumbnail()): ?>
        <div class="columns large-3">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('thumbnail'); ?>
            </a>
        </div>
        <div class="columns large-6">
    <? else: ?>
    	<div class="columns large-3">
            <a href="<?php the_permalink(); ?>">
                <img src="<? echo get_template_directory_uri();?>/images/dummyPostImage.png" />
            </a>
        </div>
        <div class="columns large-6">
    <? endif; ?>
        <a href="<?php echo get_the_permalink(); ?>"><h4><?php echo get_the_title(); ?></h4></a>
        <p><?php echo get_the_excerpt(); ?></p>
        <small>Posted <?php echo get_the_date(); ?> by <?php echo get_the_author(); ?> in <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></small>
    </div>
    <div class="columns large-3">
        <a class="comments" href="<?php echo get_the_permalink(); ?>#comments"><?php echo $commentcount = comments_number('0', '1', '%'); ?></a>
        <?php echo getPostLikeLink( get_current_blog_id(), get_the_ID() ); ?>
    </div>
</div>  

<?php endforeach; 
wp_reset_postdata();
die;
}
function the_blog_posts_ajax(){
	
	$page=$_GET['page'];
	$ItemPerPage=3;
	$offset=($page-1)*$ItemPerPage;
	
	
	$r_posts =  get_blog_posts();
	$r_posts=array_slice($r_posts, $offset, 3);
	//print_r($r_posts);
	foreach($r_posts as $posts){
		if(!DenUser::is_member($posts->blogID) && get_post_meta($posts->ID, '_member_post', true) == 'members') continue;
		$postContent=$posts->post_content;
		$excerpt = preg_replace('/\[(.*)\]/', '', $postContent);
		$ThemeExcerpt = extractExcerpt($excerpt); //substr($excerpt,0,150);
		$thumbnail=$posts->thumbnail;
		$author_info = get_userdata($posts->post_author);
		
		$html.='<div class="feed row"><div class="columns large-3"><a href="'.$posts->permalink.'">';
		if($thumbnail=='' || $thumbnail==null){ 
		   $html.='<img src="' .theme_url.'/images/dummyPostImage.png" />';
		     } else {
			$html.='<img src="'. $posts->thumbnail .'"/>';
			 }
			 $html.='</a></div>';
                $html.='<div class="columns large-6 qwashere"><a href="'. $posts->permalink.'"><h4>'. apply_filters( 'the_title', $posts->post_title, $posts->ID ) .'</h4></a>
                   <p>'.apply_filters( 'the_content', $ThemeExcerpt, $posts->ID ).'</p>';

                    if (strpos(DenUser::get_meta_field('language'), 'fr') === false)
                  {
                    $html .= '<small>Posted '.mysql2date('M d, Y', $posts->post_date).' by '. $author_info->first_name .' '. $author_info->last_name .' in <a href="'. $posts->blogUrl  .'">'. $posts->blogName .'</a></small>';
                }
                else
                {
                	$html .= '<small>Posté '.mysql2date('M d, Y', $posts->post_date).' par '. $author_info->first_name .' '. $author_info->last_name .' dans <a href="'. $posts->blogUrl  .'">'. $posts->blogName .'</a></small>';	
                }
                $html .= '</div>';
		
		
                $html.='<div class="columns large-3">
                    <a class="comments"  href="'. $posts->permalink .'#comments">'. $posts->commentcount .'</a>
                    '. getPostLikeLink( $posts->blogID, $posts->ID ) .'</div></div>'; 
	}
	echo $html;
	die;
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_home-carousel',
		'title' => 'Home Carousel',
		'fields' => array (
			array (
				'key' => 'field_547f2d7397605',
				'label' => 'Gallery Image',
				'name' => 'gallery_image',
				'type' => 'image',
				'instructions' => 'Image size must be 689 x 388',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'home_carousel',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_sidebar-banner',
		'title' => 'Sidebar Banner',
		'fields' => array (
			array (
				'key' => 'field_54878a6218e56',
				'label' => 'Sidebar',
				'name' => 'sidebar',
				'type' => 'radio',
				'choices' => array (
					'Left' => 'Left',
					'Right' => 'Right',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'gallery',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 50,
	));
}
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_contact',
		'title' => 'Contact',
		'fields' => array (
			array (
				'key' => 'field_548b293200810',
				'label' => 'Contact Name',
				'name' => 'contact_name',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_548b29f100812',
				'label' => 'Contact Job Title',
				'name' => 'contact_job_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_548b29fb00813',
				'label' => 'Contact Phone',
				'name' => 'contact_phone',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_548b2b9400815',
				'label' => 'Contact Email',
				'name' => 'contact_email',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_548b2b6000814',
				'label' => 'Contact Profile',
				'name' => 'contact_profile',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_548b2b9400816',
				'label' => 'Form Submission Address',
				'name' => 'form_submission',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-contact.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
}
add_action( "wp_ajax_search_employee", "search_employee" ); // when logged in
add_action( "wp_ajax_nopriv_search_employee", "search_employee" );//when logged out 
function search_employee(){
	global $wpdb;
	$string = $_POST['d_search'];
	$result = $wpdb->get_results($wpdb->prepare("SELECT ID FROM wp_users INNER JOIN wp_usermeta ON wp_users.ID = wp_usermeta.user_id WHERE meta_value LIKE %s OR user_email LIKE %s OR user_login LIKE %s GROUP BY wp_users.ID LIMIT 4", '%'.$string.'%', '%'.$string.'%', '%'.$string.'%'));
	if(count($result)>0){
		$ouput = array();
		foreach ($result as $r) {
			$user = get_user_by('id', $r->ID);
			$avatar = get_avatar($r->ID);

			$phone = get_user_meta($r->ID, 'phone', true);
			$property_code = get_user_meta($r->ID, 'property_code', true);
			$property_text = get_user_meta($r->ID, 'property_text', true);
			$job_title = get_user_meta($r->ID, 'job_title', true);

			$output[] = array('avatar' => $avatar,'firstname' => $user->user_firstname, 'lastname' => $user->user_lastname, 'jobtitle' => $job_title, 'email' => $user->user_email, 'property_code' => $property_code, 'property_text' => $property_text, 'phone' => $phone);	
		}
		echo json_encode($output);
		die;
	}else{
		echo "none";
		die;
	}
	
}

function enable_more_buttons($buttons) {
  $buttons[] = 'subscript';
  $buttons[] = 'superscript';
  return $buttons;
}
add_filter("mce_buttons_2", "enable_more_buttons");
?>
