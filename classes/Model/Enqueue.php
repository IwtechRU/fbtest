<?php
declare(strict_types=1);

/**
 * Plugin Nikita Feedback Form Enqueue class.
 *
 * @package   NNikitaFeedBackPlugin
 * @author    Nikita Menshutin
 * @copyright Copyright © 2021, Nikita Menshutin
 */
namespace NikitaFeedBackPlugin\Model;

class Enqueue {
    /**
     * Enqueue script to HTML DOM
     * 
     * @return void
     */
    public static function enqueue() {

        wp_register_script( NIKITA_FEEDBACK__SLUG, NIKITA_FEEDBACK_JS, [ 'jquery' ], NIKITA_FEEDBACK__VERSION, true );
        wp_localize_script(
            NIKITA_FEEDBACK__SLUG,
            NIKITA_FEEDBACK__SLUG,
            [
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( NIKITA_FEEDBACK_PLUGIN_NAME ),
            ]
        );
        wp_enqueue_script( NIKITA_FEEDBACK__SLUG );
    }
}
