<?php


/**
 * Handles Metabox Home Section
 */
function nimbus_home_section_meta_box($post){
	$value = get_post_meta($post->ID,'_nimbus_home_section_position_meta_key', true);
	?>
		<p>
		    <label>Defina la posición</label>
			<input type="text" name="nimbus_home_section_position" value="<?php echo esc_attr($value); ?>">
		</p>
	<?php
}


/**
 * Retrocall Metabox home Section ID
 */
 function nimbus_home_section_id_meta_box($post){
	$value = get_post_meta($post->ID,'_nimbus_home_section_id_meta_key', true);
	?>
		<p>
		    <label>Defina un ID </label>
			<input type="text" name="nimbus_home_section_id" value="<?php echo esc_attr($value); ?>">
		</p>
	<?php
 }
 
 /**
 * Retrocall Metabox home Section Class
 */
function nimbus_home_section_class_meta_box($post){
	$value = get_post_meta($post->ID,'_nimbus_home_section_class_meta_key', true);
	?>
		<p>
		    <label>Ingresa una clase(s) CSS</label>
			<input type="text" name="nimbus_home_section_class" value="<?php echo esc_attr($value); ?>">
		</p>
	<?php
}

/**
 * Retrocall Metabox home Section Background Image
 */
function nimbus_home_section_bg_img_meta_box($post){
	$value = get_post_meta($post->ID,'_nimbus_home_section_bg_img_meta_key', true);
	?>
		<p>
		    <label>Ingresa URL Image</label>
			<input type="text" name="nimbus_home_section_bg_img" value="<?php echo esc_attr($value); ?>">
		</p>
	<?php
}


function nimbus_home_section_save_meta_box_data($post_id){
	if ( ! isset( $_POST['nimbus_home_section_position'] ) ) {
		return;
	}
	

	// Sanitize user input.
	$home_section_position = sanitize_text_field( $_POST['nimbus_home_section_position'] );
	$home_section_id       = sanitize_text_field( $_POST['nimbus_home_section_id'] );
	$home_section_class    = sanitize_text_field( $_POST['nimbus_home_section_class'] );
	$home_section_bg_img    = sanitize_text_field( $_POST['nimbus_home_section_bg_img'] );			

	// Update the meta field in the database.
	update_post_meta( $post_id, '_nimbus_home_section_position_meta_key', $home_section_position);
	update_post_meta( $post_id, '_nimbus_home_section_id_meta_key', $home_section_id );
	update_post_meta( $post_id, '_nimbus_home_section_class_meta_key', $home_section_class );
	update_post_meta( $post_id, '_nimbus_home_section_bg_img_meta_key', $home_section_bg_img);
}
add_action('save_post','nimbus_home_section_save_meta_box_data');
