<?php 
/*
*Template Name:News
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

<?php
    }

    include 'partials/body/left-column.php';
?>
   <section id="middle-column">
                    <h1><? the_title();?></h1>
                    <?
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => '10',
                        'paged' => $paged
                        );  

                         $loop = new WP_Query(array($args));?>

                    
                    <section class="panel headlines">

                        <div class=" feeds clearfix">
                        <?php while($loop->have_posts()): $loop->the_post();?>
                            <div class="feed row">
                                <div class="columns large-3"><? if ( has_post_thumbnail() ) {the_post_thumbnail();}?></div>

                                <div class="columns large-6">
                                    <h4><a href="<? the_permalink();?>"><? the_title();?></a></h4>

                                    <p><? the_excerpt();?></p><small>Posted <?php the_date();?> by <?php the_author();?> in <?= get_bloginfo('name'); ?> </small>
                                </div>

                                <div class="columns large-3">
                                    <a class="comments"><?php comments_number( '0', '1', '%' ); ?> </a>
                                    <?php echo getPostLikeLink( get_the_ID() );?>
                                </div>
                            </div>
                        <?php endwhile;?>

                        </div>
                        
                        <div class="pagination">
                   <?php
            global $wp_query;

            $big = 999999999; // need an unlikely integer

            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'prev_text'    => __('&lt; Previous'),
                'next_text'    => __('Next &gt;'),
                'total' => $query->max_num_pages
            ) );
        ?>
                        </div>
                    </section>
                </section>


  <?php  include 'partials/body/right-column.php'; ?>
</section>

<?php

get_footer();
?>

