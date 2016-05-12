<?php

/**
 * Get excerpt from string
 * 
 * @param String $str String to get an excerpt from
 * @param Integer $startPos Position int string to start excerpt from
 * @param Integer $maxLength Maximum length the excerpt may be
 * @return String excerpt
 */
function getExcerpttt($str, $startPos=0, $maxLength=100) {
	if(strlen($str) > $maxLength) {
		$excerpt   = substr($str, $startPos, $maxLength-3);
		$lastSpace = strrpos($excerpt, ' ');
		$excerpt   = substr($excerpt, 0, $lastSpace);
		$excerpt  .= '...';
	} else {
		$excerpt = $str;
	}
	
	return $excerpt;
}



if(is_front_page())
{

?>
<section id="middle-column">

    <section class="panel headlines">
        <h3 class="header"><? _e('Delta News', 'deltamain') ?>
            <? if(DenUser::is_subscribed(get_current_blog_id())):?>
                <small class="unsubscribe"><?  _e('Unsubscribe', 'deltamain') ;?></small>
            <? else: ?>
                <small class="subscribe"><?  _e('Subscribe', 'deltamain') ;?></small>
            <? endif;?>
        </h3>
        <div class="body feeds clearfix">
<?
            function the_blog_posts(){
    
    
    $r_posts =  get_blog_posts();
    // echo '<pre>';
    // print_r($r_posts);
    // echo '</pre>';
    
    $totalPosts=count($r_posts);    
    $NumberOfPage=ceil($totalPosts/3); ?>
    <input type="hidden" value="<?php echo $NumberOfPage; ?>" id="totalPages">
    <?php
    $r_posts=array_slice($r_posts, 0, 3);
    //print_r($r_posts);
    foreach($r_posts as $posts){
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
    }
    
    return $html;
}

    ?>

<? echo the_blog_posts();?>

    
<div id="results"></div>
</div>
<?php if(count(get_blog_posts()) > 3):?>
<!-- <input type="hidden" value="<?php echo $pages; ?>" id="totalPages"> -->

<div class="no_more more" id="no_more_button" style="display:none;">No more headlines</div>

<a class="load_more more" id="load_more_button" href="javascript:void(0);">Load more headlines</a>
<div class="animation_image more" style="display:none;"><img src="wp-content/themes/deltamain/images/ajax-loader.gif" style="vertical-align: middle;"> Loading...</div>
<? endif; ?>
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


