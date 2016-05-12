<?php 
/* meta boxes for Alerts*/
wp_enqueue_script( 'jquery-ui-datepicker' );
wp_enqueue_style( 'jquery-ui-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);
/* media button with metaboxes*/
$prefix = '_';
 
$meta_box_alert = array(
	'id' => 'alert_meta_box',
	'title' => 'Settings',
	'page' => 'alerts',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Link',
			'id' => $prefix.'alertlinks',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => 'Expire Date',
			'id' => $prefix.'expire',
			'type' => 'date',
			'std' => '',
			'desc'=>'Expire Date'
		),
		
	
	)
);
 
add_action('admin_menu', 'add_metabox_alert');
 
// Add meta box
function add_metabox_alert() {
	global $meta_box_alert;
 
	add_meta_box($meta_box_alert['id'], $meta_box_alert['title'], 'show_metabox_alert', $meta_box_alert['page'], $meta_box_alert['context'], $meta_box_alert['priority']);
}
 
// Callback function to show fields in meta box
function show_metabox_alert() {
	global $meta_box_alert, $post;
 
	// Use nonce for verification
	echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_alert['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
 
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
 
 
 
 
//If Text		
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
					'<br />', $field['desc'];
			
					
				break;
//If Text		
			case 'date':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:17%" />', $field['desc'];
				echo "<script>
				jQuery(document).ready(function(){
				jQuery('#_expire').datepicker({
				dateFormat : 'dd/m/yy'
				});
				});
				</script>";
									
				break;
//If Textarea		
			case 'textarea':		
			echo  '<textarea  name="', $field['id'], '" id="', $field['id'], '"rows="4" cols="72">', $meta ? $meta : $field['std'],'</textarea> <br />', $field['desc'];

				break;
// if img case 
			case 'img':
				echo '<img name="', $field['id'], '" id="', $field['id'], '" src="', $meta ? $meta : $field['std'], '" size="30" style="width:17%" />',
					'<br />', $field['desc'];
				break;
 
//If Button	
 
				case 'button':
				echo '<input type="button" name="', $field['id'], '" class="', $field['class'], '"id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
 
	echo '</table>';
}
 
add_action('save_post', 'save_metabox_data_alert');
 //$settings = array( 'textarea_name' => 'banner' );

//wp_editor( $content, $editor_id, $settings );
// Save data from meta box
function save_metabox_data_alert($post_id) {
	global $meta_box_alert;
 
	// verify nonce
	if (!wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('alert' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($meta_box_alert['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

/*end of Alert meta boxes*/
?>
