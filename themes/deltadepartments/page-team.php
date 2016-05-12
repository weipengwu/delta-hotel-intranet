<?php 
/*
* Template Name:Team
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
                    <header><?php while(have_posts()): the_post() ?>
                        <h1><?php the_title(); ?></h1>
                        
                        <?php the_content(); ?>
                        <p class="posted">Last updated <?php the_date();?>. Last modified by <? the_modified_author(); ?>.</p>

            <?php endwhile; ?>

                        <!--p><a href="http://marketing.deltaden.kpd-i.com/team/">Our Team</a> to contact the appropriate Marketing team member.</p-->
                    </header>
                </section>


  <?php  include 'partials/body/right-column.php'; ?>
</section>

<?php

get_footer();
?>
