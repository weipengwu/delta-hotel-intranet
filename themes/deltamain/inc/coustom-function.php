<?php
//include 'multi-image-metabox.php';

/**/

//----------------------------------------------
//--------------add theme support for thumbnails
//----------------------------------------------
if ( function_exists( 'add_theme_support')){
	add_theme_support( 'post-thumbnails' );
}
add_image_size( 'admin-list-thumb', 80, 80, true); //admin thumbnail



//----------------------------------------------
//----------register and label gallery post type
//----------------------------------------------
$gallery_labels = array(
	'name' => _x('Banners', 'post type general name'),
	'singular_name' => _x('Banners', 'post type singular name'),
	'add_new' => _x('Add New', 'gallery'),
	'add_new_item' => __("Add New Banner"),
	'edit_item' => __("Edit Banner"),
	'new_item' => __("New Banner"),
	'view_item' => __("View Banner"),
	'search_items' => __("Search Banner"),
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
	'supports' => array('title','thumbnail')
	//'menu_icon' => get_bloginfo('template_directory') . '/images/photo-album.png' //16x16 png if you want an icon
); 
register_post_type('gallery', $gallery_args);


//----------------------------------------------
//------------------------create custom taxonomy
//----------------------------------------------
//add_action( 'init', 'jss_create_gallery_taxonomies', 0);

function jss_create_gallery_taxonomies(){
	register_taxonomy(
		'phototype', 'gallery', 
		array(
			'hierarchical'=> true, 
			'label' => 'Banner',
			'singular_label' => 'Banner',
			'rewrite' => true
		)
	);	
}


//----------------------------------------------
//--------------------------admin custom columns
//----------------------------------------------
//admin_init
add_action('manage_posts_custom_column', 'jss_custom_columns');
add_filter('manage_edit-gallery_columns', 'jss_add_new_gallery_columns');

function jss_add_new_gallery_columns( $columns ){
	$columns = array(
		'cb'				=>		'<input type="checkbox">',
		'jss_post_thumb'	=>		'Thumbnail',
		'title'				=>		'BannerTitle',
		/*'phototype'			=>		'Photo Type',*/
		'author'			=>		'Author',
		'date'				=>		'Date'
		
	);
	return $columns;
}

function jss_custom_columns( $column ){
	global $post;
	
	switch ($column) {
		case 'jss_post_thumb' : echo the_post_thumbnail('admin-list-thumb'); break;
		case 'description' : the_excerpt(); break;
		case 'phototype' : echo get_the_term_list( $post->ID, 'phototype', '', ', ',''); break;
	}
}

