<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 * Template Name: search
 */

get_header('no-breadcrumb');
?>
<nav id="breadcrumb">
	<ul class="clearfix">
		<li><a href="<?php bloginfo('url');?>">&lt; <? _e('Back to Home', 'deltamain');?></a></li>
	</ul>
</nav>
            
<section id="full-column" class="search">
	<? $sites = wp_get_sites(); ?>

	<?

		$site_data = array();
		$union_args = array();
		foreach ($sites as $site)
		{
			$site_data[$site['blog_id']] = get_blog_details($site['blog_id']);

			if ($site['blog_id'] == 1)
				$table = 'wp_posts';
			else
				$table = 'wp_' . $site['blog_id'] . '_posts';

			$union_args[] = "SELECT " . $site['blog_id'] . " as site_id, wp_users.user_nicename, ".$table.".post_title, ".$table.".post_content, ".$table.".post_date, ".$table.".post_author, ".$table.".ID as post_id FROM ".$table." INNER JOIN wp_users ON wp_users.ID = ".$table.".post_author WHERE (".$table.".post_content like '%" . $_GET['mssearch'] . "%' OR ".$table.".post_title like '%" . $_GET['mssearch'] . "%' OR wp_users.user_nicename like '%" . $_GET['mssearch'] . "%') and ".$table.".post_status = 'publish' AND (".$table.".post_type = 'den-resource' OR ".$table.".post_type = 'post' OR ".$table.".post_type = 'page')";


		}
		// god forgive me
		$sql = implode(' UNION ', $union_args);

		global $wpdb;

		$data = $wpdb->get_results($sql);	
	?>
					
	<header id="pageHeader">
	
		<h1><? _e('Search Results for','deltamain');?> "<?= $_GET['mssearch'] ?>" <? if($_GET['blog'] != "All" && isset($_GET['blog'])){echo '[in '.$_GET['blog'].']</h1>';} else{echo "</h1>";}?>
		<?php global $wp_query;  $ser=$_GET['mssearch'];
$count = count($data); ?>
                                <p class="match" style="display: none;"><span class="countsearch"></span> <?php if($count==1){echo 'Match';}else {echo __('Matches','deltamain');}?></p>
	</header>
					
					<section class="panel search">
					<div class="tabs">
						<header>
							<ul>
								<li class='tab'><a href="#intranet-pages" id="tab1"><? _e('Intranet Pages','deltamain');?></a></li>
								<li class='tab first'><a href="#files" id="tab2"><? _e('Files','deltamain');?></a></li>
								<!-- <li class='tab sec'><a href="#events" id="tab3"><? _e('Events','deltamain');?></a></li> -->
							</ul>
							<div class="quickLinks">
								<a href="https://drive.google.com/" style="display: none;" class="first" target="_blank"> <? _e('QUICK LINKS','deltamain');?> &gt; Go to Google Drive</a>
								<a href="https://www.google.com/calendar" style="display: none;" class="sec" target="_blank"> <? _e('QUICK LINKS','deltamain');?> &gt; Go to Google Calendar</a>
							</div>
						</header>
	
	 <div class="container clearfix" style="padding:0px!important">
	<!-- .content starts -->
		
		<div class="content" id="intranet-pages" style="padding: 25px 25px;"> 
		<!-- .container starts -->
		<!-- <div class="container clearfix" style="padding:0px!important">-->

		<?php if ($count == 0): ?>
			<div class="row">
				<div class="large-6">
					<? _e('Your search returned no results.','deltamain');?>
				</div>

			</div>
		<?php else: ?>
	
			<? foreach ($data as $result): ?>


				<?

				switch_to_blog($result->site_id);


				if (!DenUser::is_member($result->site_id) && get_post_meta($result->post_id, '_member_post', true) == 'members' || get_post($result->post_id)->post_name == 'globalsearch')
					continue;

				$excerpt = preg_replace('/\[(.*)\]/', '', strip_tags($result->post_content));
				$ThemeExcerpt=substr($excerpt,0,150);

				$link = get_permalink($result->post_id);

				?>

				<div class="row">
					<div class="large-6">
						<div class="title"><a href="<?php echo $link; ?>"><?php echo $result->post_title ?></a></div>
						<div class="date"><? _e('Posted', 'deltamain');?> <?php echo date('F j, Y, g:i A', strtotime($result->post_date)) ?> <? _e('by', 'deltamain'); ?> <a href="#"><?php echo $result->user_nicename; ?></a> <? _e('in', 'deltamain'); ?> <a href="<? echo $site_data[$result->site_id]->siteurl ?>"><? echo $site_data[$result->site_id]->blogname ?></a></div>
						<p><?php echo $ThemeExcerpt; ?></p>
					</div>
				</div>

			<? endforeach; ?>
   
                  <?php endif;?>         
                       
		
			
		</div> 
		<!-- .content ends -->
		<!-- .content starts -->
		
		<div class="content" id="files" style="padding: 25px 25px;"> 
		<!-- .row starts -->
		
                            
                            <div class="pagination">
                        	
                        </div>
                            <!--end-->
		</div> <!-- .content ends -->
		<!-- .content starts -->
		<div class="content" id="events" style="display: none; padding-top:0; padding-right:0; padding-bottom:0;">
