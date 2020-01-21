<?php

/**

 * The Header for our theme.

 *

 * Displays all of the <head> section and everything up till <div id="content">

 *

 * @package zerif

 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<?php zerif_top_head_trigger(); ?>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    
<link rel="stylesheet" type="text/css" href="<?php echo get_site_url(); ?>/wp-content/themes/zerif-pro-child/style.css">
    
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet"> 

<?php wp_head(); ?>

<?php zerif_bottom_head_trigger(); ?>

</head>
<?php if(isset($_POST['scrollPosition'])): ?>

		<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage" onLoad="window.scrollTo(0,<?php echo absint($_POST['scrollPosition']); ?>)">
			<?php
			$zerif_accessibility = get_theme_mod('zerif_accessibility');
			if(isset($zerif_accessibility) && $zerif_accessibility == 1) { ?>
				<a class="skip-link screen-text-reader" href="#content"><?php esc_html_e( 'Skip to content', 'zerif' ); ?></a>
				<?php
			}
			?>
			<?php else: ?>

		<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
			<?php
			$zerif_accessibility = get_theme_mod('zerif_accessibility');
			if(isset($zerif_accessibility) && $zerif_accessibility == 1) { ?>
				<a class="skip-link screen-text-reader" href="#content"><?php esc_html_e( 'Skip to content', 'zerif' ); ?></a>
				<?php
			}
			?>

<?php endif;

zerif_top_body_trigger();

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

	$count_slides = 0;

	if( !empty($zerif_slides_array) && is_home() ):

		echo '<div class="zerif_full_site_wrap">';

		echo '<div class="fadein-slider">';

		foreach( $zerif_slides_array as $key => $zerif_slide ):

			if ( !empty($zerif_slide) ):

				$keyx = $key+1;
				$zerif_vpos = get_theme_mod('zerif_vposition_bgslider_'.$keyx,'top');
				$zerif_hpos = get_theme_mod('zerif_hposition_bgslider_'.$keyx,'left');
				$zerif_bgsize = get_theme_mod('zerif_bgsize_bgslider_'.$keyx,'cover');
				if ($zerif_bgsize=='width'):
					$zerif_bgsize = '100% auto';
				elseif ($zerif_bgsize=='height'):
					$zerif_bgsize = 'auto 100%';
				endif;

				$zerif_slide_style ='background-repeat:no-repeat;background-position:'.$zerif_hpos.' '.$zerif_vpos.';background-size:'.$zerif_bgsize;

				echo '<div class="slide-item" style="background-image:url('.esc_url($zerif_slide).');'.esc_html($zerif_slide_style).'"></div>';

			endif;

		endforeach;

		echo '</div>';

		echo '<div class="zerif_full_site">';

	endif;

elseif( $zerif_background_settings == 'zerif-background-video' ):

	/* Video background */
	$zerif_background_video = get_theme_mod('zerif_background_video');

	$zerif_enable_video_sound = get_theme_mod('zerif_enable_video_sound');

	/* enable video sound */
	if( isset($zerif_enable_video_sound) && ($zerif_enable_video_sound == 1)) {
		$zerif_video_sound = '';
	} else {
		$zerif_video_sound = ' muted';
	}

	if( !empty($zerif_background_video) && is_home() ):

		$zerif_background_video_thumbnail = get_theme_mod('zerif_background_video_thumbnail');

		if( !wp_is_mobile() ) {

			if( !empty($zerif_background_video_thumbnail) ):

				echo '<video class="zerif_video_background" loop autoplay preload="auto" controls="true" poster="'.esc_url($zerif_background_video_thumbnail).'" '.esc_html($zerif_video_sound).'>';

			else:

				echo '<video class="zerif_video_background" loop autoplay preload="auto" controls="true" '.esc_html($zerif_video_sound).'>';

			endif;

			echo '<source src="'.esc_url($zerif_background_video).'" type="video/mp4" />';
			echo '</video>';

		} else {

			echo '<div class="zerif_full_site_wrap">';

			echo '<div class="fadein-slider">';

			if( !empty($zerif_background_video_thumbnail) ) {

				echo '<div class="slide-item" style="background-image:url('.esc_url($zerif_background_video_thumbnail).')"></div>';

			} else {

				$page_bg_image_url = get_background_image();

				if ( !empty( $page_bg_image_url ) ) {

					$page_bg_image_url = get_background_image();

					echo '<div class="slide-item" style="background-image:url('.esc_url($page_bg_image_url).')"></div>';

				}
			}

			echo '</div>';

			echo '<div class="zerif_full_site">';

		}
	endif;

