<section id="right-column">
<?php if(have_posts()):?>
    <section class="panel">
    <h3 class="header"><? _e('ABOUT THE AUTHOR', 'deltamain'); ?></h3>
    <div class="body">
    <? while(have_posts()):the_post();?>
    <div style="margin-bottom:5px;"><strong><? the_author();?></strong></div>
    <div style="margin-bottom:15px;font-size:13px;"><? the_author_meta('job_title');?></div>
    <? $id = get_the_author_meta('ID');
    echo get_avatar( $id, 100 ); 
    ?>
    <div style="margin-top:15px;font-size:13px;"><? the_author_meta('user_department');?></div>
    <div style="margin-top:5px;font-size:13px;"><a href="mailto:<? the_author_meta('user_email');?>"><? _e('Email', 'deltamain'); ?> <? the_author_meta('first_name');?></a><br /> <? the_author_meta('user_phone');?></div>
    </div>
    </section>
<? endwhile;endif;wp_reset_query();?>

<section class="panel">
        <h3 class="header"><? _e('MORE FROM', 'deltamain');?> <? the_author_meta('first_name', $authordata->ID);?></h3>
        <div class="body"><? echo the_related_author_posts();?></div>
    </section>
    <? //display_related_resources() ?>
    <? 
        query_posts('post_type=gallery');
        while(have_posts()):the_post();
        if(get_field('sidebar') == 'Right'):
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
