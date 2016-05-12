
					
					
						
															
						<div class="alert-box warning" data-alert="" style='display:none'>
							<?php query_posts('post_type=alerts&showposts=1');
							while(have_posts()):the_post()?>
							<?php the_title(); ?> <a class="download" href="<?php echo get_post_meta($post->ID,'_alertlinks',true); ?>" rel="<?php the_ID(); ?>">download</a>
							
							<?php
							endwhile;
							wp_reset_query();
							
							?>
							
							<a class="close" href="#"  id="Alertclose"></a>
						</div>
							
						
					
					
<?php
if(!is_front_page())
{
?>
<nav id="breadcrumb">
					<ul class="clearfix">
						<li><a href="http://deltaden.kpd-i.com">DEN Home</a></li>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					</ul>
				</nav>
<?php
	}

    include 'body/left-column.php';
    include 'body/middle-column.php';
    include 'body/right-column.php';
?>
</section>
