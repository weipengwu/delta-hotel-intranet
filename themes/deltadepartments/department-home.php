<?
/*
 * Template Name: Department Home Page
 *
 */
?>
<? get_header() ?>
<? include 'partials/body/left-column.php'; ?>
<section id="middle-column" class="department-home">
  	<section class="panel news main">
        <h3 class="header"><? echo sprintf(__('%s News and Highlights','deltamain'), get_bloginfo('name')); ?></h3>
    </section>
<!-- new code for header -->
    <div class="slider slider-for">
        <!---->
        <?php query_posts("post_type=home_carousel&posts_per_page=-1");?>
        <?php while (have_posts()):the_post()?>
        <? $data = get_post_meta(get_the_ID(), '_related_resources', true);?>
        <div>
            <div class="imageholder"><a href="<?= urldecode($data[0]['url']) ?>"><img src="<?php echo str_replace("http://", "https://", get_field('gallery_image'));?>"></a></div>
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
                <img src="<?php echo str_replace("http://", "https://", get_field('gallery_image'));?>" width="174" height="99">

                <h4><?php the_title();?></h4><a href="<?= urldecode($data[0]['url']) ?>"><? _e('Learn more','deltamain')?> &gt;</a>
            </div>
             <?php endwhile; wp_reset_query();?>

    </div>


<section class="panel headlines">
<h3 class="header"><? echo sprintf(__('%s News','deltamain'), get_bloginfo('name')); ?>
    <? if(DenUser::is_subscribed(get_current_blog_id())):?>
        <small class="unsubscribe"><?  _e('Unsubscribe', 'deltamain') ;?></small>
    <? elseif(DenUser::is_member(get_current_blog_id())): ?>
        <small class="unsubscribe disabled"><?  _e('Unsubscribe', 'deltamain') ;?></small>
    <? else: ?>
        <small class="subscribe"><?  _e('Subscribe', 'deltamain') ;?></small>
    <? endif;?>
</h3>
<div class="body feeds clearfix">




<?php
function the_blog_posts(){
    
    
    $r_posts =  get_blog_posts();
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
                    $html .= '<small>Posted '.$string12 . $posts->post_date.' by '. $author_info->first_name .' '. $author_info->last_name  .' in <a href="'. $posts->blogUrl  .'">'. $posts->blogName .'</a></small>';
                }
                else
                {
                    $html .= '<small>Posté '.$posts->post_date.' par '. $author_info->first_name .' '. $author_info->last_name  .' dans <a href="'. $posts->blogUrl  .'">'. $posts->blogName .'</a></small>';   
                }
                $html .= '</div>';
        
        
                $html.='<div class="columns large-3">
                    <a class="comments"  href="'. $posts->permalink .'#comments">'. $posts->commentcount .'</a>
                    '. getPostLikeLink( get_current_blog_id(), $posts->ID ) .'</div></div>'; 
    }
    
    return $html;
}
?>
<?php
            echo the_blog_posts(); ?>



	
<div id="results"></div>
</div>
<?php if(count(get_blog_posts())  > 3):?>
<!-- <input type="hidden" value="<?php echo $pages; ?>" id="totalPages"> -->

<div class="no_more more" id="no_more_button" style="display:none;">No more headlines</div>

<a class="load_more more" id="load_more_button" href="javascript:void(0);">Load more headlines</a>
<div class="animation_image more" style="display:none;"><img src="wp-content/themes/deltamain/images/ajax-loader.gif" style="vertical-align: middle;"> Loading...</div>
<? endif; ?>
</section>
</section>
<? include 'partials/body/right-column.php'; ?>
</section>
<? get_footer() ?>