else:
?>

<?php if( is_home() ): ?>

<div id="mobile-bg-responsive" class="zerif-mobile-bg-helper-wrap-all">
	<div class="zerif-mobile-bg-helper-bg"><div class="zerif-mobile-bg-helper-bg-inside"></div></div>
	<div class="zerif-mobile-bg-helper-content">

<?php endif; ?>

<?php

endif;

?>
		<!-- =========================

		   PRE LOADER

		============================== -->
		<?php

		 if(is_front_page() && !is_customize_preview()):

			$zerif_disable_preloader = get_theme_mod('zerif_disable_preloader');

			if( isset($zerif_disable_preloader) && ($zerif_disable_preloader != 1)):

				echo '<div class="preloader">';

					echo '<div class="status">&nbsp;</div>';

				echo '</div>';

			endif;

		endif; ?>

		<?php zerif_before_header_trigger(); ?>

		<header id="<?php echo apply_filters( 'zerif_header_id_filter','home' ); ?>" class="<?php echo apply_filters('zerif_header_class_filter','header'); ?>" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

			<?php zerif_top_header_trigger(); ?>

			<div id="main-nav" class="navbar navbar-inverse bs-docs-nav">

				<div class="container">

					<div class="navbar-header responsive-logo">

						<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">

						<span class="screen-reader-text"><?php esc_html_e('Menu','zerif'); ?></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						</button>



						<?php

						$logo = get_theme_mod ( 'custom_logo' );

						$zerif_logo = wp_get_attachment_image_url( $logo, 'full' ); ?>

						<div class="navbar-brand">

							<?php if( ! empty( $zerif_logo ) ) : ?>

								<a href="<?php echo esc_url( home_url( '/' ) ) ?> ">

									<?php

									echo '<img src="'.esc_url( $zerif_logo ).'" alt="'.esc_attr( get_bloginfo('title') ).'">';

									?>

								</a>

								<?php

							else:

								?>
								<div class="site-title-tagline-wrapper">
									<h1 class="site-title">
										<a href=" <?php echo esc_url( home_url( '/' ) ) ?> ">
											<?php bloginfo( 'title' ) ?>
										</a>
									</h1>

									<?php

									$description = get_bloginfo( 'description', 'display' );

									if ( ! empty( $description ) ) : ?>

										<p class="site-description">

											<?php echo $description; ?>

										</p> <!-- /.site-description -->

									<?php elseif( is_customize_preview() ): ?>

										<p class="site-description"></p>

									<?php endif; ?>

								</div> <!-- /.site-title-tagline-wrapper -->

							<?php endif; ?>

						</div> <!-- /.navbar-brand -->

					</div> <!-- /.navbar-header -->

					<?php
					$zerif_accessibility = get_theme_mod('zerif_accessibility');
					if(isset($zerif_accessibility) && $zerif_accessibility == 1){ ?>
						<div class='primary-menu'>
							<?php
							/*
							 * Aria Label: Provides a label to differentiate multiple navigation landmarks
							 * hidden heading: provides navigational structure to site for scanning with screen reader
							 */
							zerif_primary_navigation_accessibility_trigger();
							?>
						</div>
						<?php
					} else {
						zerif_primary_navigation_trigger();
					} ?>




				</div>

			</div>
			<?php zerif_bottom_header_trigger(); ?>
			<!-- / END TOP BAR -->
