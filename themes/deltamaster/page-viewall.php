<?php 
/*
*Template Name:View All
*
*/
get_header();
?>

<link href="<?php echo get_template_directory_uri(); ?>/stylesheets/jplist-core.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo get_template_directory_uri(); ?>/js/jplist-core.min.js"></script>

<link href="<?php echo get_template_directory_uri(); ?>/stylesheets/jplist-pagination-bundle.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo get_template_directory_uri(); ?>/js/jplist.pagination-bundle.min.js"></script>

<!-- Textbox Control -->            
<link href="<?php echo get_template_directory_uri(); ?>/stylesheets/jplist-textbox-control.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo get_template_directory_uri(); ?>/js/jplist.textbox-control.min.js"></script>

<?php
global $post;
//global $paged;

//$permalink = get_permalink();
//include 'partials/body/left-column.php';

function getCatName($cat_id){
    $cat_names = array('1' =>'Unassigned', '2' => 'Departments' , '3' => 'Committees', '4' => 'Programs & Promotions' );
    if(isset($cat_names[$cat_id])){
        return $cat_names[$cat_id];
    }

    return false;
}
            


$args = array(
        'network_id' => $wpdb->siteid,
        'limit'      => $posts_per_page,
        'offset'     => $p_offset
    );

/*echo "<pre>";
print_r($args);
echo "</pre>";
*/


$sites = wp_get_sites();
$catFilter = $_GET['site_cat'];


?>
   <section class="view-all-content">
 
    	   <h1 style="margin-bottom: 20px;">Delta <?php echo getCatName($catFilter); ?></h1>

        <? if ($catFilter !== '2'): ?>
           <div class="list-panel">
               <div class="text-filter-box">

               <!-- <i class="fa fa-pencil jplist-icon"></i> -->
               <span>Find <?php echo getCatName($catFilter); ?>: </span>
                            
               <input 
                 data-path=".srch" 
                 type="text" 
                 value="" 
                 placeholder="Filter" 
                 data-control-type="textbox" 
                 data-control-name="srch-filter" 
                 data-control-action="filter"
               />
            </div>  
           </div>
       <? endif ?>
           <? if ($catFilter == '4'): ?>
            <div class="view-all-list table layout-fixed">
                <div>
                    <div>Program Name</div>
                    <div>Status</div>
                </div> 

            <? elseif ($catFilter == '3'): ?>
            <div class="view-all-list">
                <div>
                    <div>Committee Name</div>
                </div>       
            <? elseif ($catFilter == '2') :?>
            <div class="view-all-list">
                <div>
                    <div>Department Name</div>
                </div>   
            <? endif;?>
            <?php 

            /*
                1 - None
                2 - Department
                3 - Committees
                4 - Programs

            */

            function getCat($bid){
                $cats = array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 2,
                    '4' => 2,
                    '5' => 2,
                    '6' => 2,
                    '7' => 2,
                    '8' => 2,
                    '9' => 2,
                    '10' => 2,
                    '11' => 2,
                    '12' => 2,
                    '13' => 2,
                    '14' => 2,
                    '15' => 4,
                    '16' => 4,
                    '17' => 4,
                    '18' => 4,
                    '21' => 3,
                    '22' => 3,
                    '26' => 4
                );

                return $cats[$bid];

            }
      
            $num_sites = 0;//get_blog_count();


            $p_offset = 0;
            $posts_per_page = 10;
            $ppp = 0;
            

            if(!empty($paged))$p_offset = ($paged - 1) * $posts_per_page;  


            foreach ($sites as $site) {

                //update_blog_option($siteblog_id, 'site_cat', getCat($siteblog_id));
                $siteblog_id = $site['blog_id'];

                $cat_id = get_blog_option($siteblog_id, 'site_cat');
                $cat_name = getCatName($cat_id);
                $bname = get_blog_option($siteblog_id, 'blogname');
                $url = get_blog_option($siteblog_id,'siteurl');
                //$desc = extractExcerpt(get_blog_option($siteblog_id, 'blogdescription'));

                $isActive = get_blog_option($siteblog_id, 'public');
                $isArchive = get_blog_option($siteblog_id, 'archive');


                $status = "Active";

                if($isArchive == 1){
                    $status = "Archived";
                }

                if(!$cat_id){
                    //echo "\nOption Not Found Adding To Blog: ";
                    add_blog_option($siteblog_id, 'site_cat', getCat($siteblog_id));
                }
               

                if((isset($catFilter) && $catFilter == $cat_id) || !isset($catFilter)){
                    if($catFilter == '4'){
                   // $num_sites++;
                    //if($num_sites > $p_offset && $ppp < $posts_per_page){
                        echo "<div class='list-item'>";
                        echo "<div><a href='$url' class='srch'>$bname</a></div><div>$status</div>";
                        //echo "<div><a href='$url' class='srch'>$bname</a></div>";

                        echo "</div>";
                       // $ppp++;
                   // }
                    }else{
                        echo "<div class='list-item'>";
                        // echo "<div><a href='$url' class='srch'>$bname</a><p class='srch'>$desc</p></div><div>$status</div>";
                        echo "<div><a href='$url' class='srch'>$bname</a></div>";

                        echo "</div>";
                    }
                    

                   // echo "\nid: $siteblog_id\nName: $bname\nDomain:" . $site['domain'] . "\nCatagory:" . $cat_name . "\n";
                }
                
            }

            ?>
             
            </div>
      
            		
					<div class="list-panel">
                        <div class="jplist-pagination" data-control-type="pagination" data-control-name="paging" data-control-action="paging" data-items-per-page="10"></div>
                    </div>
            <?php 
               // $num_pages = ceil($num_sites / $posts_per_page);
               // delta_pagination($num_pages , $posts_per_page / 2); 
           ?>

  <?php  //include 'partials/body/right-column.php'; ?>
</section>
</section>
<script>
    (function ($, window, undefined) {
        $('document').ready(function(){

           //check all jPList javascript options
           $('.view-all-content').jplist({              
              itemsBox: '.view-all-list' 
              ,itemPath: '.list-item' 
              ,panelPath: '.list-panel'   
           });
           
        });


    })(jQuery, this); jQuery.noConflict();

    
</script>

<?php

get_footer();
?>
