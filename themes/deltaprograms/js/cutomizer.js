    (function($) {
     
    // Object for creating WordPress 3.5 media upload menu
    // for selecting theme images.
    wp.media.deltaMediaManager = {
         
        init: function() {
     
            var controllerName = '';
           
            // Create the media frame.
            this.frame = wp.media.frames.deltaMediaManager = wp.media({
                title: 'Choose Image',
                library: {
                    type: 'image'
                },
                button: {
                    text: 'Insert Image'
                }
            });
     
            // When an image is selected, run a callback.
            this.frame.on( 'select', function() {
     
                    // Grab the selected attachment.
                    var attachment = wp.media.deltaMediaManager.frame.state().get('selection').first();
     
                    // Add the selected attachment url to the image selector
                    var myurl       = attachment.attributes.url;
                    var mypid       = attachment.attributes.id;
                    var myid        = controllerName + '_selected_image_' + mypid;
                    var mytarget    = '#customize-control-' + controllerName + ' .medialibrary-target';
     
                    $( '<a id="' + myid + '" href="#" class="thumbnail"></a>').hide().data("customizeImageValue", myurl ).append( '<img src="' + myurl + '" />' ).appendTo( $( mytarget ) );
                    $( '#' + myid ).trigger( 'click' );
     
            });
     
            // Open the Media Library
            $('.choose-from-library-link').click( function( event ) {
                wp.media.deltaMediaManager.$el = $(this);
                controllerName = $(this).data('controller');
                event.preventDefault();
                wp.media.deltaMediaManager.frame.open();
            });
             
        } // end init
     
     
    }; // end deltaMediaManager
     
    wp.media.deltaMediaManager.init();
     
    }(jQuery));

