<?php 
/*
*Template Name:Contact
*
*/
if($_POST){

    $message = 'Name: '.$_POST['input_name']."\n";
    $message .= 'Email: '.$_POST['input_email']."\n";
    $message .= 'Subject: '.$_POST['input_subject']."\n";
    $message .= 'Details: '.$_POST['input_details']."\n";

    $headers = array();
    $headers[] = 'From: DEN <noreply@deltahotels.com>';
    
    if (!$destination = get_field('form_submission'))
    {
        switch (get_current_blog_id()) {
            case '2':
                wp_mail('it.inquiry.grp@deltahotels.com', get_bloginfo('name') . ' Contact Inquiry', $message, $headers);
                break;
            
            case '3':
                wp_mail('marketing.inquiry.grp@deltahotels.com', get_bloginfo('name') . ' Contact Inquiry', $message, $headers);
                break;

            case '4':
                wp_mail('ops.inquiry.grp@deltahotels.com', get_bloginfo('name') . ' Contact Inquiry', $message, $headers);
                break;

            case '5':
                wp_mail('legal.inquiry.grp@deltahotels.com', get_bloginfo('name') . ' Contact Inquiry', $message, $headers);
                break;

            case '6':
                wp_mail('corporate.inquiry.grp@deltahotels.com', get_bloginfo('name') . ' Contact Inquiry', $message, $headers);
                break;

            case '7':
                wp_mail('sales.inquiry.grp@deltahotels.com', get_bloginfo('name') . ' Contact Inquiry', $message, $headers);
                break;

            case '8':
                wp_mail('asset.inquiry.grp@deltahotels.com', get_bloginfo('name') . ' Contact Inquiry', $message, $headers);
                break;

            case '9':
                wp_mail('dc.inquiry.grp@deltahotels.com', get_bloginfo('name') . ' Contact Inquiry', $message, $headers);
                break;

            case '10':
                wp_mail('finance.inquiry.grp@deltahotels.com', get_bloginfo('name') . ' Contact Inquiry', $message, $headers);
                break;

            case '11':
                wp_mail('revenue.inquiry.grp@deltahotels.com', get_bloginfo('name') . ' Contact Inquiry', $message, $headers);
                break;

            case '13':
                wp_mail('grs.inquiry.grp@deltahotels.com', get_bloginfo('name') . ' Contact Inquiry', $message, $headers);
                break;

            case '14':
                wp_mail('pr.inquiry.grp@deltahotels.com', get_bloginfo('name') . ' Contact Inquiry', $message, $headers);
                break;
        }
    }
    else
    {
        wp_mail($destination, get_bloginfo('name') . ' Contact Inquiry', $message, $headers);
    }

    //wp_mail('it.inquiry@deltahotels.com,', 'Feedback', $message);

}
get_header();




include 'partials/body/left-column.php';
?>
<section id="middle-column">
			<?php while(have_posts()):the_post() ?>
            		<h1><?php the_title(); ?></h1>
            		
					<section class="headlines">
                        <div class="feeds clearfix">
                        
                        	<h3>Department Contact Details</h3>
                        	
                            <div class="feed row">
                                <div class="columns large-3">
                                    <?php if(get_field('contact_profile')):?>

                                        <img src="<?php the_field('contact_profile'); ?>" alt="">
                                    <? else:?>
                                        <img src="<?php echo theme_url; ?>/images/fpo/department_team.jpg" alt="">
                                    <? endif;?>
                                </div>

                                <div class="columns large-9">
                                    <h4><?php the_field('contact_name'); ?></h4>

                                    <p class="title"><?php the_field('contact_job_title'); ?></p>
                                    <p class="phone">Phone: <?php the_field('contact_phone'); ?></p>
                                    <p class="email">Email: <a href="mailto:<?php the_field('contact_email'); ?>"><?php the_field('contact_email'); ?></a></p>
                                </div>
                            </div>
                        </div>
                  <?php endwhile; ?>      
                        <section class="form">
                        	<h3>Contact Inquiry</h3>
                        	
                        	<form id="contact-form" method="post" action="">
                        		<div class="item">
                        			<label for="input_name">Name:</label>
                        			<input type="text" id="input_name" name="input_name">
                        		</div>
                        		
                        		<div class="item">
                        			<label for="input_email">Email:</label>
                        			<input type="text" id="input_email" name="input_email">
                        		</div>
                        		
                        		<div class="item">
                        			<label for="input_subject">Subject:</label>
                        			<input type="text" id="input_subject" name="input_subject">
                        		</div>
                        		
                        		<div class="item">
                        			<label for="input_details">Details:</label>
                        			<textarea id="input_details" name="input_details"></textarea>
                        		</div>
                        		
                        		<div class="item cta">
                        			<input class="button submit" type="submit" value="Submit">
                        		</div>
                        	</form>
                        </section>
                        
                    </section>
                </section>
 <?php  include 'partials/body/right-column.php'; ?>
</section>
<script type="text/javascript">
    jQuery('.button.submit').on('click', function(e){
        e.preventDefault();
        if(jQuery('input[name="input_name"]').val() == ""){
            jQuery('input[name="input_name"]').css('border', '1px solid red');
            jQuery('input[name="input_name"]').addClass('error');
        }else{
            jQuery('input[name="input_name"]').css('border', '0');
            jQuery('input[name="input_name"]').removeClass('error');
        }
        if(jQuery('input[name="input_email"]').val() == ""){
            jQuery('input[name="input_email"]').css('border', '1px solid red');
            jQuery('input[name="input_email"]').addClass('error');
        }else{
            jQuery('input[name="input_email"]').css('border', '0');
            jQuery('input[name="input_email"]').removeClass('error');
        }
        if(jQuery('input[name="input_subject"]').val() == ""){
            jQuery('input[name="input_subject"]').css('border', '1px solid red');
            jQuery('input[name="input_subject"]').addClass('error');
        }else{
            jQuery('input[name="input_subject"]').css('border', '0');
            jQuery('input[name="input_subject"]').removeClass('error');
        }
        if(jQuery('textarea').val() == ""){
            jQuery('textarea').css('border', '1px solid red');
            jQuery('textarea').addClass('error');
        }else{
            jQuery('textarea').css('border', '0');
            jQuery('textarea').removeClass('error');
        }
        if(jQuery('#contact-form .error').length == 0){
            jQuery('#contact-form').submit();
        }
    })

</script>
<?php
get_footer();
?>
