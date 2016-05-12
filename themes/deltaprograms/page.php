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


    include 'partials/body/left-column.php';
?>
    <section id="middle-column">
                	<header><?php while(have_posts()): the_post() ?>
                		<h1><?php the_title(); ?></h1>
                		
                		<?php the_content(); ?>

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
