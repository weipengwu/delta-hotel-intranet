/**
 * Delta Eployee Network
 *
 * @package den
 */
;
(function ($, window, undefined) {
    'use strict';


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

		$("a").click(function(event) {
                var href = $(this).attr('href');
                
                if(href != "#" )
                {
	                window.location = href;
	            }
                //event.preventDefault();
            });
        
        $('#main-nav .hasSub, #profile-nav .profile').on('click', function(e) {
			e.preventDefault();
			var href = $(this).attr('href');
			console.log(href);
			
			if (! $(this).hasClass('active') ) {
				$('.navMenu').fadeOut();
				$('.hasSub').removeClass('active');
				
				$(this).addClass('active').find('.navMenu').fadeIn();
			}
			else {
				$('.navMenu').hide();
				$('.hasSub').removeClass('active');
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



        $('.carousel .list').slick({
//            centerMode: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1
        });
    });


})(jQuery, this);

