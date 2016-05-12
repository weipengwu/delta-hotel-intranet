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

if(is_front_page() || strstr($permalink ,"help"))
{
}
else
{
?>
<nav id="breadcrumb">
					<ul class="clearfix">
						<li><a href="http://deltaden.kpd-i.com">DEN Home</a></li>
						<li><a href="#">Departments</a></li>
						<li><a href="http://marketing.deltaden.kpd-i.com">Finance</a></li>
<li><a href="#"><?php the_title(); ?></a></li>
					</ul>
				</nav>
<?php
	}

include 'partials/body/left-column.php';
?>
 <section id="middle-column">
            		<h1>Online Packages</h1>
            		
            		<p>Here is where some text can go.</p>
            		
            		<div class="row">
            			<div class="large-9 columns">
		            		<div class="row">
		            			<div class="large-6 columns">
		            				<img src="<?php echo theme_url();?>/images/fpo/onlinePackages_image.png" alt="" width="230" height="131" />
		            			</div>
		            			
		            			<div class="large-6 columns">
		            				<p>Lorem ipsum dolor sit amet, consectueturer adipiscing elit.  Nulla tincidunt diam eu mauris.  Mauris vehicula mollis lacus.</p>
		            			</div>
		            		</div>
            			</div>
            		</div>
            		
            		<div class="fileDownload clearfix">
            			<div class="item">
            				<div class="icon"><img src="<?php echo theme_url();?>/images/fpo/onlinePackages_icon.png" alt="" width="12" height="16" /></div>
            				<div class="name"><a href="#">File Name</a> (12k)</div>
            				<div class="details">User Name [DHC], Aug 06, 2014, 9:05 AM</div>
            				<div class="link"><a href="#"></a></div>
            			</div>
            			<div class="item">
            				<div class="icon"><img src="<?php echo theme_url();?>/images/fpo/onlinePackages_icon.png" alt="" width="12" height="16" /></div>
            				<div class="name"><a href="#">File Name</a> (12k)</div>
            				<div class="details">User Name [DHC], Aug 06, 2014, 9:05 AM</div>
            				<div class="link"><a href="#"></a></div>
            			</div>
            			<div class="item">
            				<div class="icon"><img src="<?php echo theme_url();?>/images/fpo/onlinePackages_icon.png" alt="" width="12" height="16" /></div>
            				<div class="name"><a href="#">File Name</a> (12k)</div>
            				<div class="details">User Name [DHC], Aug 06, 2014, 9:05 AM</div>
            				<div class="link"><a href="#"></a></div>
            			</div>
            			<div class="item">
            				<div class="icon"><img src="<?php echo theme_url();?>/images/fpo/onlinePackages_icon.png" alt="" width="12" height="16" /></div>
            				<div class="name"><a href="#">File Name</a> (12k)</div>
            				<div class="details">User Name [DHC], Aug 06, 2014, 9:05 AM</div>
            				<div class="link"><a href="#"></a></div>
            			</div>
            			
            			<div class="subFolder closed"><a href="#">Sub Folder</a></div>
            			
            			<div class="subFolder open"><a href="#">Open Sub Folder</a></div>
            			
            			<div class="item">
            				<div class="icon"><img src="<?php echo theme_url();?>/images/fpo/onlinePackages_icon.png" alt="" width="12" height="16" /></div>
            				<div class="name"><a href="#">File Name</a> (12k)</div>
            				<div class="details">User Name [DHC], Aug 06, 2014, 9:05 AM</div>
            				<div class="link"><a href="#"></a></div>
            			</div>
            			<div class="item">
            				<div class="icon"><img src="<?php echo theme_url();?>/images/fpo/onlinePackages_icon.png" alt="" width="12" height="16" /></div>
            				<div class="name"><a href="#">File Name</a> (12k)</div>
            				<div class="details">User Name [DHC], Aug 06, 2014, 9:05 AM</div>
            				<div class="link"><a href="#"></a></div>
            			</div>
            		</div>
            		
            		<!-- <p class="updated">Last updated Jul 28, 2014, 5:45 AM by <a href="#">A. Serwatuk</a></p> -->
                </section>
 <?php  include 'partials/body/right-column.php'; ?>
</section>
<?php

get_footer();
?>