<!--starts-->
			<div class="row" id="event">
                            	<div id="event_holder" class="large-9 columns">
                            		
		                            
		                         
                            	</div>
                            	<div id="large3">
	                            <div class="large-3 columns">
	                            	<section class="panel events">
				                        <h3 class="header"><? _e('Upcoming Events','deltamain');?></h3>
				
				                        <div id="right-event-holder"></div>
				                    </section>
	                            </div>
	                            </div><!--#large3  -->
           </div><!-- row  -->
                            
                           
                            
	                            
                            

		<!--ends--> 
		</div> <!-- .content ends -->
			

			
		</div><!-- #content -->
		</div><!-- #tab-container ends-->
		 <!--div class="pagination"><?php //delta_pagination(); ?>
                        	<!--ul>
                        		<li><a href="#" class="first">&lt;&lt;</a></li>
                        		<li><a href="#" class="back">&lt;</a></li>
                        		
                        		<li><a href="#">1</a></li>
                        		<li><a href="#">2</a></li>
                        		<li><a href="#">3</a></li>
                        		<li><a href="#">4</a></li>
                        		<li><a href="#">5</a></li>
                        		<li><a href="#">6</a></li>
                        		<li><a href="#">7</a></li>
                        		<li><a href="#">8</a></li>
                        		<li><a href="#">9</a></li>
                        		
                        		<li><a href="#" class="next">&gt;</a></li>
                        		<li><a href="#" class="last">&gt;&gt;</a></li>
                        	</ul>
                        </div-->
	</section><!-- #primary -->
	</section><!-- #search -->
