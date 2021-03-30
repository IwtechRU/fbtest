<?php
/**
 * Plugin Name:         FeedBack Form Nikita's test assignment
 * Plugin URI:
 * Description:         Collects users data: email, user agent, IP address
 * Version:             1.0
 * Requires at least:   4.0
 * Requires PHP:        7.2
 * Author:              Nikita Menshutin
 * Text Domain:         nikita-feedback-form
 *
 * Copyright: © NS Media Group
 *
 * @package   NikitaFeedBackPlugin
 * @author    Nikita Menshutin
 * @copyright Copyright © 2021, NS Media Group
 */

/** Prevent default call */
if ( ! function_exists( 'add_action' ) ) {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

define( 'NIKITA_FEEDBACK__VERSION', '1.5' );
define( 'NIKITA_FEEDBACK__SLUG', 'nikitafeedbackplugin' );
define( 'NIKITA_FEEDBACK_JS', plugin_dir_url( __FILE__ ) . '/dist/main.js' );
define( 'NIKITA_FEEDBACK_PLUGIN_NAME', 'NIKITA_FEEDBACK_PLUGIN_NAME' );
add_action( 'wp_enqueue_scripts', [ 'NikitaFeedBackPlugin\View\Enqueue', 'enqueue' ] );
add_action( 'wp_ajax_nfbpForm', [ 'NikitaFeedBackPlugin\Ajax', 'ajaxForm' ] );
add_action( 'wp_ajax_nopriv_nfbpForm', [ 'NikitaFeedBackPlugin\Ajax', 'ajaxForm' ] );