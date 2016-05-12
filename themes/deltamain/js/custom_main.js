 var pageCount = 2;
jQuery('.load_more').click(function(){
  jQuery('.animation_image').show();
  jQuery('.load_more').hide();
   
    var totalPages=jQuery('#totalPages').val();
 
    jQuery.get("wp-content/themes/deltamain/partials/body/loadMorePostsAjax.php?page="+pageCount,function(data){
				jQuery("#loadMore").show(); //bring back load more button
				jQuery("#results").append(data); //append data received from server
				//scroll page to button element
				jQuery("html, body").animate({scrollTop: jQuery("#load_more_button").offset().top}, 500);
				//hide loading image
				jQuery('.animation_image').hide(); //hide loading image once data is received		
				jQuery('.load_more').show();
				pageCount++; //user click increment on load button
				});
    
			if(pageCount == totalPages)
			{
			setTimeout(function(){jQuery('.animation_image').hide();}, 1000);
			setTimeout(function(){jQuery('#load_more_button').hide();}, 1000);
			setTimeout(function(){jQuery('.no_more').show();}, 1000);
			
							//setTimeout(function(){jQuery('#load_more_button').hide();}, 4000);
			}
	});
