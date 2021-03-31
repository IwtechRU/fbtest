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

use NikitaFeedBackPlugin\Controller\DB as DB;
class Ajax {

    public static function ajaxForm() {
        if ( ! isset( $_POST['nonce'] ) ) {
            wp_send_json_error();
        }
        if ( ! wp_verify_nonce( wp_unslash( $_POST['nonce'] ), NIKITA_FEEDBACK_PLUGIN_NAME ) ) {
            die();
        }
        if ( ! filter_var( $_POST['formData']['email'], FILTER_VALIDATE_EMAIL ) ) {
            wp_send_json_error( __( 'Invalid e-mail address', NIKITA_FEEDBACK__SLUG ) );
        }
        $res = DB::insert(
            NIKITA_FEEDBACK_EMAILSTABLE,
            [
                'email'     => $_POST['formData']['email'],
                'useragent' => (string) $_POST['agent'],
                'ip'        => $_SERVER['REMOTE_ADDR'],
            ]
        );

        if ( ! $res['success'] ) {
            if ( 0 === strpos( $res['result'], 'Duplicate entry' ) ) {
                wp_send_json_error( sprintf( __( 'Email %s already exists', NIKITA_FEEDBACK__SLUG ), $_POST['formData']['email'], ) );
            }
            wp_send_json_error( __( 'Some internal error, won\'t tell you which' ), NIKITA_FEEDBACK__SLUG );
        }
        wp_send_json_success( __( 'Thank you very much!', NIKITA_FEEDBACK__SLUG ) );
    }
}
