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
						<!--li><a href="#">Departments</a></li-->
						<!--li><a href="http://marketing.deltaden.kpd-i.com">Marketing</a></li-->
<li><a href="#"><?php the_title(); ?></a></li>
					</ul>
				</nav>
<?php
	}

    include 'partials/body/left-column.php';
?>
    <section id="middle-column">
                	<header><?php while(have_posts()): the_post() ?>
                		<h1><?php the_title(); ?></h1>
                		
                		<?php $content = do_shortcode( get_the_content() ); echo wpautop($content);?>
                		<p class="posted">Last updated <?php the_date();?>. Last modified by <? the_modified_author(); ?>.</p>
			<?php endwhile; ?>

						<!--p><a href="http://marketing.deltaden.kpd-i.com/team/">Our Team</a> to contact the appropriate Marketing team member.</p-->
                	</header>
                </section>


  <?php  include 'partials/body/right-column.php'; ?>
</section>

<?php

get_footer();
?>
