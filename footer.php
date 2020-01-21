<?php

/**

 * The template for displaying the footer.

 *

 * Contains the closing of the #content div and all content after

 *

 * @package zerif

 */

?>

<?php zerif_before_footer_trigger(); ?>

<footer id="footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

<div class="container">
	<?php zerif_top_footer_trigger(); ?>

	<?php
		
		$footer_sections = 0;
	
		$zerif_address = get_theme_mod( 'zerif_address',apply_filters( 'zerif_address_default_filter',__('Company address','zerif') ) );
		$zerif_address_icon = get_theme_mod( 'zerif_address_icon',apply_filters( 'zerif_address_icon_default_filter', get_template_directory_uri().'/images/map25-redish.png' ) );
		
		$zerif_email = get_theme_mod( 'zerif_email',apply_filters( 'zerif_email_default_filter','<a href="mailto:contact@site.com">contact@site.com</a>' ) );
		$zerif_email_icon = get_theme_mod( 'zerif_email_icon',apply_filters( 'zerif_email_icon_default_filter',get_template_directory_uri().'/images/envelope4-green.png' ) );
		
		$zerif_phone = get_theme_mod( 'zerif_phone',apply_filters( 'zerif_phone_default_filter','<a href="tel:0 332 548 954">0 332 548 954</a>' ) );
		$zerif_phone_icon = get_theme_mod( 'zerif_phone_icon',apply_filters( 'zerif_phone_icon_default_filter',get_template_directory_uri().'/images/telephone65-blue.png' ) );
		
		$zerif_socials_facebook = get_theme_mod( 'zerif_socials_facebook','#' );

		$zerif_socials_twitter = get_theme_mod( 'zerif_socials_twitter','#' );

		$zerif_socials_linkedin = get_theme_mod( 'zerif_socials_linkedin','#' );

		$zerif_socials_behance = get_theme_mod( 'zerif_socials_behance','#' );

		$zerif_socials_dribbble = get_theme_mod( 'zerif_socials_dribbble','#' );
		
		$zerif_socials_reddit = get_theme_mod( 'zerif_socials_reddit' );
		
		$zerif_socials_tumblr = get_theme_mod( 'zerif_socials_tumblr' );
		
		$zerif_socials_pinterest = get_theme_mod( 'zerif_socials_pinterest' );
		
		$zerif_socials_googleplus = get_theme_mod( 'zerif_socials_googleplus' );
		
		$zerif_socials_youtube = get_theme_mod( 'zerif_socials_youtube' );
		
		$zerif_socials_instagram = get_theme_mod( 'zerif_socials_instagram' );
			
		$zerif_copyright = get_theme_mod( 'zerif_copyright' );
		
		
		if(!empty($zerif_address) || !empty($zerif_address_icon)):
			$footer_sections++;
		endif;
		
		if(!empty($zerif_email) || !empty($zerif_email_icon)):
			$footer_sections++;
		endif;
		
		if(!empty($zerif_phone) || !empty($zerif_phone_icon)):
			$footer_sections++;
		endif;

		if(!empty($zerif_socials_facebook) || !empty($zerif_socials_twitter) || !empty($zerif_socials_linkedin) || !empty($zerif_socials_behance) || !empty($zerif_socials_youtube) || !empty($zerif_socials_dribbble) || !empty($zerif_socials_reddit) || !empty($zerif_socials_tumblr) || !empty($zerif_socials_pinterest) || !empty($zerif_socials_googleplus) || !empty($zerif_socials_instagram) || !empty($zerif_copyright)):
			$footer_sections++;
		endif;
		
		if( $footer_sections == 1 ):
			$footer_class = 'col-md-12 footer-box one-cell';
		elseif( $footer_sections == 2 ):
			$footer_class = 'col-md-6 footer-box two-cell';
		elseif( $footer_sections == 3 ):
			$footer_class = 'col-md-4 footer-box three-cell';
		elseif( $footer_sections == 4 ):
			$footer_class = 'col-md-3 footer-box four-cell';
		else:
			$footer_class = 'col-md-3 footer-box four-cell';
		endif;
		
		global $wp_customize; ?>


	<div class="footer-box-wrap">
		<?php
		if( !empty($footer_class) ) {
			
			/* COMPANY ADDRESS */
			if( ! empty( $zerif_address_icon ) || ! empty( $zerif_address ) ) {

				echo '<div class="' . esc_html( $footer_class ) . ' company-details">';
					
					if( ! empty( $zerif_address_icon ) ) {

						$zerif_address_icon_alt = '';

						$zerif_address_icon_alt = get_post_meta( attachment_url_to_postid( $zerif_address_icon ), '_wp_attachment_image_alt', true );

						echo '<div class="icon-top red-text">';
							 echo '<img src="' . esc_url( $zerif_address_icon ) . '" alt="' . esc_attr( $zerif_address_icon_alt ) . '" />';
						echo '</div>';
					}
					
					if( ! empty( $zerif_address ) ) {
						echo '<div class="zerif-footer-address">';
							echo wp_kses_post( $zerif_address );
						echo '</div>';
					} else if( is_customize_preview() ) {
						echo '<div class="zerif-footer-address zerif_hidden_if_not_customizer"></div>';
					}
					
				echo '</div>';

			}
			
			/* COMPANY EMAIL */
			if( ! empty( $zerif_email_icon ) || ! empty( $zerif_email ) ) {

				echo '<div class="' . esc_html( $footer_class ) . ' company-details">';
				
					if( ! empty( $zerif_email_icon ) ) {

						$zerif_email_icon_alt = '';

						$zerif_email_icon_alt = get_post_meta( attachment_url_to_postid( $zerif_email_icon ), '_wp_attachment_image_alt', true );

						echo '<div class="icon-top green-text">';
							echo '<img src="' . esc_url( $zerif_email_icon ) . '" alt="' . esc_attr( $zerif_email_icon_alt ) . '" />';
						echo '</div>';
					}
					if( ! empty( $zerif_email ) ) {
						echo '<div class="zerif-footer-email">';	
							echo wp_kses_post( $zerif_email );
						echo '</div>';
					} else if( is_customize_preview() ) {
						echo '<div class="zerif-footer-email zerif_hidden_if_not_customizer"></div>';
					}	
				
				echo '</div>';

			}
			
			/* COMPANY PHONE NUMBER */
			if( ! empty( $zerif_phone_icon ) || ! empty( $zerif_phone ) ) {

				echo '<div class="' . esc_html( $footer_class ) . ' company-details">';
				
					if( ! empty( $zerif_phone_icon ) ) {

						$zerif_phone_icon_alt = '';

						$zerif_phone_icon_alt = get_post_meta( attachment_url_to_postid( $zerif_phone_icon ), '_wp_attachment_image_alt', true );

						echo '<div class="icon-top blue-text">';
							echo '<img src="' . esc_url ( $zerif_phone_icon ) . '" alt="' . esc_attr( $zerif_phone_icon_alt ) . '" />';
						echo '</div>';
					}
					if( ! empty( $zerif_phone ) ) {
						echo '<div class="zerif-footer-phone">';
							echo wp_kses_post( $zerif_phone );
						echo '</div>';	
					} else if( is_customize_preview() ) {
						echo '<div class="zerif-footer-phone zerif_hidden_if_not_customizer"></div>';
					}
					
				echo '</div>';

			}
		}


		$zerif_socials = array(
			array(
				'link' => (!empty($zerif_socials_facebook) ? $zerif_socials_facebook : ''),
				'label' => esc_html__('Facebook link','zerif'),
				'icon-class' => 'fa-facebook'
			),
			array(
				'link' => (!empty($zerif_socials_twitter) ? $zerif_socials_twitter : ''),
				'label' => esc_html__('Twitter link','zerif'),
				'icon-class' => 'fa-twitter'
			),
			array(
				'link' => (!empty($zerif_socials_linkedin) ? $zerif_socials_linkedin : ''),
				'label' => esc_html__('Linkedin link','zerif'),
				'icon-class' => 'fa-linkedin'
			),
			array(
				'link' => (!empty($zerif_socials_behance) ? $zerif_socials_behance : ''),
				'label' => esc_html__('Behance link','zerif'),
				'icon-class' => 'fa-behance'
			),
			array(
				'link' => (!empty($zerif_socials_dribbble) ? $zerif_socials_dribbble : ''),
				'label' => esc_html__('Dribbble link','zerif'),
				'icon-class' => 'fa-dribbble'
			),
			array(
				'link' => (!empty($zerif_socials_googleplus) ? $zerif_socials_googleplus : ''),
				'label' => esc_html__('Google Plus link','zerif'),
				'icon-class' => 'fa-google'
			),
			array(
				'link' => (!empty($zerif_socials_pinterest) ? $zerif_socials_pinterest : ''),
				'label' => esc_html__('Pinterest link','zerif'),
				'icon-class' => 'fa-pinterest'
			),
			array(
				'link' => (!empty($zerif_socials_tumblr) ? $zerif_socials_tumblr : ''),
				'label' => esc_html__('Tumblr link','zerif'),
				'icon-class' => 'fa-tumblr'
			),
			array(
				'link' => (!empty($zerif_socials_reddit) ? $zerif_socials_reddit : ''),
				'label' => esc_html__('Reddit link','zerif'),
				'icon-class' => 'fa-reddit'
			),
			array(
				'link' => (!empty($zerif_socials_youtube) ? $zerif_socials_youtube : ''),
				'label' => esc_html__('Youtube link','zerif'),
				'icon-class' => 'fa-youtube'
			),
			array(
				'link' => (!empty($zerif_socials_instagram) ? $zerif_socials_instagram : ''),
				'label' => esc_html__('Instagram link','zerif'),
				'icon-class' => 'fa-instagram'
			),
		);

		$zerif_check_social = zerif_empty_socials($zerif_socials);
		if(!$zerif_check_social || !empty($zerif_copyright) ) { ?>
			<div class="<?php echo esc_html( $footer_class ); ?> copyright">
				<?php
				if ( ! $zerif_check_social ) {
					$zerif_accessibility = get_theme_mod( 'zerif_accessibility' ); ?>
					<ul class="social">
						<?php
						foreach ( $zerif_socials as $social ) {
							zerif_footer_social( $social['link'], $social['label'], $zerif_accessibility, $social['icon-class'], '' );
						} ?>
					</ul>
					<?php
				}

				if ( ! empty( $zerif_copyright ) ) { ?>
					<p id="zerif-copyright">
						<?php echo wp_kses_post( $zerif_copyright ); ?>
					</p>
					<?php
				} else {
					if ( is_customize_preview() ) { ?>
						<p id="zerif-copyright" class="zerif_hidden_if_not_customizer"></p>
						<?php
					}
				} ?>
			</div>
			<?php
		} else {
			if ( is_customize_preview() ) { ?>
				<div class="<?php echo esc_html( $footer_class ); ?> copyright zerif_hidden_if_not_customizer">
					<ul class="social zerif_hidden_if_not_customizer"></ul>
					<p id="zerif-copyright" class="zerif_hidden_if_not_customizer"></p>
				</div>
				<?php
			}
		} ?>
	</div>

	<?php zerif_bottom_footer_trigger(); ?>
