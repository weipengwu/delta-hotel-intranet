<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 *
 */
get_header();
?>
<?php
global $post;
$permalink = get_permalink();

if(is_front_page() || strstr($permalink ,"help"))
{
}
else
{
?>
<nav id="breadcrumb">
					<ul class="clearfix">
						<li><a href="http://deltaden.kpd-i.com">DEN Home</a></li>
						
<li><a href="#"><?php the_title(); ?></a></li>
					</ul>
				</nav>
<?php
	}

    include 'partials/body/left-column.php';
?>
    <section id="middle-column">
<?php while(have_posts()): the_post() ?>
<article class="post">
                	
	                	
						
						<section class="banner">
							<div class="title"><?php the_title(); ?></div>
							<p>You have the power to excel and grow in an inclusive community where people care about the difference they make!</p>
						</section>
						
						<section>
							<header>
							<p class="date group">
									Posted <?php the_date();?> by <a href="#"><?php the_author();?></a> in <?= get_bloginfo('name'); ?> 
									
									<span class="controls">
					                    <a class="comments" href="#comments">
				<?php echo $commentcount = comments_number('0', '1', '%'); ?></a>
					                    <a class="likes">2</a>
									</span>
				               </p>
							</header>
							
							<?php the_content(); ?>
							
							<div class="image"><img alt="" src="<?php echo theme_url; ?>/images/post/image_large.jpg"></div>
						
							<p>Be sure to visit the Valuing Healthy Minds site regularly for more information and access to resources. New resources include a link to the Mental Health Commission of Canada, an organization committed to improving the mental health system and changing the attitudes and behaviours of Canadians around mental health issues. The commission’s work includes the country’s first mental health strategy. Find out more at https://sites.google.com/a/ deltahotels.com/valuing-healthy-minds/.</p>
						
							<div class="tags">
								<div class="title">Tags</div>
								
								<?php the_tags('<ul><li>','</li><li>','</li></ul>');?>
							</div>
						</section>
					</article>

<section class="commentsContainer" id="comments">
						<div class="title"><?php $commentcount = comments_number('0', '1', '%');
						$fulltitle = ' (' . $commentcount . ' comments)';
						echo $fulltitle;
						?></div>
						
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
								<div class="image"><img alt="" src="<?php echo theme_url;?>/images/post/profilePhoto.jpg"></div>
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
							<?php $args = array(
							  'id_form'           => 'commentform',
							  'id_submit'         => 'submit',
							  'title_reply'       => __( '<p><strong>Add your comment to the discussion</strong></p><p>Before commenting, please refer to the <a href=""><strong>Delta Code of Ethics</strong></a>.  Always be respectful of your colleagues.</p>' ),
							  'title_reply_to'    => __( 'Leave a Reply to %s' ),
							  'cancel_reply_link' => __( 'Cancel Reply' ),
							  'label_submit'      => __( 'Post' ),
							  'logged_in_as'      => ''

);?>
							 <?php comment_form( $args, $post->ID ); ?>  
						</div>
					</section>
			 
			<?php endwhile; ?>

						<!--p><a href="http://marketing.deltaden.kpd-i.com/team/">Our Team</a> to contact the appropriate Marketing team member.</p-->
                	</header>
                </section>


  <?php  include 'partials/body/blog-sidebar.php'; ?>
</section>

<?php

get_footer();
?>
