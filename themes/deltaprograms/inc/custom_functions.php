<?php
/*1*/
function my_add_image_control( $slug, $label ) {
    global $wp_customize;
    static $count = 0;
    $id = "my_theme_settings[{$slug}]";
    $wp_customize->add_setting( $id, array(
        'type'              => 'option',
        'transport'     => 'postMessage'
    ) );
     
    $control =
    new WP_Customize_Image_Control( $wp_customize, $slug,
        array(
        'label'         => __( $label, 'my_theme' ),
        'section'       => 'logo_setting',
        'priority'      => $count,
        'settings'      => $id
        )
    );
    $wp_customize->add_control($control);
    $count++;
    return $control;
}

/*2*/
global $my_image_controls;
foreach ($my_image_controls as $id => $control) {
    $control->add_tab( 'library',   __( 'Media Library' ), 'my_library_tab' );
}
 
function my_library_tab() {
    global $my_image_controls;
    static $tab_num = 0; // Sync tab to each image control
     
    $control = array_slice($my_image_controls, $tab_num, 1);
    ?>
    <a class="choose-from-library-link button"
        data-controller = "<?php esc_attr_e( key($control) ); ?>">
        <?php _e( 'Open Library' ); ?>
    </a>
     
    <?php
    $tab_num++;
} 
echo"<script>
(function($) {
 
// Object for creating WordPress 3.5 media upload menu
// for selecting theme images.
wp.media.shibaMediaManager = {
     
    init: function() {
        // Create the media frame.
        this.frame = wp.media.frames.shibaMediaManager = wp.media({
            title: 'Choose Image',
            library: {
                type: 'image'
            },
            button: {
                text: 'Insert into skin',
            }
        });
 
         
        $('.choose-from-library-link').click( function( event ) {
            wp.media.shibaMediaManager.$el = $(this);
            var controllerName = $(this).data('controller');
            event.preventDefault();
 
            wp.media.shibaMediaManager.frame.open();
        });
         
    } // end init
}; // end shibaMediaManager
 
wp.media.shibaMediaManager.init();
 
}(jQuery))
</script>";
