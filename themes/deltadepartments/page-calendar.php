<?php 
/*
 *Template Name: Calendar
 *
 */
get_header();
?>
<?php

include 'partials/body/left-column.php';



?>
    <section id="middle-column">
    	<? $calendar_url = get_post_meta($post->ID, 'calendar_url', true); ?>
        <iframe src="https://www.google.com/calendar/embed?src=<?= $calendar_url ?>&ctz=America/Toronto" width="910" height="700" frameborder="0" scrolling="no"></iframe>
				    	
    </section>
</section>

<?php

get_footer();
?>
