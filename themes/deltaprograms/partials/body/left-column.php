<section id="left-column">
    <div class="sub-blog-title"><a href="/"><?= get_bloginfo('name'); ?></a></div>
    <nav class="collapsingNav" id="leftNav">
    	<? query_posts('post_type=page&showposts=12&orderby=menu_order&order=ASC&post_status=publish'); ?>
    	<ul class="departmentlist">
    	<? while(have_posts()): ?>
            <? the_post() ?>
            <li class="page_item page-item-18"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
        <? endwhile; ?>
    	</ul>
		
    </nav>
    
    <? display_top_activities(12); ?>

    <? display_popular_resources(12); ?>
    
    <? wp_reset_query(); ?>
<? query_posts('post_type=den-resource&showposts=12'); ?>
    <?php if(have_posts()):?>
    <section class="panel">
        <div class="sub-blog-title">Resources</div>            
        
        <? sc_delta_tree_menu(); ?>
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
    <? if(count($attachment_ids)>1):?>
        <nav>
            <a class="prev" href="#">prev</a>
            <a class="next" href="#">next</a>
        </nav>
    <? endif;?>
    </section>
    <?php endif;endwhile;?>
    <? wp_reset_query();//end wp loop?>
</section>
