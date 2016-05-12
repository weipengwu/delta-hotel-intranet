<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 *
 */
global $post;
if(!DenUser::is_member(get_current_blog_id()) && get_post_meta($post->ID, '_member_post', true) == 'members'){
	wp_redirect(home_url());
	exit;
}
get_header();

?>
<section id="left-column">
	<div class="sub-blog-title"><?= get_bloginfo('name'); ?></div>
    <nav class="collapsingNav" id="leftNav">
    	<? query_posts('post_type=page&showposts=12&orderby=menu_order&order=ASC'); ?>
    	<ul class="departmentlist">
    	<? while(have_posts()): ?>
            <? the_post() ?>
            <li class="page_item page-item-18"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
        <? endwhile; ?>
    	</ul>
		
    </nav>

    <? display_top_activities(12); ?>

    <? display_popular_resources(12); ?>

    <? 
        query_posts('post_type=gallery');
        while(have_posts()):the_post();
        if(get_field('sidebar') == 'Left'):
    ?>
    <section class="messages">
    <ul data-orbit data-options="slide_number:false;
                                        bullets:false;
                                        timer_speed:5000;
                                        resume_on_mouseout:true;">
    <?php 
        $attachment_ids = easy_image_gallery_get_image_ids(); ?>
            <?php foreach ( $attachment_ids as $attachment_id ) {
            $image_link = get_post($attachment_id);
            $image = wp_get_attachment_image_src( $attachment_id,'sidebar_banner',true);?>
            <li><img src="<?php echo $image[0];?>" /></li>
            <?php }  ?>
    </ul>
        <nav>
            <a class="prev" href="#">prev</a>
            <a class="next" href="#">next</a>
        </nav>
    </section>
    <?php endif;endwhile;?>
    <? wp_reset_query();//end wp loop?>
</section>
<?php

// print_r($res);die;


$permalink = get_permalink();

switch_to_blog($_REQUEST['blog_id']);
$id = url_to_postid($_SERVER['REQUEST_URI']);

global $post;
$res = new WP_Query('p=' .$id);

?>
<section id="middle-column">
	<?php while(have_posts()): the_post() ?>
	<article class="post">
	                	
		<a href="<?php echo home_url();?>"><? _e('Back to Headlines', 'deltamain');?></a>         	
		<div class="title"><?php the_title(); ?></div>
							
		<section>
			<header>
			<p class="date group">
					<? _e('Posted', 'deltamain');?> <?php the_date('M d, Y');?> <? _e('by', 'deltamain'); ?> <a href="#"><?php the_author();?></a> <? _e('in', 'deltamain');?> <?= get_bloginfo('name'); ?> 
					
					<span class="controls">
	                    <a class="comments" href="#comments">
	<?php echo $commentcount = comments_number('0', '1', '%'); ?></a>
	                    <?php echo getPostLikeLink( get_current_blog_id(), get_the_ID() ); ?>
					</span>
	           </p>
			</header>
			
			<?php the_content(); ?>
		
		</section>
	</article>
	<section class="commentsContainer" id="comments">
		<div class="title"><?php $commentcount = comments_number('0', '1', '%');
			$fulltitle = ' (' . $commentcount . __(' comments)', 'deltamain');
			echo $fulltitle;
			?>
		</div>
							
		<?php //echo $post->ID;
		$args = array(
			'status' => 'approve',
			'number' => '5',
			'post_id' => $post->ID, // use post_id, not post_ID
		);
		$comments = get_comments($args);
		//print_r($comments);
		foreach($comments as $comment) :
		?>
		<div class="item clearfix">
			<div class="profile">
				<div class="image"><?php echo get_avatar( $comment->comment_author_email, 50 ); ?> <!--img alt="" src="<?php echo theme_url;?>/images/post/profilePhoto.jpg"--></div>
				<div class="author">
					<div class="name"><?php echo $comment->comment_author;?></div>
					<div class="title">Operations Manager</div>
				</div>
			</div>
			
			<div class="content">
				<div class="date"><?php echo $comment->comment_date;?>, <?php the_time('g:i a'); ?></div>
				<div class="comment"><?php echo  $comment->comment_content; ?></div>
			</div>
		</div>
		<?php endforeach; ?>						
							
		<div class="postComment clearfix">
			<? 
				if (strpos($_SERVER['SERVER_NAME'], 'kpd-i.com') !== false)
				{
					$prurl = '#';
				}
				else
				{
					$prurl = 'http://pr.den.deltahotels.com/den-resource/code-of-ethics/';
				}

			?>
			<?php $args = array(
			  'id_form'           => 'commentform',
			  'id_submit'         => 'submit',
			  'title_reply'       => sprintf(__( "<p><strong>Add your comment to the discussion</strong></p><p class='warning'>Before commenting, please refer to the <a href='%s' target='_blank'><strong>Delta Code of Ethics</strong></a>.  Always be respectful of your colleagues.</p>", 'deltamain'), $prurl),
			  'title_reply_to'    => __( 'Leave a Reply to %s' ),
			  'cancel_reply_link' => __( 'Cancel Reply' ),
			  'label_submit'      => __( 'Post' ),
			  'logged_in_as'      => ''
			);?>
			 <?php comment_form( $args, $post->ID ); ?> 
		</div>
	</section>		 
	<?php endwhile; ?>

	<?
		wp_reset_query();
		restore_current_blog();
	?>
</section>
<?php  
include 'partials/body/blog-sidebar.php'; 
?>

</section>
<?php

get_footer();
?>
