<!--
jQuery.noConflict();

//-->
/**ui Tabs**/
    jQuery(document).ready( function() {
    	jQuery( ".tabs" ).tabs();
    });jQuery.noConflict();

	jQuery("#tab1").click(function(){
		jQuery(".quickLinks a.first").css("display","none");
		jQuery(".quickLinks a.sec").css("display","none");
		});
	jQuery("#tab2").click(function(){
		jQuery(".quickLinks a.first").css("display","block");
		jQuery(".quickLinks a.sec").css("display","none");
		});
	jQuery("#tab3").click(function(){
		jQuery(".quickLinks a.first").css("display","none");
		jQuery(".quickLinks a.sec").css("display","block");
		
		});

  
/** Language cookies**/
jQuery(function() {

	tha_buttons = { };
	tha_buttons[dialog_save_text] = function(){
		    var language_value = 'english';
		 
		    jQuery("input:radio[name=language]").each(function() {
			if(jQuery( this ).prop( "checked" ) == true){
			    language_value = jQuery(this).val();
			    
			}
		    });
		
		    dialog.dialog( "close" );
		    var data = {
		    	action: 'switch_lang',
		    	switch_language: language_value
		    }
		    var url = lang_url;
	    	jQuery.post('/wp-admin/admin-ajax.php', data, function(result) { 
	    		//location.reload(true);
		if(document.URL == "http://deltaden.kpd-i.com/#" || document.URL == "https://den.deltahotels.com/#" || document.URL == "https://deltaprivilege.den.deltahotels.com/#" || document.URL == "https://simplyclean.den.deltahotels.com/#" || document.URL == "https://deltagreens.den.deltahotels.com/#" || document.URL == "https://meetings.den.deltahotels.com/#" || document.URL == "https://events.den.deltahotels.com/#" || document.URL == "https://promotions.den.deltahotels.com/#" || url == ""){
	    			location.reload(true);
	    		}else{
	    			window.location = url;
	    		}
	    		

	    	});
		  
		};

		tha_buttons[dialog_cancel_text] = function() {
		  
		    dialog.dialog( "close" );
		};


 dialog = jQuery( "#dialog" ).dialog({
		autoOpen: false,
		height: 300,
		width: 723,
		top:288,
		left:310,
		modal: true,
		buttons: tha_buttons,
		close: function() {
		}
	    });

	jQuery( "#opener" ).click(function() {
	    cookieValue = jQuery.cookie("language_value");
	    jQuery("input:radio[name=language]").each(function() {
		if(jQuery( this ).val() == cookieValue){
		    jQuery(this).prop("checked",true);
		}
	    });
	    jQuery( "#dialog" ).dialog( "open" );
	});
	 jQuery('.liked').click(function(e) {
e.preventDefault();
});
	
	/* subscribe to blog */
	buttons = {};

 	buttons[dialog_update_text] = function() { 

 		if (jQuery('input[name=subscribed]:checked').length == 0)
 		{
	 		jQuery.post('/wp-admin/admin-ajax.php', { 'action': 'update_subscriptions' }, function() { 

	 			location.reload();

	 		});
	 	}
	 	else
	 	{
	 		jQuery.post('/wp-admin/admin-ajax.php', { 'action': 'update_subscriptions', 'enable': 1 }, function() { 

	 			location.reload();

	 		});
	 	}

 	};
	
 	buttons[dialog_cancel_text] = function() { subscribe.dialog( "close" ); };

	subscribe = jQuery( "#subscribe" ).dialog({
		autoOpen: false,
		// height: 300,
		width: 723,
		top:288,
		left:310,
		modal: true,
		buttons: buttons,

		close: function() { }
    });

	jQuery( "small.subscribe" ).click(function() {

	    jQuery( "#subscribe" ).dialog( "open" );

	});

	/* manage subscriptions to blogs */
	buttons = {};

 	buttons[dialog_update_text] = function() { 

 		string = jQuery('#manage_subscribe input').serialize() + '&action=update_all_subscriptions';

 		jQuery.post('/wp-admin/admin-ajax.php', string, function() { 

 			location.reload();

 		});

 	};
	
 	buttons[dialog_cancel_text] = function() { manage_subscribe.dialog( "close" ); };

	manage_subscribe = jQuery( "#manage_subscribe" ).dialog({
		autoOpen: false,
		// height: 300,
		width: 723,
		top:288,
		left:310,
		modal: true,
		buttons: buttons,

		close: function() { }
    });

	jQuery( "small.customize" ).click(function() {

	    jQuery( "#manage_subscribe" ).dialog( "open" );

	});

	jQuery('td.switch').click(function() { 

		if(jQuery(this).hasClass('disabled')){
			//do nothing
		}
		else{
			if (jQuery(this).find('div').first().hasClass('on'))
			{
				jQuery(this).find('input').val('1');
				jQuery(this).find('div').first().removeClass('on').addClass('off');
				jQuery(this).find('div').last().removeClass('off').addClass('on');
			}
			else
			{
				jQuery(this).find('input').val('0');
				jQuery(this).find('div').first().removeClass('off').addClass('on');	
				jQuery(this).find('div').last().removeClass('on').addClass('off');
			}
		}

	});
	jQuery( "small.unsubscribe" ).click(function() {
		if(jQuery(this).hasClass('disabled')){
			//do nothing
		}else{
		    jQuery.post('/wp-admin/admin-ajax.php', { 'action': 'update_subscriptions', 'unsub': 1 }, function() { 

		 			location.reload();

		 		});
		}

	});




jQuery( "#Alertclose" ).click(function() {

		var alertId = jQuery(this).siblings("a.download").attr("rel"); 
		var close = "closed_alert_"+alertId;
		jQuery.cookie(close, "closed");    
		});
		var foo = jQuery.cookie("alertPostClose");
		var CookieSet = jQuery.cookie('alertPostClose');
		if (CookieSet == null) {
        }
		if (jQuery.cookie('cookietitle')) {
        }

});
jQuery('#Alertclose').on('click', function(){
            jQuery('.alert-box.warning').hide();
        })

  jQuery(document).ready(function(){
	   jQuery(".mtab").mouseover(function () {
                var tabIndex = jQuery(this).attr("rel");
                jQuery('.mtab-panel').hide();
                jQuery(tabIndex).show();
            });
	  /** alert box starts **/
		var alertId = jQuery("a.download").attr("rel"); 
	  	var alertCookieName = "closed_alert_"+alertId;
		alertPostClose = jQuery.cookie(alertCookieName);
	  if(alertPostClose == '' || typeof alertPostClose === "undefined"){
			jQuery(".alert-box").css('display','block');  
		}else{
			jQuery(".alert-box").remove();  
		}
	   jQuery(".ctab").mouseover(function () {
                var tabIndex = jQuery(this).attr("rel");
                jQuery('.ctab-panel').hide();
                jQuery(tabIndex).show();
            });
	  });
