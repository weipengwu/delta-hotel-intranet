<?php

define('THEME_TYPE', 'PROGRAM');

define('theme_url',get_bloginfo('template_url'));
//include_once('custom_functions.php');
/*Wpml Support Function do not remove this*/
// add_action('after_setup_theme', 'deltaprograms');
// function deltaprograms(){
//     load_theme_textdomain('deltaprograms', get_template_directory());
// }
add_action( 'after_setup_theme', 'my_child_theme_setup' );
function my_child_theme_setup() {
    load_theme_textdomain( 'deltamain', get_template_directory() );
}

if (!is_admin())
{
	wp_enqueue_style( '', get_stylesheet_uri() );
}

add_filter('show_admin_bar', '__return_false');

/* like button for post */
//include "post-like.php";
//require_once('post-like.php');
require_once('theme_options.php');
//include_once('inc/coustom-function.php');
//include_once('inc/metaboxalert.php');
//include_once('inc/coustom-dashboard.php');
//include_once('inc/shortcode.php');
//require_once("inc/custom_functions.php");


/* like button for post */

add_image_size( 'logo', '189', '149', true ); 
add_image_size( 'header_banner', '1184', '289', true ); 
function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Headlines';
    $submenu['edit.php'][5][0] = 'Headlines';
    $submenu['edit.php'][10][0] = 'Add Headlines';
    $submenu['edit.php'][16][0] = 'Headlines Tags';
    echo '';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Headlines';
    $labels->singular_name = 'Headlines';
    $labels->add_new = 'Add Headlines';
    $labels->add_new_item = 'Add Headlines';
    $labels->edit_item = 'Edit Headlines';
    $labels->new_item = 'Headlines';
    $labels->view_item = 'View Headlines';
    $labels->search_items = 'Search Headlines';
    $labels->not_found = 'No Headlines found';
    $labels->not_found_in_trash = 'No Headlines found in Trash';
    $labels->all_items = 'All Headlines';
    $labels->menu_name = 'Headlines';
    $labels->name_admin_bar = 'Headlines';
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );

/*function create_resource_post_type() {
	$args = array(
			'labels' => array(
				'name' => __( 'Resources' ),
				'singular_name' => __( 'Resources' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'den-resource'),
			'publicly_queryable' => true,
	        'show_ui' => true, 
		'menu_icon' => 'dashicons-category',
	        'show_in_menu' => true, 
	        'query_var' => true,
	        'rewrite' => true,
	        'capability_type' => 'page',
	        'has_archive' => true, 
	        'hierarchical' => true,
	        'menu_position' => 20,
	        'supports' => array(
	        	'title',
	            'editor',
	            'thumbnail',
	            'excerpt',
	            'page-attributes','template'
	        )
		);
	register_post_type( 'den-resource', $args);
	flush_rewrite_rules();
}

add_action( 'init', 'create_resource_post_type' );*/
/*Getting Related posts from same Author*/
/*function get_related_author_posts() {
    global $authordata, $post, $wpdb;
$table= $wpdb->blogs;
$blog_id = get_current_blog_id();
$author_id= get_the_author_meta('ID');
$sql= "select blog_id from ".$table ." where public='1'" ;
$blog_query= $wpdb->get_results($sql);
//print_r($blog_query);
$bids=array();
 //echo '<ul class="yellowBullet">';
foreach($blog_query as $blog){
	 $bids[]= $blog->blog_id;
}
//$blogs= rsort($bids);

$output=array();
foreach($bids as $bid):
/**/

/*switch_to_blog($bid);
 $author_id= get_the_author_meta('ID');


 $authors_posts = get_posts('author='.$author_id);
//print_r($authors_posts);

     foreach ( $authors_posts as $authors_post ) {
$d = strtotime($authors_post->post_date_gmt);
$authors_post->permalink =  get_permalink($authors_post->ID);

$output[$d]=$authors_post;
    }

endforeach;     


switch_to_blog( $blog_id );

krsort($output);
/*echo '<pre>';
print_r($output);
echo '</pre>';*/
/*$output = array_slice($output, 0, 10);
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
}*/
/*admin area css starts*/
/*add_action('admin_head', 'custom_admin_css');

function custom_admin_css() {
	//echo theme_url;
  wp_enqueue_style( 'custom_admin', theme_url.('/stylesheets/custom_admin.css'));
}*/
/*admin area css ends*/
/*function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Upcoming Events', 'theme-slug' ),
        'description' => __( 'Widgets area for google calendar events.', 'theme-slug' ),
        'title'=>'Upcoming Events',
        'before_widget' => '<ul>',
		'after_widget'  => '</ul>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Left Banner Top', 'theme-slug' ),
        'description' => __( 'Enter Here First Banner Short code eg [banner id="xxx"].', 'theme-slug' ),
        'before_widget' => '<p>',
		'after_widget'  => '</p>'
        
    ) );
    register_sidebar( array(
        'name' => __( 'Left Banner Bottom', 'theme-slug' ),
        'description' => __( 'Enter Here Second Banner Short code eg [banner id="xxx"].', 'theme-slug' ),
        'before_widget' => '<p>',
		'after_widget'  => '</p>'
        
    ) );
    
}
add_action( 'widgets_init', 'theme_slug_widgets_init' );*/
register_nav_menus( array(
	'sidebar_main_menu' => 'sidebar main menu',
	'footer_menu' => 'Footer Menu',
) );


/*function remove_menus(){
  
  remove_menu_page( 'edit.php?post_type=gce_feed' );                  	//Google Calendar Events
  remove_menu_page( 'youtube-my-preferences' );     //Youtube
  remove_menu_page( 'plugins.php' );                //Plugins
  remove_menu_page( 'users.php' );    				//Users
  remove_menu_page( 'tools.php' );                  //Tools
  remove_menu_page( 'options-general.php' );        //Settings
  remove_menu_page( 'sitepress-multilingual-cms/menu/languages.php' );          	//WPML
  
  
  //remove_menu_page( 'themes.php' );                 //Appearance
  //remove_menu_page( 'plugins.php' );                //Plugins
  //remove_menu_page( 'users.php' );                  //Users
  
  
  
}
if ( !is_super_admin() ) {
add_action( 'admin_menu', 'remove_menus' );
}*/

add_image_size("sidebar_banner","185","274",true);
add_image_size("crusal_thumbnail","174","99",true);
add_image_size("crusal_banner","689","388",true);
add_image_size("post_thumbnail","172","166",true);
/*shortcode support for widget*/
add_filter('widget_text', 'do_shortcode');
/*removing multilingual bar below editor*/
/*add_action('admin_head', 'disable_icl_metabox',99);
function disable_icl_metabox() {
global $post;
remove_meta_box('icl_div_config',$post->posttype,'normal');
}*/

add_action('wp_footer', 'delta_programs_scripts');
function delta_programs_scripts(){
	wp_enqueue_script('custom_programs', get_stylesheet_directory_uri().'/js/custom.js');
	}



/*function extractExcerpt($postContent, $len = 150){
  $excerpt = preg_replace('/\[(.*)\]/', '', $postContent);
  $excerpt = mb_substr( wp_strip_all_tags( $excerpt ),0, $len);

  $end = strrpos($excerpt, ".");

  if($end){
    return substr($excerpt, 0, $end + 1);
  }

  return $excerpt . "...";

}*/
?>

