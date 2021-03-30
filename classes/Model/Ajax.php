<?php
declare(strict_types=1);

/**
 * Plugin Nikita Feedback Form Ajax response class.
 *
 * @package   NNikitaFeedBackPlugin
 * @author    Nikita Menshutin
 * @copyright Copyright © 2021, Nikita Menshutin
 */
namespace NikitaFeedBackPlugin\Model;

class Ajax {

    public static function ajaxForm() {
        if ( ! isset( $_POST['nonce'] ) ) {
            wp_send_json_error();
        }
        if ( ! wp_verify_nonce( wp_unslash( $_POST['nonce'] ), NIKITA_FEEDBACK_PLUGIN_NAME ) ) {
            die();
        }
//@todo
        wp_send_json_success( [ 1 ] );
    }
}
