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

    /**
     * Process ajax hook.
     * 1. Validate nonce.
     * 2. Validate email.
     * 3. Insert data to DB.
     * 4. See the SQL result and send json success or error message.
     *
     * @return void
     */
    public static function ajaxForm() {
        if ( ! isset( $_POST['nonce'] ) ) {
            wp_send_json_error();
        }
        if ( ! wp_verify_nonce( wp_unslash( $_POST['nonce'] ), (string) NIKITA_FEEDBACK_PLUGIN_NAME ) ) {
            die();
        }
        if ( ! filter_var( $_POST['formData']['email'], FILTER_VALIDATE_EMAIL ) ) {
            wp_send_json_error( __( 'Invalid e-mail address', 'nfbp' ) );
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
                wp_send_json_error(
                /* translators: %s: email */
                    sprintf( __( 'Email %s already exists', 'nfbp' ), (string) $_POST['formData']['email'] )
                );
            }
            wp_send_json_error( __( 'Some internal error, won\'t tell you which' ), 'nfbp' );
        }
        wp_send_json_success( __( 'Thank you very much!', 'nbp' ) );
    }
}
