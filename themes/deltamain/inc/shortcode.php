<?php 
function sidebar_banner_shortcode($atts){
	//print_r([$atts]);
	echo $p=$atts['id'];
	 query_posts("post_type=gallery&p=".$p);
	  while (have_posts()):the_post()?>
					<?php $attachment_ids = easy_image_gallery_get_image_ids(); ?>
					<?php foreach ( $attachment_ids as $attachment_id ) {
								// get original image
			$image_link = get_post($attachment_id);
			$image = wp_get_attachment_image_src( $attachment_id,'sidebar_banner',true);	?>
			<li><img src="<?php echo $image[0];?>" /></li>
			<?php }  ?>
			<?php endwhile; wp_reset_query();
	}
add_shortcode('banner','sidebar_banner_shortcode');

?>
