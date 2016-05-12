<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../../../wp-load.php');

// Our variables
// $postType = (isset($_GET['postType'])) ? $_GET['postType'] : 'post';
$category = (isset($_GET['category'])) ? $_GET['category'] : '';
$author_id = (isset($_GET['author'])) ? $_GET['taxonomy'] : '';
$taxonomy = (isset($_GET['taxonomy'])) ? $_GET['taxonomy'] : '';
$tag = (isset($_GET['tag'])) ? $_GET['tag'] : '';
$exclude = (isset($_GET['postNotIn'])) ? $_GET['postNotIn'] : '';
$numPosts = (isset($_GET['perpage'])) ? $_GET['perpage'] : 3;
$page = (isset($_GET['page'])) ? $_GET['page'] : 0;


$args = array(
    // 'post_type' => $postType,
    // 'category_name' => $category,

    // 'author' => $author_id,

    'posts_per_page' => $numPosts,
    'offset'          => ($page-1)*$numPosts,

    'orderby'   => 'menu_order',
    'order'     => 'ASC',

    'post_status' => 'publish',
);


$loop = new WP_Query($args); 
?>

<?php 
// our loop  
if ($loop->have_posts()) :  
    while ($loop->have_posts()):  
    $loop->the_post();?>

<div class="feed row">
    <? if(has_post_thumbnail()): ?>
        <div class="columns" style="width: 170px;">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('thumbnail'); ?>
            </a>
        </div>
        <div class="columns" style="width: 380px; padding: 0px;">
    <? else: ?>
        <div class="columns" style="width: 550px; padding: 0px; padding-left: 14px;">
    <? endif; ?>
    
        <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
        <p><?php the_excerpt(); ?></p>
        <small>Posted <?php the_date(); ?> by <?php the_author(); ?> in <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></small>
    </div>
    <div class="columns" style="width: 125px; padding-right: 0px;">
        <a class="comments" href="<?php the_permalink(); ?>#comments"><?php echo $commentcount = comments_number('0', '1', '%'); ?></a>
        <?php echo getPostLikeLink( get_the_ID() ); ?>
    </div>
</div>  


<!-- Do stuff -->

<?php endwhile; endif; wp_reset_query(); ?>