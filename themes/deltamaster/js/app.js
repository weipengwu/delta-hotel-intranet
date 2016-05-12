/**
 * Delta Eployee Network
 *
 * @package den
 */
;
(function ($, window, undefined) {
    'use strict';

    // document.domain = 'deltaden.kpd-i.com';
    // jQuery.ajax({ url:  'https://deltahotels.oktapreview.com/api/v1/users/me/appLinks', xhrFields: { withCredentials: true } }).done(function(res) { 

    //     $.each(res, function(i, v) {

    //         $('#navMenu_app .col-1').append('<a class="item" href="' + v.linkUrl + '" target="_blank"><div class="image"><img width="22" height="22" alt="" src="' + v.logoUrl + '"></div><div class="content"><div class="title">' + v.label + '</div></div></a>');


    //     });
        

    // });

    /**
     * Simple logging function
     */
    var log = function () {
        var message = [];
        for (var i = 0; i < arguments.length; i++) {
            message.push(arguments[i]);
        }
        try {
            console.log('DEN', message);
        } catch (e) {
        }
    };



    $(document).foundation();
    $(document).ready(function () {

        $('.employee_directory .search').keyup(function(){
            $('.employee_directory .list').hide();
            if($(this).val() !== ""){
                //$('.employee_directory .list').hide();
                $('.employee_directory .directory_instruction').hide();
                $('.loading').show();
                var data = $('.employee_directory .directory_search').serialize() + '&action=search_employee';
                $.post('/wp-admin/admin-ajax.php', data, function(results){
                    setTimeout(function(){$('.loading').hide()}, 1000);
                    if(results == "none"){
                        $('.employee_directory .list').html('<li>No result</li>');
                        setTimeout(function(){$('.employee_directory .list').show()}, 1000);
                    }else{
                        var obj = $.parseJSON(results);
                        var output = '';
                        for (var i = 0; i < obj.length; i++){
                            output += '<li><div class="profile_img">'+obj[i].avatar+'</div><div class="profile_info"><h3>'+obj[i].firstname+' '+obj[i].lastname+'</h3><span>'+obj[i].jobtitle+'</span><span>' + obj[i].phone + '</span><a href="mailto:'+obj[i].email+'"><img src="/wp-content/themes/deltamaster/images/email-icon.png" style="height: 10px; position: relative; top: -5px; margin-right: 5px;">Email</a><span>'+obj[i].property_text +' ['+obj[i].property_code+']</span></div></li>';
                        };
                        $('.employee_directory .list').html(output);
                        setTimeout(function(){$('.employee_directory .list').show()},1000);

                    }
                });
                // $('.employee_directory .list').show();
            }else{
                $('.employee_directory .list').hide();
                $('.employee_directory .directory_instruction').show();
            }

        })

		// $("a").click(function(event) {
  //               var href = $(this).attr('href');
                
  //               if(href != "#")
  //               {
	 //                window.location = href;
	 //            }
  //               //event.preventDefault();
  //           });
        $('#page-header #global-nav ul li.directory a').on('click', function(e){
            e.preventDefault();
            if($(this).parent().find('.employee_directory').is(':hidden')){
                $(this).parent().addClass('active');
            }else{
                $(this).parent().removeClass('active');
            }
        });
        
        $('#main-nav .hasSub, #profile-nav .profile').on('click', function(e) {
			
			var href = $(this).attr('href');
			console.log(href);
			
			if (! $(this).hasClass('active') ) {
                $('.navMenu').fadeOut();
                $('.hasSub').removeClass('active');
                
                $(this).addClass('active').find('.navMenu').fadeIn();

                if ($(this).find('iframe').length > 0)
                    $(this).find('iframe').show();
            }
            else {
                $('.navMenu').hide();
                $('.hasSub').removeClass('active');
                $(this).find('iframe').hide();
            }
		});
        
        $('#left-column .messages').each(function (index, widget) {
            log(widget);
            $('nav .next', widget).on('click', function (e) {
                log('next clicked');
                e.preventDefault();
                $('.orbit-next', widget).trigger('click');
            });
            $('nav .prev', widget).on('click', function (e) {
                log('prev clicked');
                e.preventDefault();
                $('.orbit-prev', widget).trigger('click');
            });
        });

	$('.slider-for').slick({
			slidesToShow: 	1,
			slidesToScroll: 1,
			arrows: 		false,
			fade: 			true,
			asNavFor: 		'.slider-nav',
			autoplay: 		true,
			autoplaySpeed: 	5000,
			infinite:		true,
		});
		
		$('.slider-nav').slick({
			slidesToShow: 	3,
			slidesToScroll: 1,
			asNavFor: 		'.slider-for',
			dots: 			false,
			centerMode: 	true,
			centerPadding:	50,
			focusOnSelect: 	true,
			infinite:		true,
			variableWidth:	true
		});

        $('.carousel .list').slick({
//            centerMode: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
    });


})(jQuery, this);jQuery.noConflict();

