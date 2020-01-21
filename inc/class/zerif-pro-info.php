<?php
/**
 * Class to display upsells.
 *
 * @package WordPress
 * @subpackage Zerif Pro
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return;
}

/**
 * Class Zerif_Pro_Info
 */
class Zerif_Pro_Info extends WP_Customize_Control {

    /**
     * The type of customize section being rendered.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $type = 'info';

    /**
     * Control label
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $label = '';

    /**
     * The render function for the controler
     */
    public function render_content() {
        $links = array(
            array(
                'name' => __( 'View Documentation','zerif' ),
                'link' => esc_url( 'http://docs.themeisle.com/article/87-zerif-pro-documentation' ),
            ),
            array(
                'name' => __( 'View Theme Info','zerif' ),
                'link' => esc_url( admin_url( 'themes.php?page=zerif-pro-welcome#actions_required' ) )
            ),
            array(
                'name' => __( 'View Demo','zerif' ),
                'link' => esc_url( 'https://themeisle.com/demo/?theme=Zerif%20Pro' ),
            )
        ); ?>


        <div class="zerif-theme-info">
            <?php
            foreach ( $links as $item ) {  ?>
                <a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank"><?php echo esc_html( $item['name'] ); ?></a>
                <hr/>
                <?php
            } ?>
        </div>
        <?php
    }
}