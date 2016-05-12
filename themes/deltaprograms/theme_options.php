<?php
/*adding textarea to customizer*/
add_action( 'customize_register', 'deltapro_customize_register' );

function deltapro_customize_register($wp_customize) {

  //class definition must be within my_customie_register function
  class Delta_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
 
    public function render_content() {
        ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
        <?php
    }
}

  //other stuff
}
    function wpq_theme_customizer( $wp_customize ) {    
     
            /* Extend the Image Control */
            class My_Customize_Image_Media_Library_Control extends WP_Customize_Image_Control
            {
                    public function __construct( $manager, $id, $args = array() )
                    {
                            parent::__construct( $manager, $id, $args );
                            $this->remove_tab('uploaded');
                            $this->add_tab( 'medialibrary',   __('Media Library'),   array( $this, 'tab_medialibrary' ) );
                    }
           
                    public function tab_medialibrary()
                    {
                    ?>     
                            <div class="medialibrary-target"></div>
                                                           
                            <a class="choose-from-library-link button" data-controller = "<?php echo $this->id;?>">
                                    <?php _e( 'Open Library' ); ?>
                            </a>    
                    <?php  
                    }
            }
       
            /* Remove Default Controls */
            $wp_customize->remove_section('static_front_page');
            $wp_customize->remove_section('nav');
            $wp_customize->remove_section('colors');
     
            /* Add Custom Section for header Image*/
            $wp_customize->add_section( 'my_header', array(
                    'title'    => __( 'Header Image', '' ),
                    'priority' => 20,
            ) );
     
            $wp_customize->add_setting( 'image_setting', array(
                    'capability'  => 'edit_theme_options'
            ) );
     
            $wp_customize->add_control( new My_Customize_Image_Media_Library_Control( $wp_customize, 'my_header', array(
                    'label'         => __( 'Header image', '' ),
                    'section'       => 'my_header',
                    'settings'      => 'image_setting'
            ) ) ); 
            /* Add Custom Section  for logo*/
            $wp_customize->add_section( 'delta_logo', array(
                    'title'    => __( 'Logo', '' ),
                    'priority' => 20,
            ) );
     
            $wp_customize->add_setting( 'logo_setting', array(
                    'capability'  => 'edit_theme_options'
            ) );
     
            $wp_customize->add_control( new My_Customize_Image_Media_Library_Control( $wp_customize, 'delta_logo', array(
                    'label'         => __( 'Logo image', '' ),
                    'section'       => 'delta_logo',
                    'settings'      => 'logo_setting'
            ) ) );
           
    }
     
    add_action( 'customize_register', 'wpq_theme_customizer', 99 );
     
     
    /**
     * Add javascript to the customizer
     * See http://pastebin.com/aTyNnfk7 for wpq.js
     */
    function wpq_add_scripts()
    {
        wp_enqueue_media();
        wp_enqueue_script('wpq-media-manager', get_stylesheet_directory_uri().'/js/cutomizer.js', array( 'jquery' ), '1.0', true);
    }
     
    add_action( 'customize_controls_print_styles', 'wpq_add_scripts', 50 );
     
     
    /**
     * Add CSS to the customizer
     */
    function wpq_customize_styles()
    {
    ?>
        <style>
        .wp-full-overlay {
            z-index: 150000 !important;
        }
        </style>
    <?php }
     
    add_action( 'customize_controls_print_styles', 'wpq_customize_styles', 50 );