//add thumbnail images to column
add_filter('manage_posts_columns', 'jss_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'jss_add_post_thumbnail_column', 5);
add_filter('manage_custom_post_columns', 'jss_add_post_thumbnail_column', 5);

// Add the column
function jss_add_post_thumbnail_column($cols){
	$cols['jss_post_thumb'] = __('Thumbnail');
	return $cols;
}

function jss_display_post_thumbnail_column($col, $id){
  switch($col){
    case 'jss_post_thumb':
      if( function_exists('the_post_thumbnail') )
        echo the_post_thumbnail( 'admin-list-thumb' );
      else
        echo 'Not supported in this theme';
      break;
  }
}
/*Meta Boxes*/

//add_action( 'add_meta_boxes', 'dynamic_add_custom_box' );

/* Do something with the data entered */
//add_action( 'save_post', 'dynamic_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
/*function dynamic_add_custom_box() {
    add_meta_box(
        'dynamic_sectionid',
        __( 'Banner Images', 'myplugin_textdomain' ),
        'dynamic_inner_custom_box',
        'gallery');
}

/* Prints the box content */
/*function dynamic_inner_custom_box() {
    global $post;
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'dynamicMeta_noncename' );
    ?>
    <div id="meta_inner" style="width:100%">
    <?php

    //get the saved meta as an arry
    $banner = get_post_meta($post->ID,'_img_banner',true);

    $c = 0;
    //print_r($banner);<input type="text" name="_img_banner[%1$s][url]" value="%2$s" />-- Caption : <input type="text" name="_img_banner[%1$s][cap]" value="%3$s" />&nbsp;&nbsp;<input type="button" name="upload_image_button" class="upload_image_button button-primary" id="upload_image_button" value="Upload Banner" />&nbsp;&nbsp;
    if ( count( $banner ) > 0 ) {
		echo'<div class="outer">';
        foreach( $banner as $baner ) {
			
            if ( isset( $baner['url'] ) || isset( $baner['cap'] ) ) {
                printf( '<div class="admin_banner"><img src="'.$baner['url'].'" title="'.$baner['url'].'" alt="'.$baner['url'].'"  /><br/><span class="remove button-primary">%4$s</span></div>', $c, $baner['url'], $baner['cap'], __( 'Remove Banner' ) );
                /*printf( '<p>Image Url <img src="_img_banner[%1$s][url]" value="%2$s"  alt="_img_banner[%1$s][cap]" /> -- Caption : <input type="text" name="_img_banner[%1$s][cap]" value="%3$s" /><span class="remove">%4$s</span></p>', $c, $baner['url'], $baner['cap'], __( 'Remove Banner' ) );*/
    /*            $c = $c +1;
            }
          
        }
         echo '</div>';
    }

    ?>
<span id="here"></span>
<span class="add"><?php _e('Add Banner'); ?></span>
<script>
    var $ =jQuery.noConflict();
    $(document).ready(function() {
        var count = <?php echo $c; ?>;
        $(".add").click(function() {
            count = count + 1;

            $('#here').append('<p> Image Url <input type="text" name="_img_banner['+count+'][url]" value="" class="_img_banner"/> -- Caption : <input type="text" name="_img_banner['+count+'][cap]" value="" />&nbsp;&nbsp;<input type="button" name="upload_image_button['+count+']" class="upload_image_button['+count+'] button button-primary" id="upload_image_button['+count+']" value="Upload Banner" />&nbsp;&nbsp;<span class="remove button-primary remove1">Remove Banner</span></p>' );
            return false;
        });
        $(".remove").live('click', function() {
            $(this).parent().remove();
        });
      });
    
    </script>
</div><?php

}

/* When the post is saved, saves our custom data */
/*function dynamic_save_postdata( $post_id ) {
    // verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !isset( $_POST['dynamicMeta_noncename'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['dynamicMeta_noncename'], plugin_basename( __FILE__ ) ) )
        return;

    // OK, we're authenticated: we need to find and save the data

    $banner = $_POST['_img_banner'];
	print_r($banner); //die();
    update_post_meta($post_id,'_img_banner',$banner);
}

function my_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', get_bloginfo('template_url') . '/inc/upload.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}
function my_styles() {
wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'my_scripts');
add_action('admin_print_styles', 'my_styles');
 function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', get_bloginfo('template_url') . '/js/upload.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}
function my_admin_styles() {
wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');
*/

/**/
/*
add_action('admin_init', 'images_init');
add_action('save_post', 'save_images_link');
function images_init(){
          //$post_types = get_post_types();
          //foreach ( $post_types as $post_type ) {
                add_meta_box("my-images", "Pictures", "images_link", "gallery", "normal", "low");
          //}
        }
function images_link(){
        global $post;
        $custom  = get_post_custom($post->ID);
        $link    = $custom["_link"][0];
        $count   = 0;
        echo '<div class="link_header">';
        $query_images_args = array(
                'post_type' => 'attachment',
                'post_mime_type' =>array(
                                'jpg|jpeg|jpe' => 'image/jpeg',
                                'gif' => 'image/gif',
                                'png' => 'image/png',
                                ),
                'post_status' => 'inherit',
                'posts_per_page' => -1,
                );
        $query_images = new WP_Query( $query_images_args );
        $images = array();

        echo '<div class="frame">';

        $thelinks = explode(',', $link);

        foreach ( $query_images->posts as $file) {
           if(in_array($images[]= $file->ID, $thelinks)){
              echo '<label><input type="checkbox" group="images" value="'.$images[]= $file->ID.'" checked /><img src="'.$images[]= $file->guid.'" width="60" height="60" /></label>';
                 }else{
              echo '<label><input type="checkbox" group="images" value="'.$images[]= $file->ID.'" /><img src="'.$images[]= $file->guid.'" width="60" height="60" /></label>';
                 }
                $count++;
        }
        echo '<br /><br /></div></div>';
        echo '<input type="hidden" name="link" class="field" value="'.$link.'" />';
        echo '<div class="images_count"><span>Files: <b>'.$count.'</b></span> <div class="count-selected"></div></div>';
}
function save_images_link(){
        global $post;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){ return $post->ID; }
        update_post_meta($post->ID, "_link", $_POST["link"]);
}
add_action( 'admin_head-post.php', 'images_css' );
add_action( 'admin_head-post-new.php', 'images_css' );
function images_css() {
        echo '<style type="text/css">
        #my-images .inside{padding:0px !important;margin:0px !important;}
        .frame{
                width:100%;
                height:320px;
                overflow:auto;
                background:#e5e5e5;
                padding-bottom:10px;
                }
        .field{width:800px;}
        #results {
                width:100%;
                overflow:auto;
                background:#e5e5e5;
                padding:0px 0px 10px 0px;
                margin:0px 0px 0px 0px;
                }
        #results img{
                border:solid 5px #FDD153;
                -moz-border-radius:3px;
                margin:10px 0px 0px 10px;
                }
        .frame label{
                margin:10px 0px 0px 10px;
                padding:5px;
                background:#fff;
                -moz-border-radius:3px;
                border:solid 1px #B5B5B5;
                height:60px;
                display:block;
                float:left;
                overflow:hidden;
                }
        .frame label:hover{
                background:#74D3F2;
                }
        .frame label.checked{background:#FDD153 !important;}
        .frame label input{
                opacity:0.0;
                position:absolute;
                top:-20px;
                }
        .images_count{
                font-size:10px;
                color:#666;
                text-transform:uppercase;
                background:#f3f3f3;
                border-top:solid 1px #ccc;
                position:relative;
                }
        .selected_title{border-top:solid 1px #ccc;}
        .images_count span{
                color:#666;
                padding:10px 6px 6px 12px;
                display:block;
                }
        .count-selected{
                font-size:9px;
                font-weight:bold;
                text-transform:normal;
                position:absolute;
                top:10px;
                right:10px;
                }
                </style>';
}
add_action( 'admin_head-post.php', 'images_js' );
add_action( 'admin_head-post-new.php', 'images_js' );
function images_js(){?>
<script type="text/javascript">
jQuery(document).ready(function($){

  $('.frame input').change(function() {
        var values = new Array();
        $("#results").empty();

        var result = new Array();

        $.each($(".frame input:checked"), function() {
                result.push($(this).attr("value"));
                $(this).parent().addClass('checked');
        });
        $('.field').val(result.join(','));
        $('.count-selected').text('Selected: '+result.length);

        $.each($(".frame input:not(:checked)"), function() {
                $(this).parent().removeClass('checked');
        });

  });

        var result = new Array();
        $.each($(".frame input:checked"), function() {
                result.push($(this).attr("value"));
                $(this).parent().addClass('checked');
        });
        $('.field').val(result.join(','));
        $('.count-selected').text('Selected: '+result.length);

        $.each($(".frame input:not(:checked)"), function() {
                $(this).parent().removeClass('checked');
        });
});

</script>
<?}

function wps_thumbnails_list(){
           global $post;
           $image = get_post_meta($post->ID, '_link', true);
           $image = explode(",", $image);
           foreach($image as $images){
                $url = wp_get_attachment_image_src($images, 1, 1);
                echo '<a href="';
                echo $url[0];
                echo '" class="lightbox">';
                echo wp_get_attachment_image($images,'thumbnail', 1, 1);
                echo '</a>';
                }
}*/
