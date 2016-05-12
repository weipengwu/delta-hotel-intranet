<?php
/* Delta Main Theme Functions File*/

add_theme_support('post-thumbnails');
/*Wpml Support Function do not remove this*/
add_action('after_setup_theme', 'deltamain');
function deltamain(){
    load_theme_textdomain('deltamain', get_template_directory());
}

//include_once('custom_functions.php');

if (function_exists('add_theme_support')) {
    add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
   
}
if (!is_admin())
{
	wp_enqueue_style( '', get_stylesheet_uri() );
}

add_filter('show_admin_bar', '__return_false');



function portfolio_page_template( $template ) {

	$url = preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);

	if (!$_REQUEST['s'] && $template == $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/deltamain/index.php' && $url != '/') {
		
		return $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/deltamain/single.php';
	}

	return $template;
}

add_filter( 'template_include', 'portfolio_page_template', 99 );




/* like button for post */
//include "post-like.php";
//include_once('inc/coustom-function.php');
//include_once('inc/metaboxalert.php');
//include_once('inc/coustom-dashboard.php');
//include_once('inc/shortcode.php');
//include_once('inc/multi-image-metabox.php');
/* like button for post */
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


/*function create_resource_post_type() {
	$args = array(
			'labels' => array(
				'name' => __( 'Den Resource' ),
				'singular_name' => __( 'Den Resource' )
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
	//register_post_type( 'den-resource', $args);
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

/*function delta_pagination($pages = '', $range = 2)
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
//add_action( 'init', 'create_resource_post_type' );

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


switch_to_blog($bid);
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

function unparse_url($parsed_url) { 
  $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : ''; 
  $host     = isset($parsed_url['host']) ? $parsed_url['host'] : ''; 
  $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : ''; 
  $user     = isset($parsed_url['user']) ? $parsed_url['user'] : ''; 
  $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : ''; 
  $pass     = ($user || $pass) ? "$pass@" : ''; 
  $path     = isset($parsed_url['path']) ? $parsed_url['path'] : ''; 
  $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : ''; 
  $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : ''; 
  return "$scheme$user$pass$host$port$path$query$fragment"; 
} 
							
				/* get load more */
				
				// function get_network_posts() {
				//     global $authordata, $post, $wpdb;
				// $table= $wpdb->blogs;
				// $blog_id = get_current_blog_id();
				// $user_id = get_current_user_id();
				// $author_id= get_the_author_meta('ID');
				// $sql= "select blog_id from ".$table ." where public='1'  " ;
				// $blog_query= $wpdb->get_results($sql);
				// //print_r($blog_query);
				// $bids=array();
				//  //echo '<ul class="yellowBullet">';
				// foreach($blog_query as $blog){

				// 	// see if the user is a member of this blog
				// 	$sql = "select meta_value FROM " . $wpdb->usermeta. " WHERE meta_key = 'wp_" . $blog->blog_id . "_user_level' AND user_id = " . $user_id;
				// 	$user_member = $wpdb->get_results($sql);
					
				// 	// is the user a member? if so add it to the list returned, everyone gets blog number 1
				// 	if (($user_member[0]->meta_value > 0 || $blog->blog_id == 1) || DenUser::is_subscribed($blog->blog_id))
				// 		$bids[]= $blog->blog_id;
				// }				
				// //$blogs= rsort($bids);
				
				// $output=array();
				// foreach($bids as $bid)
				// {

				
				// 	switch_to_blog($bid);
				//  	$author_id= get_the_author_meta('ID');
				
				
				// 	$authors_posts = get_posts('posts_per_page=-1&paged=1');

				//     foreach ( $authors_posts as $authors_post ) 
				//     {
				//     	//if ($authors_post->ID == 1) continue;
				//      	$url = str_replace(array('?lang=en', '?lang=fr'), '', get_permalink($authors_post->ID)) . '?tid=' . $authors_post->ID . '&blog_id=' . $bid;

				// 		$url_data = parse_url($url);
				// 		$url_data['host'] = $_SERVER['SERVER_NAME'];

				// 		$authors_post = get_post(icl_object_id($authors_post->ID, 'post', false));
				// 		$authors_post->permalink = unparse_url($url_data);

				// 		$d = strtotime($authors_post->post_date_gmt);

				
				// 		$authors_post->blogID = $bid;
				// 		// $authors_post->permalink = get_permalink($authors_post->ID) . '?blog_id=' . $bid;
				// 		$authors_post->blogUrl =  get_bloginfo('url');
				// 		$authors_post->blogName =  get_bloginfo('name');
				// 		$authors_post->commentcount = get_comments_number($authors_post->ID);
				// 		$authors_post->thumbnail =wp_get_attachment_url( get_post_thumbnail_id($authors_post->ID) );
				// 		$authors_post->theme_excerpt =theme_excerpt('');
				// 		$output[$d]=$authors_post;
				//     }


				
				// }
				
				// //switch_to_blog(1);
				//  switch_to_blog( $blog_id );
				// // echo "<pre>";
				// // print_r($output);
				// krsort($output);
				
				// // print_r($output);
				// // echo '</pre>';
				// //$output = array_slice($output, 0, 3);
				
				// return $output;
				// }

