<?php
/****************************/

/****** team member widget **/

/***************************/
if ( !class_exists( 'zerif_team_widget' ) ) {
	class zerif_team_widget extends WP_Widget {

		private $form_tools;

		public function __construct() {
			$widget_ops = array( 'classname' => 'zerif_team', 'customize_selective_refresh' => true );

			parent::__construct( 'zerif_team-widget', 'Zerif - Team member widget', $widget_ops );
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


		public function widget( $args, $instance ) {

        extract($args);
		$zerif_accessibility = get_theme_mod( 'zerif_accessibility' );

		echo $before_widget; ?>

			<div class="col-lg-3 col-sm-3">

				<div class="team-member" tabindex="0">

					<?php

					$zerif_widget_image = '';

					if ( ! empty( $instance['image_uri'] ) && ( $instance['image_uri'] != 'Upload Image' ) ) {

						$zerif_widget_image = apply_filters( 'wpml_translate_single_string', $instance['image_uri'], 'Widgets' , $instance['image_uri']);

					} elseif ( ! empty( $instance['image_in_customizer'] ) ) {

						$zerif_widget_image = apply_filters( 'wpml_translate_single_string', $instance['image_in_customizer'], 'Widgets' , $instance['image_in_customizer']);

					}

					if ( !empty( $zerif_widget_image ) ) { ?>
					<figure class="profile-pic">
						<?php
						$ourteam_widget_image_alt = __( 'Team member', 'zerif' );
						if( !empty($instance['name']) ) {
							$ourteam_widget_image_alt = apply_filters( 'widget_title', $instance['name'] );
						} ?>
						<img src="<?php echo esc_url( $zerif_widget_image ); ?>" alt="<?php echo esc_html( $ourteam_widget_image_alt ); ?>">

					</figure>
					<?php } ?>


					<div class="social-icons">

						<ul>
							<?php
							$open_new_window = '';
							if(!empty($instance['open_new_window'])){
								$open_new_window = $instance['open_new_window'];
							}
							$zerif_socials = array(
								array(
									'link' => (!empty($instance['fb_link']) ? $instance['fb_link'] : ''),
									'label' => __( 'Facebook', 'zerif' ),
									'icon-class' => 'fa-facebook'
								),
								array(
									'link' => (!empty($instance['tw_link']) ? $instance['tw_link'] : ''),
									'label' => __( 'Twitter', 'zerif' ),
									'icon-class' => 'fa-twitter'
								),
								array(
									'link' => (!empty($instance['bh_link']) ? $instance['bh_link'] : ''),
									'label' => __( 'Behance', 'zerif' ),
									'icon-class' => 'fa-behance'
								),
								array(
									'link' => (!empty($instance['db_link']) ? $instance['db_link'] : ''),
									'label' => __( 'Dribbble', 'zerif' ),
									'icon-class' => 'fa-dribbble'
								),
								array(
									'link' => (!empty($instance['ln_link']) ? $instance['ln_link'] : ''),
									'label' => __( 'LinkedIn', 'zerif' ),
									'icon-class' => 'fa-linkedin'
								),
								array(
									'link' => (!empty($instance['gp_link']) ? $instance['gp_link'] : ''),
									'label' => __( 'Google Plus', 'zerif' ),
									'icon-class' => 'fa-google'
								),
								array(
									'link' => (!empty($instance['pinterest_link']) ? $instance['pinterest_link'] : ''),
									'label' => __( 'Pinterest', 'zerif' ),
									'icon-class' => 'fa-pinterest'
								),
								array(
									'link' => (!empty($instance['tumblr_link']) ? $instance['tumblr_link'] : ''),
									'label' => __( 'Tumblr', 'zerif' ),
									'icon-class' => 'fa-tumblr'
								),
								array(
									'link' => (!empty($instance['reddit_link']) ? $instance['reddit_link'] : ''),
									'label' => __( 'Reddit', 'zerif' ),
									'icon-class' => 'fa-reddit'
								),
								array(
									'link' => (!empty($instance['youtube_link']) ? $instance['youtube_link'] : ''),
									'label' => __( 'YouTube', 'zerif' ),
									'icon-class' => 'fa-youtube'
								),
								array(
									'link' => (!empty($instance['instagram_link']) ? $instance['instagram_link'] : ''),
									'label' => __( 'Instagram', 'zerif' ),
									'icon-class' => 'fa-instagram'
								),
								array(
									'link' => (!empty($instance['email_link']) ? $instance['email_link'] : ''),
									'label' => __( 'Email', 'zerif' ),
									'icon-class' => 'fa-envelope'
								),
								array(
									'link' => (!empty($instance['website_link']) ? $instance['website_link'] : ''),
									'label' => __( 'Website', 'zerif' ),
									'icon-class' => 'fa-globe'
								),
								array(
									'link' => (!empty($instance['phone_link']) ? $instance['phone_link'] : ''),
									'label' => __( 'Phone Number', 'zerif' ),
									'icon-class' => 'fa-phone'
								)
							);

							foreach ( $zerif_socials as $social ) {
								zerif_footer_social( $social['link'], $social['label'], $zerif_accessibility, $social['icon-class'], $open_new_window );
							} ?>

						</ul>

					</div>

					<?php if ( ! empty( $instance['description'] ) ):
						$zerif_widget_description = wp_kses_post( $instance['description'] );
						?>
                        <div class="member-details">					
                            <h5 class="dark-text red-border-bottom">
                                <?php 
                                if( !empty($instance['profile_link']) ){ ?>
                                    <a href="<?php echo apply_filters('widget_title', $instance['profile_link'] ); ?>">
                                        <?php
                                        if( isset($zerif_accessibility) && $zerif_accessibility == 1 ) { ?>
                                            <span class="screen-reader-text"><?php _e( 'Go to', 'zerif' ); ?> <?php echo apply_filters('widget_title', $instance['title']); ?></span>
                                            <?php
                                        }
                                        if( !empty($instance['name']) ){
                                            echo apply_filters('widget_title', $instance['name'] );
                                        } ?>
                                    </a>
                                    <?php 
                                } else {
                                    if ( ! empty( $instance['name'] ) ) {
                                        echo apply_filters( 'widget_title', $instance['name'] );
                                    }
                                }?>
                            </h5>
						      <div class="position"><?php if ( ! empty( $instance['position'] ) ): echo htmlspecialchars_decode( apply_filters( 'widget_title', $instance['position'] ) ); endif; ?></div>
					   </div>
						<div class="details">
							<?php echo htmlspecialchars_decode( apply_filters( 'widget_title', $zerif_widget_description ) ); ?>
						</div>
					<?php endif; ?>

				</div>

			</div>
			<?php

			echo $after_widget;

		}


		public function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['name'] = strip_tags( $new_instance['name'] );

			$instance['position'] = stripslashes( wp_filter_post_kses( $new_instance['position'] ) );

			$instance['description'] = stripslashes( wp_filter_post_kses( $new_instance['description'] ) );

			$instance['fb_link'] = strip_tags( $new_instance['fb_link'] );

			$instance['tw_link'] = strip_tags( $new_instance['tw_link'] );

			$instance['bh_link'] = strip_tags( $new_instance['bh_link'] );

			$instance['db_link'] = strip_tags( $new_instance['db_link'] );

			$instance['ln_link'] = strip_tags( $new_instance['ln_link'] );

			$instance['gp_link'] = strip_tags( $new_instance['gp_link'] );

			$instance['pinterest_link'] = strip_tags( $new_instance['pinterest_link'] );

			$instance['tumblr_link'] = strip_tags( $new_instance['tumblr_link'] );

			$instance['reddit_link'] = strip_tags( $new_instance['reddit_link'] );

			$instance['youtube_link'] = strip_tags( $new_instance['youtube_link'] );

			$instance['instagram_link'] = strip_tags( $new_instance['instagram_link'] );

			$instance['website_link'] = strip_tags( $new_instance['website_link'] );

			$instance['email_link'] = strip_tags( $new_instance['email_link'] );

			$instance['phone_link'] = strip_tags( $new_instance['phone_link'] );

			$instance['image_uri'] = strip_tags( $new_instance['image_uri'] );

			$instance['profile_link'] = strip_tags( $new_instance['profile_link'] );

			$instance['open_new_window'] = strip_tags( $new_instance['open_new_window'] );

			$instance['image_in_customizer'] = strip_tags( $new_instance['image_in_customizer'] );

			return $instance;

		}

		public function form( $instance ) {
			$form_tools = $this->form_tools;

			$form_tools->input_text( $instance, array(
				'sanitize'      => 'esc_html',
				'instance_name' => 'name',
				'label'         => __( 'Name', 'zerif' )
			) );

			$form_tools->input_text( $instance, array(
				'type'          => 'textarea',
				'instance_name' => 'position',
				'label'         => __( 'Position', 'zerif' )
			) );

			$form_tools->input_text( $instance, array(
				'type'          => 'textarea',
				'instance_name' => 'description',
				'label'         => __( 'Description', 'zerif' )
			) );

			$links = array(
				array( 'instance_name' => 'profile_link', 'label' => __( 'Profile link', 'zerif' ) ),
				array( 'instance_name' => 'fb_link', 'label' => __( 'Facebook link', 'zerif' ) ),
				array( 'instance_name' => 'tw_link', 'label' => __( 'Twitter link', 'zerif' ) ),
				array( 'instance_name' => 'bh_link', 'label' => __( 'Behance link', 'zerif' ) ),
				array( 'instance_name' => 'db_link', 'label' => __( 'Dribble link', 'zerif' ) ),
				array( 'instance_name' => 'ln_link', 'label' => __( 'Linkedin link', 'zerif' ) ),
				array( 'instance_name' => 'gp_link', 'label' => __( 'Google+ link', 'zerif' ) ),
				array( 'instance_name' => 'pinterest_link', 'label' => __( 'Pinterest link', 'zerif' ) ),
				array( 'instance_name' => 'tumblr_link', 'label' => __( 'Tumblr link', 'zerif' ) ),
				array( 'instance_name' => 'reddit_link', 'label' => __( 'Reddit link', 'zerif' ) ),
				array( 'instance_name' => 'youtube_link', 'label' => __( 'YouTube link', 'zerif' ) ),
				array( 'instance_name' => 'instagram_link', 'label' => __( 'Instagram link', 'zerif' ) ),
				array( 'instance_name' => 'email_link', 'label' => __( 'Email link', 'zerif' ) ),
				array( 'instance_name' => 'website_link', 'label' => __( 'Website link', 'zerif' ) ),
				array( 'instance_name' => 'phone_link', 'label' => __( 'Phone number', 'zerif' ) )
			);

			foreach ( $links as $link_input ) {
				$form_tools->input_text( $instance, array(
					'sanitize'      => ( $link_input['instance_name'] === 'phone_link' || $link_input['instance_name'] === 'email_link' ? 'esc_attr' : 'esc_url' ),
					'instance_name' => $link_input['instance_name'],
					'label'         => $link_input['label']
				) );
			}

			$form_tools->input_text( $instance, array(
				'type'          => 'checkbox',
				'instance_name' => 'open_new_window'
			) );

			$form_tools->image_control( $instance );
		}

	}
}