<?php
/**
 * The template for displaying 404 page
 *
 *
 */

get_header('no-breadcrumb');
?>

<section id="left-column">&nbsp;</section>
    <section id="middle-column">
         <h1><? _e("Sorry, this isn't the page you're looking for...","deltamain");?></h1>  
         <p><? _e("This page you are trying to access either can't be found or is not accessible.","deltamain");?></p>
         <p><? _e('You can:','deltamain');?></p>
         <ul>
         	<li><a href="<?php echo  home_url();?>"><? _e('Return Home','deltamain');?></a></li>
         	<li><? _e('Try searching for the page (it may have been moved)','deltamain');?></li>
         	<li><? _e('Report this as an error to the DEN Administrator','deltamain');?></li>
         </ul>
    </section>
<section id="right-column">&nbsp;</section>
<div style="height:200px;clear:both"></div>
</section>

<?php

get_footer();
?>