</section>
<script>

	
	
	var current_file_page = 0;

	jQuery(document).ready(function() { 

		var self = this;

		// var current_search_query = gdmDriveMgr.current_search_query;
		var params = {maxResults: 8};
		// if (thisPageToken) {
		//         params.pageToken = thisPageToken;
		// }
        
        params.q = "title contains '<?= $_REQUEST['mssearch']?>'";

		var data = {
	        'action': 'list_files',
	        'gparams': JSON.stringify(params),
	        'q': params.q,
	        'das': true,
	        'maxResults': 8
		};


		var t_c = 0;
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        jQuery.getJSON('/wp-admin/admin-ajax.php', data, function(resp) {

        	if(resp.length > 0){


        		jQuery.each(resp, function(i, v) { 

	        		modified_args = Site.date.parse_google_time(v.modifiedDate);

	        		row_data = '<div class="row driveresult">';
	        		row_data += '<div class="large-1 columns">';
	        		row_data += '<img src="'+ v.iconLink + '">';
	        		row_data += '</div>';
	        		row_data += '<div class="large-6 columns">';
	        		row_data += '<div class="title"><a target="_blank" href="'+ v.alternateLink+'">' + v.title + '</a></div>';
					row_data += '<div class="date">Posted by '+ v.lastModifyingUserName+ '</a></div>';
					row_data += '</div>';
					row_data += '<div class="large-3 columns textRight">';
					row_data += modified_args['day_of_week_string'] + ' ' +modified_args['month_string'] + " " + modified_args['day'] + ", " + modified_args['year'];
					row_data += '</div>';
					row_data += '</div>';

					jQuery('#files').prepend(row_data);
				});

        		page_html = '<a href="#fileprev">Prev</a> ';

        		for (n = 0; n < Math.ceil(jQuery('.row.driveresult').length / 10) - 1; n++)
        		{
        			page_html += '<a style="display: inline-block; margin: 0px 3px;" href="#filepage' + n + '">' + (n + 1) + '</a>';
        		}

        		page_html += '<a href="#filenext">Next</a> ';


        		jQuery('#files .pagination').html(page_html);

        		jQuery('.row.driveresult').hide();
        		jQuery('.row.driveresult').slice(current_file_page, current_file_page + 10).show();

        		jQuery('#files .pagination a').bind('click', function() { 

        			if (jQuery(this).attr('href').replace('#', '') == 'fileprev')
        			{
        				if (current_file_page == 0)
        					return;

        				current_file_page--;	
        			}
        			else if (jQuery(this).attr('href').replace('#', '') == 'filenext')
        			{
        				if (jQuery('.row.driveresult').slice((current_file_page + 1) * 10, (current_file_page + 1) * 10 + 10).length == 0)
        					return;

        				current_file_page++;	
        			}
        			else
        			{
        				current_file_page = parseInt(jQuery(this).attr('href').replace('#filepage', ''), 10) + 1;

        			}

        			jQuery('.row.driveresult').hide();
    				jQuery('.row.driveresult').slice(current_file_page * 10, current_file_page * 10 + 10).show();

        		});

        		jQuery('.countsearch').html(jQuery('#intranet-pages .row').length + jQuery('.driveresult').length);
        		jQuery('.countsearch').parent().show();

			}else{
				row_data = "<div><? _e('Your search returned no results.','deltamain');?></div>";
				jQuery('#files').prepend(row_data);
			}

        	

        });

        params.q = "<?= $_REQUEST['mssearch']?>";
        params.orderBy = "startTime";
		params.singleEvents = true;

		var data = {
	        'action': 'list_files',
	        'gparams': JSON.stringify(params),
	        'docalendar': 1
		};



        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
   //      jQuery.getJSON('/wp-admin/admin-ajax.php', data, function(resp) {

   //      	if(resp.length > 0){

   //      		jQuery.each(resp, function(i, v) { 
   //      		//console.log(v.summary);
	  //       		 console.log(v.start_date);
	  //       		start_date = Site.date.parse_google_time(v.start_date);
	  //       		end_date = Site.date.parse_google_time(v.end_date);

	        		

	  //       		row_data = '<div class="row">';
	  //       		row_data += '<div class="large-2 columns">';
	  //       		row_data += start_date['day_of_week_string'] + ' ' +start_date['month_string'] + " " + start_date['day'] + ", " + start_date['year'];
	  //       		row_data += '</div>';
	  //       		row_data += '<div class="large-2 columns" style="width: 20%;">';
	  //       		row_data += start_date['hour'] + ":" + (start_date['minute'] < 10 ? start_date['minute'] : start_date['minute']) + start_date['meridian'] + ' - ' + end_date['hour'] + ":" + (end_date['minute'] < 10 ? end_date['minute'] : end_date['minute']) + end_date['meridian']
	  //       		row_data += '</div>';
	  //       		row_data += '<div class="large-5 columns">';
	  //       		row_data += '<a href="#">'+v.summary+ '</a>';
	  //       		row_data += '</div>';
	  //       		row_data += '<div class="large-2 columns">';
	  //       		row_data += (v.location ? v.location : '');
			// 		row_data += '</div>';
			// 		row_data += '</div>';

			// 		jQuery('#event_holder').append(row_data);

	  //       	});
			// }else{
			// 	row_data = "<div style='font-size: 1.5em;'><? _e('Your search returned no results.','deltamain');?></div>";
			// 	jQuery('#event_holder').prepend(row_data);
			// }

   //      });


        var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd='0'+dd
} 

if(mm<10) {
    mm='0'+mm
} 

today = yyyy+'-'+mm+'-'+dd+'T00:00:00-05:00';
console.log(today);
var params = {maxResults: 1};
params.orderBy = "startTime";
params.timeMin = today;
params.singleEvents = true;
        var data = {
            'action': 'list_files',
            'gparams': JSON.stringify(params),
            'docalendar': 1
        };

jQuery.getJSON('/wp-admin/admin-ajax.php', data, function(resp) {

        if(resp.length > 0){
            var j = 0;
            jQuery.each(resp, function(i, v) { 
                if(j>2){
                    return false;
                }
                start_date = Site.date.parse_google_time(v.start_date);
                end_date = Site.date.parse_google_time(v.end_date);

                

                row_data = '<div class="row">';
                row_data += '<div class="large-2 columns eventDate">';
                row_data += '<span class="eventItem">' +start_date['month_string'] + "<br />" + start_date['day'] + '</span>';
                row_data += '</div>';
                row_data += '<div class="large-10 columns">';
                row_data += ''+v.summary+ '';
                row_data += '</div>';
                row_data += '</div>';

                jQuery('#right-event-holder').append(row_data);
                j++;
            });
        }else{
            jQuery('#right-event-holder').append('<div style="padding:10px;"><?php _e("No upcoming events", "deltamain");?></div>');
        }

   });                  
// var search_count = jQuery('#intranet-pages .row').length;
// jQuery('.countsearch').html(search_count);

	});



</script>
<?php

get_footer()
?>
