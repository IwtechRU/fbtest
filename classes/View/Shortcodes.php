<?php
declare(strict_types=1);

/**
 * Plugin Nikita Feedback Form Shortcodes class.
 *
 * @package   NNikitaFeedBackPlugin
 * @author    Nikita Menshutin
 * @copyright Copyright © 2021, Nikita Menshutin
 */
namespace NikitaFeedBackPlugin\View;

class Shortcodes {

    /**
     * Iterate methods and register shortcodes.
     * If need more, just add method with sc prefix.
     *
     * @return void
     */
    function __construct() {
        $this->initShortCodes( get_class_methods( $this ) );
    }

    /**
     * Register shortcodes
     *
     * @param array $methods methods of the entire class.
     *
     * @return void
     */
    private function initShortCodes( $methods ) {
        if ( ! is_array( $methods ) || [] === $methods ) {
            return;
        }
        foreach ( $methods as $method ) {
            if ( 0 !== strpos( $method, 'sc' ) ) {
                continue;
            }
            $code = preg_replace( '/^sc/', 'nfbp', $method );
            add_shortcode( $code, [ $this, $method ] );
        }
    }

    /**
     * Register form shortcode
     *
     * @param string|array $atts attributes
     *
     * @return void
     */
    public function scForm( $atts ) {
            $atts = array_merge(
                '' === (string) $atts ? [] : $atts,
                [
                    'class'       => '',
                    'emailLabel'  => __( 'E-mail', 'nfbp' ),
                    'submitLabel' => __( 'Submit', 'nfbp' ),
                ]
            );
            $out  = '<form name="" method="post" class="' . 'nfbp' . '">';
            $out .= '<label>';
            $out .= $atts['emailLabel'];
            $out .= '<input name="email" type="email" value="" required="">';
            $out .= '</label>';
            $out .= '<input type="submit" value="' . $atts['submitLabel'] . '">';
            $out .= '</form>';
            return $out;
    }
}