/*function ends for home page posts*/


	function get_all_posts(){
		global $authordata, $post, $wpdb;
		$table= $wpdb->blogs;
		$blog_id = get_current_blog_id();
		$user_id = get_current_user_id();
		$author_id= get_the_author_meta('ID');
		$sql= "select blog_id from ".$table ." where public='1'  " ;
		$blog_query= $wpdb->get_results($sql);
		$bids=array();
		foreach($blog_query as $blog){

			// see if the user is a member of this blog
			$sql = "select meta_value FROM " . $wpdb->usermeta. " WHERE meta_key = 'wp_" . $blog->blog_id . "_user_level' AND user_id = " . $user_id;
			$user_member = $wpdb->get_results($sql);
					
			// is the user a member? if so add it to the list returned, everyone gets blog number 1
			if (($user_member[0]->meta_value > 0 || $blog->blog_id == 1) || DenUser::is_subscribed($blog->blog_id))
				$bids[]= $blog->blog_id;
		}				

		$output=array();
		foreach($bids as $bid){
			if(DenUser::field('language') == 'en'){
				if($bid == "1"){
					$get_post = 'select * from wp_posts inner join wp_icl_translations on wp_posts.ID = wp_icl_translations.element_id where wp_icl_translations.element_type = "post_post" and wp_posts.post_status = "publish" and wp_icl_translations.language_code = "en"';					
				}else{
					$get_post = 'select * from wp_'.$bid.'_posts inner join wp_'.$bid.'_icl_translations on wp_'.$bid.'_posts.ID = wp_'.$bid.'_icl_translations.element_id where wp_'.$bid.'_icl_translations.element_type = "post_post" and wp_'.$bid.'_posts.post_status = "publish" and wp_'.$bid.'_icl_translations.language_code = "en"';
				}
			}else{
				if($bid == "1"){
					$get_post = 'select * from wp_posts inner join wp_icl_translations on wp_posts.ID = wp_icl_translations.element_id where wp_icl_translations.element_type = "post_post" and wp_posts.post_status = "publish" and wp_icl_translations.language_code = "fr"';					
				}else{
					$get_post = 'select * from wp_'.$bid.'_posts inner join wp_'.$bid.'_icl_translations on wp_'.$bid.'_posts.ID = wp_'.$bid.'_icl_translations.element_id where wp_'.$bid.'_icl_translations.element_type = "post_post" and wp_'.$bid.'_posts.post_status = "publish" and wp_'.$bid.'_icl_translations.language_code = "fr"';				
				}
			}
			$posts_query = $wpdb->get_results($get_post);
			foreach ($posts_query as $authors_post) {
				switch_to_blog($bid);
				$url = str_replace(array('?lang=en', '?lang=fr'), '', get_permalink($authors_post->ID)) . '?tid=' . $authors_post->ID . '&blog_id=' . $bid;
						$url_data = parse_url($url);
						$url_data['host'] = $_SERVER['SERVER_NAME'];

						$authors_post->permalink = unparse_url($url_data);

						$d = strtotime($authors_post->post_date_gmt);

				
						$authors_post->blogID = $bid;
						$authors_post->blogUrl =  get_blog_option($bid,'siteurl');
						$authors_post->blogName =  get_blog_option($bid,'blogname');
						$authors_post->commentcount = get_comments_number($authors_post->ID);
						$authors_post->thumbnail =wp_get_attachment_url( get_post_thumbnail_id($authors_post->ID) );
						$authors_post->theme_excerpt =theme_excerpt('');
						$output[$d]=$authors_post;
				restore_current_blog();
			}

		}
		krsort($output);
		return $output;
	}



