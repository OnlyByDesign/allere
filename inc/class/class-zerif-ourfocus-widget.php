<?php
/**************************/

/****** our focus widget */

/************************/
if ( !class_exists( 'zerif_ourfocus' ) ) {
	class zerif_ourfocus extends WP_Widget {

		private $form_tools;

		public function __construct() {

			$widget_ops = array( 'customize_selective_refresh' => true, 'classname' => 'ctUp-ads' );

			parent::__construct( 'ctUp-ads-widget', 'Zerif - Our focus widget', $widget_ops );
			$this->form_tools = new Zerif_Widget_Form_Tools( $this );
			add_action( 'admin_enqueue_scripts', array( $this, 'upload_scripts' ) );
			add_action( 'admin_enqueue_styles', array( $this, 'upload_styles' ) );
		}

		/**
		 * Upload the Javascripts for the media uploader
		 */
		public function upload_scripts( $hook ) {
			if ( $hook != 'widgets.php' ) {
				return;
			}
			wp_enqueue_media();
			wp_enqueue_script( 'zerif_widget_media_script', get_template_directory_uri() . '/js/widget-media.js', false, '1.2.1', true );

		}

		/**
		 * Add the styles for the upload media box
		 */
		public function upload_styles( $hook ) {
			if ( $hook != 'widgets.php' ) {
				return;
			}
			wp_enqueue_style( 'thickbox' );
		}

		/**
		 * Outputs the HTML for this widget.
		 *
		 * @param array  An array of standard parameters for widgets in this theme
		 * @param array  An array of settings for this widget instance
		 *
		 * @return void Echoes it's output
		 **/
		public function widget( $args, $instance ) {
			extract( $args );

			echo $before_widget;

	    $zerif_focus_target = '_self';
		if ( ! empty( $instance['focus_open_new_window'] ) ):
			$zerif_focus_target = '_blank';
		endif;
		$zerif_accessibility = get_theme_mod( 'zerif_accessibility' );

		$zerif_widget_image = '';

		if ( ! empty( $instance['image_uri'] ) && ( $instance['image_uri'] != 'Upload Image' ) ) {

			$zerif_widget_image = apply_filters( 'wpml_translate_single_string', $instance['image_uri'], 'Widgets' , $instance['image_uri']);

		} elseif ( ! empty( $instance['image_in_customizer'] ) ) {

			$zerif_widget_image = apply_filters( 'wpml_translate_single_string', $instance['image_in_customizer'], 'Widgets' , $instance['image_in_customizer']);

		}

		?>

			<div class="col-lg-3 col-sm-3 focus-box" data-scrollreveal="enter left after 0.15s over 1s">
				<?php if ( ! empty( $zerif_widget_image ) ): ?>
					<div class="service-icon">
						<?php if ( ! empty( $instance['link'] ) ): ?>

							<a target="<?php echo esc_html( $zerif_focus_target ); ?>" href="<?php echo esc_url($instance['link']); ?>" >
								<?php
								if( isset($zerif_accessibility) && $zerif_accessibility == 1 ) { ?>
									<span class="screen-reader-text"><?php _e( 'Go to', 'zerif' ); ?> <?php echo apply_filters('widget_title', $instance['title']); ?></span>
									<?php
								} ?>
								<i class="pixeden our-focus-widget-image" style="background:url(<?php echo esc_url( $zerif_widget_image ); ?>) no-repeat center;"></i> <!-- FOCUS ICON-->
							</a>

						<?php else: ?>

							<i class="pixeden our-focus-widget-image"
							   style="background:url(<?php echo esc_url( $zerif_widget_image ); ?>) no-repeat center;"></i> <!-- FOCUS ICON-->

						<?php endif; ?>
					</div>
				<?php endif; ?>
				<h5 class="red-border-bottom"><?php if ( ! empty( $instance['title'] ) ): echo apply_filters( 'widget_title', $instance['title'] ); endif; ?></h5>
				<!-- FOCUS HEADING -->
				<p>
					<?php if ( ! empty( $instance['text'] ) ): echo htmlspecialchars_decode( apply_filters( 'widget_title', $instance['text'] ) ); endif; ?>
				</p>
			</div>
			<?php

			echo $after_widget;

		}

		public function update( $new_instance, $old_instance ) {
			$instance                          = $old_instance;
			$instance['text']                  = stripslashes( wp_filter_post_kses( $new_instance['text'] ) );
			$instance['link']                  = strip_tags( $new_instance['link'] );
			$instance['title']                 = strip_tags( $new_instance['title'] );
			$instance['image_uri']             = strip_tags( $new_instance['image_uri'] );
			$instance['focus_open_new_window'] = strip_tags( $new_instance['focus_open_new_window'] );
			$instance['image_in_customizer']   = strip_tags( $new_instance['image_in_customizer'] );

			return $instance;
		}

		/**
		 * Displays the form for this widget on the Widgets page of the WP Admin area.
		 *
		 * @param array  An array of the current settings for this widget
		 *
		 * @return void
		 **/
		public function form( $instance ) {
			$form_tools = $this->form_tools;

			$form_tools->input_text( $instance, array(
				'sanitize'      => 'wp_kses_post',
				'instance_name' => 'title',
				'label'         => __( 'Title', 'zerif' )
			) );

			$form_tools->input_text( $instance, array(
				'type'          => 'textarea',
				'instance_name' => 'text',
				'label'         => __( 'Text', 'zerif' )
			) );

			$form_tools->input_text( $instance, array(
				'sanitize'      => 'esc_url',
				'instance_name' => 'link',
				'label'         => __( 'Link', 'zerif' )
			) );

			$form_tools->input_text( $instance, array(
				'type'          => 'checkbox',
				'instance_name' => 'focus_open_new_window'
			) );

			$form_tools->image_control( $instance );
		}
	}
}