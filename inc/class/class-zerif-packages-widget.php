<?php
/**************************/

/****** packages widget */

/************************/

class zerif_packages extends WP_Widget {

	private $form_tools;

	public function __construct() {
		parent::__construct(
			'color-picker',
			_x( 'Zerif - Package widget', 'widget title', 'zerif' ),
			array(
				'classname'   => 'package-widget col-lg-3 col-md-6 col-sm-6',
				'description' => '',
				'customize_selective_refresh' => true
			)
		);
		$this->form_tools = new Zerif_Widget_Form_Tools($this);
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts' ), 9999 );
	}


	public function enqueue_scripts( $hook_suffix ) {
		if ( 'widgets.php' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

	}

	public function print_scripts() {
		?>
		<script>
			( function( $ ){
				function initColorPicker( widget ) {
					widget.find( '.color-picker' ).wpColorPicker( {
						change: _.throttle( function() { // For Customizer
							$(this).trigger( 'change' );
						}, 3000 )
					});
				}

				function onFormUpdate( event, widget ) {
					initColorPicker( widget );
				}

				$( document ).on( 'widget-added widget-updated', onFormUpdate );

				$( document ).ready( function() {
					$( '#widgets-right .widget:has(.color-picker)' ).each( function () {
						initColorPicker( $( this ) );
					} );
				} );
			}( jQuery ) );
		</script>
		<?php
	}

	public function widget( $args, $instance ) {
		extract( $args );

		echo $before_widget;

		$zerif_packages_target = '_self';
		if( !empty($instance['focus_open_new_window']) ):
			$zerif_packages_target = '_blank';
		endif;

		$title = ! empty( $instance['title'] ) ? apply_filters( 'wpml_translate_single_string', $instance['title'], 'Packages' , $instance['title']) : '';
		$subtitle = ! empty( $instance['subtitle'] ) ? apply_filters( 'wpml_translate_single_string', $instance['subtitle'], 'Packages' , $instance['subtitle']) : '';
		$price = ! empty( $instance['price'] ) ? apply_filters( 'wpml_translate_single_string', $instance['price'], 'Packages' , $instance['price']) : '';
		$currency = ! empty( $instance['currency'] ) ? apply_filters( 'wpml_translate_single_string', $instance['currency'], 'Packages' , $instance['currency']) : '';
		$meta = ! empty( $instance['price_meta'] ) ? apply_filters( 'wpml_translate_single_string', $instance['price_meta'], 'Packages' , $instance['price_meta']) : '';
		$button_label = ! empty( $instance['button_label'] ) ? apply_filters( 'wpml_translate_single_string', $instance['button_label'], 'Packages' , $instance['button_label']) : '';
		$button_link = ! empty( $instance['button_link'] ) ? apply_filters( 'wpml_translate_single_string', $instance['button_link'], 'Packages' , $instance['button_link']) : '';

		?>


		<div class="package-box-wrap col-lg-3 col-md-6 col-sm-6">

			<?php
				if( !empty($subtitle) ):
					echo '<div class="best-value">';
				endif;
			?>

			<div class="package" data-scrollreveal="enter left after 0s over 1s">
				<div class="package-header" style="background:<?php if( !empty($instance['color']) ): echo $instance['color']; endif; ?>">
					<?php
						if( !empty($subtitle) ):

							if( !empty($title) ):
								echo '<h4>'.wp_kses_post($title).'</h4>';
							endif;
							echo '<div class="meta-text">'.wp_kses_post($subtitle).'</div>';

						else:

							if( !empty($title) ):
								echo '<h5>'.wp_kses_post($title).'</h5>';
							endif;

						endif;

					?>
				</div>
				<div class="price dark-bg">
					<div class="price-container">
					<?php
						if( isset($price) && $price != '' ):
							echo '<h4>';

							if( !empty($currency) ):
								echo '<span class="dollar-sign">'.wp_kses_post($currency).'</span>';
							endif;

							echo wp_kses_post($price);

							echo '</h4>';
						endif;

						if( !empty($meta) ):
							echo '<span class="price-meta">';
								echo wp_kses_post($meta);
							echo '</span>';
						endif;
					?>
					</div>
				</div>
				<ul>
					<?php
						for ($i = 1; $i <= 10; $i++):
							$str_item = 'item'.$i;
							$item = ! empty( $instance[$str_item] ) ? apply_filters( 'wpml_translate_single_string', $instance[$str_item], 'Packages' , $instance[$str_item]) : '';

							if( !empty($item) ):
								echo '<li>'.wp_kses_post($item).'</li>';
							endif;
						endfor;
					?>
				</ul>
				<?php
				if( !empty($button_label) && !empty($button_link) ) {
					$color='';
					$zerif_accessibility = get_theme_mod( 'zerif_accessibility' );

					if(! empty( $instance['color'])){
						$color = 'style="background:'.$instance['color'].'"';
					} ?>
					<a target="<?php echo wp_kses_post( $zerif_packages_target ); ?>" href="<?php echo esc_url( $button_link ); ?>" class="btn btn-primary custom-button" <?php echo $color; ?>>
						<?php
						if ( isset( $zerif_accessibility ) && $zerif_accessibility == 1 ) { ?>
							<span class="screen-reader-text"><?php _e( 'Go to', 'zerif' ); ?><?php echo apply_filters( 'widget_title', $title ); ?></span>
							<?php
						}
						echo wp_kses_post( $button_label ); ?>
					</a>
					<?php
				} ?>

			</div>
			<?php
				if( !empty($subtitle) ):
					echo '</div>';
				endif;
			?>
		</div>

		<?php

		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'color' ] = strip_tags( $new_instance['color'] );

		$instance['title'] = strip_tags( $new_instance['title'] );

        $instance['subtitle'] = strip_tags( $new_instance['subtitle'] );

		$instance['price'] = strip_tags( $new_instance['price'] );

		$instance['currency'] = strip_tags( $new_instance['currency'] );

		$instance['price_meta'] = strip_tags( $new_instance['price_meta'] );

		$instance['button_label'] = strip_tags( $new_instance['button_label'] );

		$instance['button_link'] = strip_tags( $new_instance['button_link'] );

		$instance['button_link'] = strip_tags( $new_instance['button_link'] );

		$instance['item1'] = strip_tags( $new_instance['item1'] );

		$instance['item2'] = strip_tags( $new_instance['item2'] );

		$instance['item3'] = strip_tags( $new_instance['item3'] );

		$instance['item4'] = strip_tags( $new_instance['item4'] );

		$instance['item5'] = strip_tags( $new_instance['item5'] );

		$instance['item6'] = strip_tags( $new_instance['item6'] );

		$instance['item7'] = strip_tags( $new_instance['item7'] );

		$instance['item8'] = strip_tags( $new_instance['item8'] );

		$instance['item9'] = strip_tags( $new_instance['item9'] );

		$instance['item10'] = strip_tags( $new_instance['item10'] );

		$instance['background_color'] = $new_instance['background_color'];

		$instance['focus_open_new_window'] = strip_tags($new_instance['focus_open_new_window']);

		return $instance;
	}


