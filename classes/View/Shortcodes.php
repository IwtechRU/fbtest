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

    function __construct() {
        $this->initShortCodes( get_class_methods( $this ) );
    }

    private function initShortCodes( $methods ) {
        if ( ! is_array( $methods ) || [] === $methods ) {
            return;
        }
        foreach ( $methods as $method ) {
            if ( 0 !== strpos( $method, 'sc' ) ) {
                continue;
            }
            $code = preg_replace( '/^sc/', NIKITA_FEEDBACK__SLUG, $method );
            add_shortcode( $code, [ $this, $method ] );
        }
    }

    public function scForm( $atts ) {
            $atts = array_merge(
                '' == $atts ? [] : $atts,
                [
                    'class'       => '',
                    'emailLabel'  => __( 'E-mail', NIKITA_FEEDBACK__SLUG ),
                    'submitLabel' => __( 'Submit', NIKITA_FEEDBACK__SLUG ),
                ]
            );
            $out  = '<form name="" method="post" class="' . NIKITA_FEEDBACK__SLUG . '">';
            $out .= '<label>';
            $out .= $atts['emailLabel'];
            $out .= '<input name="email" type="email" value="" required="">';
            $out .= '</label>';
            $out .= '<input type="submit" value="' . $atts['submitLabel'] . '">';
            $out .= '</form>';
            return $out;
    }
}
