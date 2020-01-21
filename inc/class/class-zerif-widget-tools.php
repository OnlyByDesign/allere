<?php
class Zerif_Widget_Form_Tools{


	private $obj;

	public function __construct ( $obj ) {
		$this->obj = $obj;
	}

	/**
	 * Form image control
	 */
	public function image_control($instance) {
		$obj = $this->obj;
		$image_in_customizer = '';
		$display = 'none';
		if( !empty($instance['image_in_customizer']) ){
			$image_in_customizer = esc_url($instance['image_in_customizer']);
			$display = 'inline-block';
		} else {
			if( !empty($instance['image_uri']) ){
				$image_in_customizer = esc_url($instance['image_uri']);
				$display = 'inline-block';
			}
		} ?>
		<p>
			<label for="<?php echo $obj->get_field_id('image_uri'); ?>"><?php _e('Image', 'zerif-lite'); ?></label><br/>

			<?php
			$zerif_image_in_customizer = $obj->get_field_name('image_in_customizer');
			?>
			<input type="hidden" class="custom_media_display_in_customizer" name="<?php if( !empty($zerif_image_in_customizer) ) { echo $zerif_image_in_customizer; } ?>" value="<?php if( !empty($image_in_customizer) ): echo $image_in_customizer; endif; ?>">
			<img class="custom_media_image" src="<?php echo $image_in_customizer; ?>" style="margin:0;padding:0;max-width:100px;float:left;display:<?php echo $display; ?>" alt="<?php echo __( 'Uploaded image', 'zerif-lite' ); ?>" /><br />

			<input type="text" class="widefat custom_media_url" name="<?php echo $obj->get_field_name('image_uri'); ?>" id="<?php echo $obj->get_field_id('image_uri'); ?>" value="<?php if( !empty($instance['image_uri']) ): echo $instance['image_uri']; endif; ?>" style="margin-top:5px;">

			<input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $obj->get_field_name('image_uri'); ?>" value="<?php _e('Upload Image','zerif-lite'); ?>" style="margin-top:5px;">
		</p>
		<?php
	}

	public function input_text($instance, $options){
		$obj = $this->obj;
		$type = 'text';
		$instance_name = '';
		$label = '';
		$sanitize_function = 'esc_attr';
		if(!empty($options['sanitize'])){
			$sanitize_function = $options['sanitize'];
		}
		if(!empty($options['label'])){
			$label = $options['label'];
		}
		if(!empty($options['instance_name'])){
			$instance_name = $options['instance_name'];
		}
		if(!empty($options['type'])){
			$type = $options['type'];
		} ?>
		<p>
			<?php
			if (!empty($label)) { ?>
				<label for="<?php echo esc_attr( $obj->get_field_id( $instance_name ) ); ?>"><?php echo esc_html($label); ?></label><br/>
				<?php
			}

			switch ($type){
				case 'textarea': ?>
					<textarea class="widefat" rows="8" cols="20" name="<?php echo esc_attr($obj->get_field_name($instance_name)); ?>"
					          id="<?php echo esc_attr($obj->get_field_id($instance_name)); ?>"><?php
						if( !empty($instance[$instance_name]) ): echo htmlspecialchars_decode($instance[$instance_name]); endif;
						?></textarea>
					<?php
					break;
				case 'checkbox': ?>
					<input type="hidden" name="<?php echo esc_attr($obj->get_field_name($instance_name)); ?>" value="0" />
					<input type="checkbox" name="<?php echo esc_attr($obj->get_field_name($instance_name)); ?>" id="<?php echo esc_attr($obj->get_field_id($instance_name)); ?>" <?php if( !empty($instance[$instance_name]) ): checked( (bool) $instance[$instance_name], true ); endif; ?> ><?php _e( 'Open link in new window?','zerif' ); ?><br>
					<?php
					break;
				case 'color': ?>
					<input type="text" name="<?php echo esc_attr($obj->get_field_name($instance_name)); ?>" id="<?php echo esc_attr($obj->get_field_id($instance_name)); ?>" value="<?php if( !empty($instance[$instance_name]) ){ echo call_user_func_array( $sanitize_function, array( $instance[$instance_name] ) ); } ?>" class="color-picker" />
					<?php
					break;
				case 'number': ?>
					<input type="text" name="<?php echo esc_attr($obj->get_field_name($instance_name)); ?>" id="<?php echo esc_attr($obj->get_field_id($instance_name)); ?>" value="<?php if( isset($instance[$instance_name]) && $instance[$instance_name] != '' ){ echo call_user_func_array( $sanitize_function, array( $instance[$instance_name] ) ); } ?>" class="widefat" />
					<?php
					break;
				default: ?>
					<input type="text" name="<?php echo esc_attr($obj->get_field_name($instance_name)); ?>" id="<?php echo esc_attr($obj->get_field_id($instance_name)); ?>" value="<?php if( !empty($instance[$instance_name]) ){ echo call_user_func_array( $sanitize_function, array( $instance[$instance_name] ) ); } ?>" class="widefat" />
					<?php
					break;
			} ?>

		</p>
		<?php
	}
}