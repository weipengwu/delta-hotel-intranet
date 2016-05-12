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
		
		$('#main-nav .hasSub, #profile-nav .profile').on('click', function(e) {
			e.preventDefault();
			
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
		
/*
		$('#main-nav .hasSub').on({
			mouseenter: function () {
				$(this).addClass('active').find('.navMenu').show();
			},

			mouseleave: function () {
				$(this).removeClass('active').find('.navMenu').hide();
			}
		});
*/
		

/*
		$('#profile-nav .profile').on('click', function(e) {
			e.preventDefault();
			$(this).find('.navMenu').toggle();
		});
*/

   
		
		
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



/*
        $('.carousel .list').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
*/


		$('.slider-for').slick({
			slidesToShow: 	1,
			slidesToScroll: 1,
			arrows: 		true,
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
	
	});
})(jQuery, this); jQuery.noConflict();
