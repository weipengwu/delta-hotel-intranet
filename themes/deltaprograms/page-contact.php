<?php 
/*
*Template Name:Contact
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
			<?php endwhile; ?>
            		
					<section class="headlines">
                        <div class="feeds clearfix">
                        
                        	<h3>Emergency Contact Details</h3>
                        	
                            <div class="feed row">
                                <div class="columns large-3"><img src="<?php echo theme_url; ?>/images/fpo/department_team.jpg" alt=""></div>

                                <div class="columns large-9">
                                    <h4>Jon Smith</h4>

                                    <p class="title">Job Title</p>
                                    <p class="phone">Phone: (416) 123-4567</p>
                                    <p class="email">Email: <a href="#">contact@detlahotels.com</a></p>
                                </div>
                            </div>
                        </div>
                        
                        <section class="form">
                        	<h3>Contact Inquiry</h3>
                        	
                        	<form method="post">
                        		<div class="item">
                        			<label for="input_name">Name:</label>
                        			<input type="text" id="input_name">
                        		</div>
                        		
                        		<div class="item">
                        			<label for="input_email">Email:</label>
                        			<input type="text" id="input_email">
                        		</div>
                        		
                        		<div class="item">
                        			<label for="input_subject">Subject:</label>
                        			<input type="text" id="input_subject">
                        		</div>
                        		
                        		<div class="item">
                        			<label for="input_details">Details:</label>
                        			<textarea id="input_details"></textarea>
                        		</div>
                        		
                        		<div class="item cta">
                        			<a href="#" class="button">Submit</a>
                        		</div>
                        	</form>
                        </section>
                        
                        <!-- <p class="posted">Last updated Jul 28, 2014, 5:45 AM by <a href="#">A. Serwatuk</a></p> -->
                    </section>
                </section>
 <?php  include 'partials/body/right-column.php'; ?>
</section>

<?php
get_footer();
?>
