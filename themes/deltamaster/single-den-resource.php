<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 * Template Name: Den Resources
 */

get_header();

get_override_template('partials/body/left-column.php');
?>
	<section id="middle-column">
		<header>
			<?php while(have_posts()): the_post() ?>
				<h1><?php the_title(); ?></h1>
			
				<?php the_content(); ?>
				
				<? sc_delta_child_menu(get_the_ID()); ?>
				
			<?php endwhile; ?>
		</header>
	</section>


	<?php  include 'partials/body/right-column.php'; ?>
</section>

<?php

get_footer();
?>
