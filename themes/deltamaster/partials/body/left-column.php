<section id="left-column">
    <? query_posts('post_type=activity&showposts=12'); ?>
    <?php if(have_posts()):?>
    <section class="list-panel top-activities">
        <h3 class="header"><?php _e('Top Activities','deltamain'); ?></h3>
        <ul>
            <? while(have_posts()): ?>
                <? the_post() ?>
                <li><a href="<?php the_field('activity_link'); ?>"><?php the_title(); ?></a></li>
            <? endwhile; ?>
            
        </ul>
    </section>
    <? endif; ?>
    <? wp_reset_query(); ?>
    <? query_posts('post_type=popular&showposts=12'); ?>
    <?php if(have_posts()):?>
    <section class="list-panel events">
        <h3 class="header"><?php _e('Popular Resources','deltamain'); ?></h3>            
        <ul>
            
            <? while(have_posts()): ?>
                <? the_post() ?>
                <li><a href="<?php the_field('resource_link'); ?>"><?php the_title(); ?></a></li>
            <? endwhile; ?>

            
        </ul>
    </section>
<? endif; ?>
<? wp_reset_query(); ?>
<? 
        query_posts('post_type=gallery');
        while(have_posts()):the_post();
        if(get_field('sidebar') == 'Left'):
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
            <li><img src="<?php echo $image[0];?>" alt="left sidebar banner"/></li>
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