/* function for Top Activites (Popular) */

/*function create_popular_alerts_type() {
	$args = array(
			'labels' => array(
				'name' => __( 'Popular' ),
				'singular_name' => __( 'Popular' )
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
	        'capability_type' => 'post',
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
	register_post_type( 'popular', $args);
	flush_rewrite_rules();
	
	/* post type End popular*/
	
	
	/* post type Alert*/
/*	$args = array(
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
	            'editor',
	            'thumbnail',
	            'excerpt',
	            'page-attributes','template'
	        )
		);
	register_post_type( 'alerts', $args);
	flush_rewrite_rules();
	/*End alerts*/
	
	
	/* post type Banners */
	
/*	$args = array(
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
/*}*/

/*add_action( 'init', 'create_popular_alerts_type' );*/


/*function End for Top Activites (Popular) */


/*admin area css starts*/
/*add_action('admin_head', 'custom_admin_css');

function custom_admin_css() {
	//echo theme_url;
  wp_enqueue_style( 'custom_admin', theme_url.('/stylesheets/custom_admin.css'));
}
/*admin area css ends*/

/*adding sidebar*/
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
        'description' => __( 'Enter Here First Banner Short code eg [banner id="xxx"].', 'theme-slug' )
        
    ) );
    register_sidebar( array(
        'name' => __( 'Left Banner Bottom', 'theme-slug' ),
        'description' => __( 'Enter Here Second Banner Short code eg [banner id="xxx"].', 'theme-slug' ),
        'before_widget' => '<p>',
		'after_widget'  => '</p>'
        
    ) );
}
add_action( 'widgets_init', 'theme_slug_widgets_init' );

function remove_menus(){
  
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
}

add_image_size("sidebar_banner","185","274",true);
add_image_size("crusal_thumbnail","174","99",true);
add_image_size("crusal_banner","689","388",true);
add_image_size("post_thumbnail","172","166",true);

/*shortcode support for widget*/
add_filter('widget_text', 'do_shortcode');
/**/

/*add_action('admin_head', 'disable_icl_metabox',99);
function disable_icl_metabox() {
global $post;
remove_meta_box('icl_div_config',$post->posttype,'normal');
}
/**
 * Get excerpt from string
 */
/*function theme_excerpt($num, $readmore = true) {
	
	
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
}*/
/*function remove_shortcode_from_index($excerpt) {
  if ( is_home() ) {
    $excerpt = strip_shortcodes( $excerpt );
  }
  return $excerpt;
}
add_filter('the_excerpt', 'remove_shortcode_from_index');
*/
/*add_action('wpmu_new_blog', 'add_new_blog_field');
function add_new_blog_field(){*/
	// Add text field on blog signup form
add_action('signup_blogform', 'add_extra_field_on_blog_signup');
function add_extra_field_on_blog_signup() { ?>
    <label>An extra field</label>
    <input type="text" name="extra_field" value="" />
<?php
}

// Append the submitted value of our custom input into the meta array that is stored while the user doesn't activate
add_filter('add_signup_meta', 'append_extra_field_as_meta');
function append_extra_field_as_meta($meta) {
    if(isset($_REQUEST['extra_field'])) {
        $meta['extra_field'] = $_REQUEST['extra_field'];
    }
    return $meta;
}

// When the new site is finally created (user has followed the activation link provided via e-mail), add a row to the options table with the value he submitted during signup
add_action('wpmu_new_blog', 'process_extra_field_on_blog_signup', 10, 6);
function process_extra_field_on_blog_signup($blog_id, $user_id, $domain, $path, $site_id, $meta) {
    update_blog_option($blog_id, 'extra_field', $meta['extra_field']);
}
// add_action('wp_footer', 'delta_main_scripts');
// function delta_main_scripts(){
// 	wp_enqueue_script('custom_main', get_stylesheet_directory_uri().'/js/custom_main.js');
// 	}



/*	$excerpt = preg_replace('/\[(.*)\]/', '', $postContent);
	$excerpt = mb_substr( wp_strip_all_tags( $excerpt ),0, $len);

	$end = strrpos($excerpt, ".");

	if($end){
		return substr($excerpt, 0, $end + 1);
	}

	return $excerpt . "...";

}*/