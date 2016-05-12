<section id="right-column">
    <section class="panel eventpanel">
        <h3 class="header"><? _e('Upcoming Events', 'deltamain')?></h3>
        <div id="right-event-holder"></div>
    </section>

    <? display_related_resources() ?> 

    <?php if ( current_user_can('edit_post') ) :?>
    <section class="panel quick-post">
        <h3 class="header"><? _e('Quick Post','deltamain')?></h3>
        <div class="body">
            <p><? _e('Share your status with your colleagues','deltamain')?></p>
            <a href="<?php  get_bloginfo('url') ;?>/wp-admin/post-new.php" class="write"><? _e('Write a Post','deltamain')?></a>
        </div>
    </section>
     <?php endif;?>
</section>
<script>
jQuery(document).ready(function() {
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

            //console.log(resp);
        if(resp.length > 0){
            //jQuery('.eventpanel').prepend('<h3 class="header">Upcoming Events</h3> ');
            var j = 0;
            jQuery.each(resp, function(i, v) { 
                if(j>2){
                    return false;
                }
                console.log(v.summary);
                // console.log(v.start_date);
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
            jQuery('#right-event-holder').append('<div style="padding:10px;font-size:13.5px;"><?php _e("No upcoming events", "deltamain");?></div>');
        }

   });
})
</script>