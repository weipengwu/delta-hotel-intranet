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
			<?php query_posts("post_type=home_carousel&posts_per_page=-1");?>
			<?php while (have_posts()):the_post()?>
			<? $data = get_post_meta(get_the_ID(), '_related_resources', true);?>
		<div>
		<div class="imageholder"><a href="<?= urldecode($data[0]['url']) ?>"><img src="<?php echo str_replace("http://", "https://", get_field('gallery_image'));?>" alt="home carousel"></a></div>
			<div class="caption">
				<span class="primary"><?php the_title();?></span>
			</div>
		</div>
		<?php endwhile; wp_reset_query();?>
		<!---->
	</div>
				
     <div class="slider slider-nav ">
		<?php query_posts("post_type=home_carousel&posts_per_page=-1");?>
						
		<?php while (have_posts()):the_post()?>
		<? $data = get_post_meta(get_the_ID(), '_related_resources', true);?>
		<div class="item">
            <img src="<?php echo str_replace("http://", "https://", get_field('gallery_image'));?>" alt="carousel thumbnail" width="174" height="99">

            <h4><?php the_title();?></h4><a href="<?= urldecode($data[0]['url']) ?>"><? _e('Learn more','deltamain')?>&gt;</a>
        </div>
		<?php endwhile; wp_reset_query();?>

    </div>
    <section class="panel headlines">
        <h3 class="header"><? _e('Delta Headlines', 'deltamain') ?><small class="customize"><?= _e('Customize', 'deltamain') ?></small></h3>
        <div class="body feeds clearfix">
        <?
        	function the_network_posts(){
	
	
	$r_posts =  get_all_posts();
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
		switch_to_blog($posts->blogID);
		if(!DenUser::is_member($posts->blogID) && get_post_meta($posts->ID, '_member_post', true) == 'members') continue;
			$postContent=$posts->post_content;
			$excerpt = preg_replace('/\[(.*)\]/', '', strip_tags($postContent));
			$ThemeExcerpt=substr($excerpt,0,150);
			$thumbnail=$posts->thumbnail;
			$author_info = get_userdata($posts->post_author);
		
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
                    $html .= '<small>Posted '.$string12 . date('F d, Y', strtotime($posts->post_date)) .' by '. $author_info->first_name .' '. $author_info->last_name .' in <a href="'. $posts->blogUrl  .'">'. $posts->blogName .'</a></small>';
                }
                else
                {
                	$html .= '<small>Posté '.$posts->post_date.' par '. $author_info->first_name .' '. $author_info->last_name .' dans <a href="'. $posts->blogUrl  .'">'. $posts->blogName .'</a></small>';	
                }
                $html .= '</div>';
		
		
                $html.='<div class="columns large-3">
                    <a class="comments"  href="'. $posts->permalink .'#comments">'. $posts->commentcount .'</a>
                    '. getPostLikeLink( $posts->blogID, $posts->ID ) .'</div></div>'; 
        restore_current_blog();
	}
	
	return $html;
}


        ?>
        <? echo the_network_posts();?>
        <div id="results"></div>
        </div>
	 
	 	<div class="no_more more" id="no_more_button" style="display:none;"><?= _e('No more headlines', 'deltamain') ?></div>
	 
        <a class="load_more more" id="load_more_button" href="javascript:void(0);"><? _e('Load more headlines', 'deltamain') ?></a>
		<div class="animation_image more" style="display:none;"><img src="wp-content/themes/deltamain/images/ajax-loader.gif" style="vertical-align: middle;"> Loading...</div>
    </section>

</section>

<?php 
}
else
{
?>
YOU SHOULD NEVER SEE THIS
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

<script type="text/javascript" src="wp-content/themes/deltamain/js/custom_main.js"></script>
