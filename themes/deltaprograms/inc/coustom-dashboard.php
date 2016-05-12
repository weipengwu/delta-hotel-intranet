<?php
/*
 * Custom Admin Dashaboard
 */
// remove unwanted dashboard widgets for relevant users
function delta_remove_dashboard_widgets() {
    $user = wp_get_current_user();
    if ( ! $user->has_cap( 'manage_options' ) ) {
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
    }
}
add_action( 'wp_dashboard_setup', 'delta_remove_dashboard_widgets' );

function delta_move_dashboard_widget() {
    $user = wp_get_current_user();
    if ( ! $user->has_cap( 'manage_options' ) ) {
        global $wp_meta_boxes;
        $widget = $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'];
        unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
        $wp_meta_boxes['dashboard']['side']['core']['dashboard_right_now'] = $widget;
    }
}
add_action( 'wp_dashboard_setup', 'delta_move_dashboard_widget' );

/*
 * Dashboard Welcome Message 
 */ 
 /**
 * Hide default welcome dashboard message and and create a custom one
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function delta_welcome_panel() {

	?>
<script type="text/javascript">
/* Hide default welcome message */
jQuery(document).ready( function($) 
{
	$('div.welcome-panel-content').hide();
});
</script>

	<div class="custom-welcome-panel-content">
	<h3><?php _e( 'Welcome to Your Den Sites Dashboard!' ); ?></h3>
	<p class="about-description"><?php _e( 'Use the links below to get started.' ); ?></p>
	<div class="welcome-panel-column-container">
	<div class="welcome-panel-column">
		<h4><?php _e( "Get Started" ); ?></h4>
		<a class="button button-primary button-hero load-customize hide-if-no-customize" href="http://your-website.com"><?php _e( 'Customize Your Site' ); ?></a>
			<p class="hide-if-no-customize"><?php printf( __( 'or, <a href="%s">edit your site settings</a>' ), admin_url( 'options-general.php' ) ); ?></p>
	</div>
	<div class="welcome-panel-column">
		<!--h4><?php _e( 'Next Steps' ); ?></h4-->
		<ul>
		<?php if ( 'page' == get_option( 'show_on_front' ) && ! get_option( 'page_for_posts' ) ) : ?>
			
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
		<?php elseif ( 'page' == get_option( 'show_on_front' ) ) : ?>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Add a blog post' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
		<?php else : ?>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Create Your Landing Page Carousel!' ) . '</a>', admin_url( 'post-new.php??post_type=gallery' ) ); ?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
			
		<?php endif; ?>
			
		</ul>
	</div>
	<div class="welcome-panel-column welcome-panel-last">
		<!--h4><?php _e( 'More Actions' ); ?></h4-->
		<ul>
			
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Add a Headlins' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
			<!--li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add an About page' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li-->
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-view-site">' . __( 'View your site' ) . '</a>', home_url( '/' ) ); ?></li>
			
			<!--li><?php printf( '<div class="welcome-icon welcome-widgets-menus">' . __( 'Manage <a href="%1$s">widgets</a> or <a href="%2$s">menus</a>' ) . '</div>', admin_url( 'widgets.php' ), admin_url( 'nav-menus.php' ) ); ?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-comments">' . __( 'Turn comments on or off' ) . '</a>', admin_url( 'options-discussion.php' ) ); ?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-learn-more">' . __( 'Learn more about getting started' ) . '</a>', __( 'http://codex.wordpress.org/First_Steps_With_WordPress' ) ); ?></li-->
		</ul>
	</div>
	</div>
	<!--div class="">
	<h3><?php _e( 'If you need more space' ); ?></h3>
	<p class="about-description">Create a new paragraph!</p>
	<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Etiam porta sem malesuada magna mollis euismod.
	
	Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Etiam porta sem malesuada magna mollis euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
	</div-->
	</div>

<?php
}

add_action( 'welcome_panel', 'delta_welcome_panel' );