	public function form( $instance ) {

		$form_tools = $this->form_tools;

		$form_tools->input_text($instance, array(
			'sanitize' => 'esc_html',
			'instance_name' => 'color',
			'label' => __('Color:','zerif'),
			'type' => 'color'
		));

		$form_tools->input_text($instance, array(
			'sanitize' => 'esc_html',
			'instance_name' => 'title',
			'label' => __('Title','zerif')
		));

		$form_tools->input_text($instance, array(
			'sanitize' => 'esc_html',
			'instance_name' => 'subtitle',
			'label' => __('Subtitle','zerif')
		));

		$form_tools->input_text($instance, array(
			'sanitize' => 'esc_html',
			'instance_name' => 'price',
			'label' => __('Price','zerif'),
			'type' => 'number'
		));

		$form_tools->input_text($instance, array(
			'sanitize' => 'esc_html',
			'instance_name' => 'currency',
			'label' => __('Currency','zerif'),
		));

		$form_tools->input_text($instance, array(
			'sanitize' => 'esc_html',
			'instance_name' => 'price_meta',
			'label' => __('Price meta (e.g. /MONTH)','zerif')
		));

		$form_tools->input_text($instance, array(
			'sanitize' => 'esc_html',
			'instance_name' => 'button_label',
			'label' => __('Button label','zerif')
		));

		$form_tools->input_text($instance, array(
			'sanitize' => 'esc_url',
			'instance_name' => 'button_link',
			'label' => __('Button link','zerif')
		));

		$form_tools->input_text($instance, array(
			'instance_name' => 'focus_open_new_window',
			'type' => 'checkbox'
		));

		for($i = 1 ; $i <= 10 ; $i++){
			$form_tools->input_text($instance, array(
				'sanitize' => 'esc_html',
				'instance_name' => 'item'.$i,
				'label' => sprintf( __('Item %1$s','zerif'), $i )
			));
		}
	}
}