</div> <!-- / END CONTAINER -->

</footer> <!-- / END FOOOTER  -->

<?php zerif_after_footer_trigger(); ?>

<?php if ( wp_is_mobile() ) : ?>

	<!-- reduce heigt of the google maps on mobile -->
	<style type="text/css">
		#map,
		.zerif_google_map {
			height: 300px !important;
		}
	</style>

<?php endif;

	/*************************************************/
	/**************  Background settings *************/
	/*************************************************/

	$zerif_background_settings = get_theme_mod('zerif_background_settings');

	/* Default case when no setting is checked or Slider is selected */
	if( empty($zerif_background_settings) || ($zerif_background_settings == 'zerif-background-slider') ):

		/* Background slider */
		$zerif_slides_array = array();

		for ($i=1; $i<=3; $i++){
			$zerif_bgslider = get_theme_mod('zerif_bgslider_'.$i);
			array_push($zerif_slides_array, $zerif_bgslider);
		}

		if( !empty($zerif_slides_array) && is_home() ):

			echo '</div><!-- .zerif_full_site -->';

			echo '</div><!-- .zerif_full_site_wrap -->';

		endif;

	elseif( $zerif_background_settings == 'zerif-background-video' ):

		/* Video background */
		$zerif_background_video = get_theme_mod('zerif_background_video');

		if( !empty($zerif_background_video) && is_home() ):

			$zerif_background_video_thumbnail = get_theme_mod('zerif_background_video_thumbnail');

			if( wp_is_mobile() ) {

				echo '</div><!-- .zerif_full_site -->';

				echo '</div><!-- .zerif_full_site_wrap -->';

			}
		endif;

	else:
	
		if( is_home() ):
		
			echo '</div><!-- .zerif-mobile-bg-helper-content -->';

			echo '</div><!-- .zerif-mobile-bg-helper-wrap-all -->';
	
		endif;
		
	endif;
	
	wp_footer();
	
	zerif_bottom_body_trigger();

/* Google analytics code */
$zerif_google_anaytics = get_theme_mod('zerif_google_anaytics');
if( !empty($zerif_google_anaytics) ) {
	if( substr( $zerif_google_anaytics, 0, 7 ) === '<script' ) {
		echo $zerif_google_anaytics;
	}
}
?>

</body>

</html>