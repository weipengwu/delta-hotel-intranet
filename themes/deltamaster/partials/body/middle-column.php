<?php

if(is_front_page())
{

?>
<section id="middle-column">
    <section class="panel news main">
        <h3 class="header"><?= _e('Delta News and Highlights','deltamain') ?></h3>
    </section>
<!-- new code for header -->
    <div class="slider slider-for">
		<!---->
		<?php query_posts("post_type=gallery&p=289");?>
						
					<?php while (have_posts()):the_post()?>
					
					<?php $attachment_ids = easy_image_gallery_get_image_ids(); ?>
					<?php foreach ( $attachment_ids as $attachment_id ) {
								// get original image
			$image_link = get_post($attachment_id);
			$image = wp_get_attachment_image_src( $attachment_id,'crusal_banner',true);	?>
			<div>
			<div class="iamge"><img src="<?php echo str_replace("http://", "https://", $image[0]);?>" alt="home carousel" width="689" height="388" /></div>
			<div class="caption">
								<span class="primary"><?php echo $image_link->post_content; ?></span> <span class="secondary"><?php echo $image_link->post_excerpt; ?></span>
							</div>
			</div>
			
			<?php 
			
		}  ?> <?php endwhile; wp_reset_query();?>
		<!---->
		
    
					</div>
				
                    <div class="slider slider-nav ">
						<!---->
						<?php query_posts("post_type=gallery&p=289");?>
						
					<?php while (have_posts()):the_post()?>
					
					<?php $attachment_ids = easy_image_gallery_get_image_ids(); ?>
					<?php foreach ( $attachment_ids as $attachment_id ) {
								// get original image
			$image_link = get_post($attachment_id);
			$image = wp_get_attachment_image_src( $attachment_id,'crusal_thumbnail',true);	?>
			<!--li><a href="<?php echo $image_link->guid; ?>"><img src="" alt="" title="<?php echo $image_link->post_excerpt; ?>" ></a></li-->
			<div class="item">
                            <img src="<?php echo str_replace("http://", "https://", $image[0]);?>" alt="carousel thumbnail" width="174" height="99" />

                            <h4><?php echo $image_link->post_content; ?></h4><a href="#">Learn more&gt;</a>
                        </div>
			<?php 
			
		}  ?> <?php endwhile; wp_reset_query();?>
					
                    </div>


<?php
function the_network_posts(){
	
	
	$r_posts =  get_network_posts();
	/*echo '<pre>';
	print_r($r_posts);
	echo '</pre>';*/
	
	$totalPosts=count($r_posts);	
	$NumberOfPage=ceil($totalPosts/3); ?>
	<input type="hidden" value="<?php echo $NumberOfPage; ?>" id="totalPages">
	<?php
	$r_posts=array_slice($r_posts, 0, 3);
	//print_r($r_posts);
	foreach($r_posts as $posts){
		
			$postContent=$posts->post_content;
			$excerpt = preg_replace('/\[(.*)\]/', '', $postContent);
			$ThemeExcerpt=substr($excerpt,0,150);
			$thumbnail=$posts->thumbnail;
		
		$html.='<div class="feed row"><div class="columns large-3"><a href="'.$posts->permalink.'">';
		if($thumbnail=='' || $thumbnail==null){ 
		   $html.='<img src="' .theme_url.'/images/dummyPostImage.png" alt="dummy post image"/>';
		     } else {
			$html.='<img src="'. $posts->thumbnail .'" alt="post image"/>';
			 }
			 $html.='</a></div>';
                $html.='<div class="columns large-6"><a href="'. $posts->permalink.'"><h4>'. apply_filters( 'the_title', $posts->post_title, $posts->ID ) .'</h4></a>
                  <p>'.apply_filters( 'the_content', $ThemeExcerpt, $posts->ID ).'</p>';
                  if (strpos(DenUser::get_meta_field('language'), 'fr') === false)
                  {
                    $html .= '<small>Posted '.$string12 . $posts->post_date.' by '. $posts->post_author .' in <a href="'. $posts->blogUrl  .'">'. $posts->blogName .'</a></small>';
                }
                else
                {
                	$html .= '<small>Posté '.$posts->post_date.' par '. $posts->post_author .' dans <a href="'. $posts->blogUrl  .'">'. $posts->blogName .'</a></small>';	
                }
                $html .= '</div>';
		
		
                $html.='<div class="columns large-3">
                    <a class="comments"  href="'. $posts->permalink .'#comments">'. $posts->commentcount .'</a>
                    '. getPostLikeLink( $posts->ID ) .'</div></div>'; 
	}
	
	return $html;
}
?>
<?php
	query_posts('posts_per_page=3');
	
	?>
	<?php if ( have_posts() ) : ?>

<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
<? if(!DenUser::is_member(get_current_blog_id()) && get_post_meta(get_the_ID(), '_member_post', true) == 'members') continue;?>

<div class="feed row">
    <div class="columns large-3">
        <a href="<?php the_permalink(); ?>"><?php if(has_post_thumbnail())
         { ?>
         <? the_post_thumbnail();?>
<?php } else { ?><img src="<?php echo get_template_directory_uri(); ?>/images/dummyPostImage.png" /> <?php } ?></a>
    </div>
    <div class="columns large-6">
        <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
        <p><?php the_excerpt(); ?></p>
        <small><? _e('Posted', 'deltamain');?> <?php the_date(); ?> <? _e('by', 'deltamain'); ?> <?php the_author(); ?> <? _e('in', 'deltamain');?> <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></small>
    </div>
    <div class="columns large-3">
        <a class="comments" href="<?php the_permalink(); ?>#comments"><?php echo $commentcount = comments_number('0', '1', '%'); ?></a>
       <?php echo getPostLikeLink( get_current_blog_id(), get_the_ID() ); ?>
    </div>
</div>




<?php	
	endwhile;
	endif;
	?>
    <section class="panel headlines">
        <h3 class="header"><?= _e('Delta Headlines', 'deltamain') ?><small class="subscribe"><?= _e('Customize', 'deltamain') ?></small></h3>
        <div class="body feeds clearfix">
			
			<?php
			echo the_network_posts(); ?>
				
			<div id="results"></div>
        </div>
	 
	 
	 
	 
	 <div class="no_more more" id="no_more_button" style="display:none;"><?= _e('No more headlines', 'deltamain') ?></div>
	 
        <a class="load_more more" id="load_more_button" href="javascript:void(0);"><?= _e('Load more headlines', 'deltamain') ?></a>
	<div class="animation_image more" style="display:none;"><img src="wp-content/themes/deltamain/images/ajax-loader.gif" style="vertical-align: middle;" alt="loading"> Loading...</div>
    </section>
</section>

<?php 
}
else
{
?>
<section id="middle-column">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h1><?php print_r(the_title()); ?></h1>

<?php print_r(the_content()); ?>

<?php endwhile ?>
<?php endif ?>
</section>
<?php
}
?>

