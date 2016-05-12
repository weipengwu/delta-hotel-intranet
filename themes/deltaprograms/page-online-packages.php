<?php 
/*
*
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
            		<?php while(have_posts()):the_post() ?>
            		<h1><?php the_title(); ?></h1>
            		
            		<?php the_content(); ?>
            		<p class="posted">Last updated <?php the_date();?>. Last modified by <? the_modified_author(); ?>.</p>
			<?php endwhile; ?>
            		
            		<section class="panel white">
                        <h3 class="header">Online Packages (Web Offers)</h3>
						
						<div class="inner">
							<p>Submit a request to create a package or special for the web.</p>
							
							<p>Hotel Information</p>
							
							<p>Please select appropriable hotels</p>
							
							
							<select class="multiple" multiple size="6">
								<option selected>BAN</option>
								<option>BAR</option>
								<option>BEA</option>
								<option>BES</option>
								<option>BOW</option>
								<option>BRU</option>
							</select>

							<p>Package Information</p>
						</div>
                    </section>
     
					<!-- <p class="posted">Last updated Jul 28, 2014, 5:45 AM by <a href="#">A. Serwatuk</a></p> -->
                </section>
 <?php  include 'partials/body/right-column.php'; ?>
</section>

<?php

get_footer();
?>
