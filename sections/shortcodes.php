<?php
$zerif_shortcodes_show  =   get_theme_mod('zerif_shortcodes_show');
$zerif_shortcodes_section   =   get_theme_mod( 'zerif_shortcodes_settings' );
if(!empty($zerif_shortcodes_section)) {
	$zerif_shortcodes_section_decoded   = json_decode( $zerif_shortcodes_section, 'true' );
}

if( isset($zerif_shortcodes_show) && $zerif_shortcodes_show != 1 ) { ?>
	<div class="zerif_shortcodes" id="shortcodes-section">
<?php
} else {
	if( is_customize_preview() ) { ?>
		<div class="zerif_shortcodes zerif_hidden_if_not_customizer" id="shortcodes">
		<?php
	}
}

if(( isset($zerif_shortcodes_show) && $zerif_shortcodes_show != 1 ) || is_customize_preview() ) {
	if ( ! empty( $zerif_shortcodes_section_decoded ) ) {
		foreach ( $zerif_shortcodes_section_decoded as $zerif_shortcode_box ) {
			$title     = ! empty( $zerif_shortcode_box['title'] ) ? apply_filters( 'wpml_translate_single_string', $zerif_shortcode_box['title'], 'Shortcodes section', $zerif_shortcode_box['title'] ) : '';
			$subtitle  = ! empty( $zerif_shortcode_box['subtitle'] ) ? apply_filters( 'wpml_translate_single_string', $zerif_shortcode_box['subtitle'], 'Shortcodes section', $zerif_shortcode_box['subtitle'] ) : '';
			$shortcode = ! empty( $zerif_shortcode_box['shortcode'] ) ? apply_filters( 'wpml_translate_single_string', $zerif_shortcode_box['shortcode'], 'Shortcodes section', $zerif_shortcode_box['shortcode'] ) : ''; ?>
            <section class="shortcodes"
                     id="<?php echo( ! empty( $zerif_shortcode_box['id'] ) ? esc_html( $zerif_shortcode_box['id'] ) : '' ); ?>">
                <div class="container">
                    <div class="section-header">
                        <h2 class="dark-text"><?php echo( ! empty( $title ) ? wp_kses_post( $title ) : '' ); ?></h2>
                        <h6><?php echo( ! empty( $subtitle ) ? wp_kses_post( $subtitle ) : '' ); ?></h6>
                    </div>

                    <div class="row" data-scrollreveal="enter left after 0s over 2s">
						<?php
						if ( ! empty( $shortcode ) ) {
							$scd = html_entity_decode( $shortcode );
							if ( ! empty( $scd ) ) {
								echo do_shortcode( $scd );
							}
						}
						?>
                    </div>
                </div>
            </section>

			<?php
		}
	}?>
		</div>
		<?php
} ?>

