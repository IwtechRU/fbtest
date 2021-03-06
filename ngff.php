<?php
/**
 * Plugin Name:         FeedBack Form Nikita's test assignment
 * Plugin URI:
 * Description:         Collects users data: email, user agent, IP address
 * Version:             1.0
 * Requires at least:   4.0
 * Requires PHP:        7.2
 * Author:              Nikita Menshutin
 * Text Domain:         nfbp
 *
 * Copyright: © N
 *
 * @package   NikitaFeedBackPlugin
 * @author    Nikita Menshutin
 * @copyright Copyright © 2021
 */

/** Prevent default call */
if ( ! function_exists( 'add_action' ) ) {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

define( 'NIKITA_FEEDBACK__VERSION', time() );
define( 'NIKITA_FEEDBACK__SLUG', 'nfbp' );
define( 'NIKITA_FEEDBACK_JS', plugin_dir_url( __FILE__ ) . '/dist/main.js' );
define( 'NIKITA_FEEDBACK_PLUGIN_NAME', 'NIKITA_FEEDBACK_PLUGIN_NAME' );
define( 'NIKITA_FEEDBACK_EMAILSTABLE', NIKITA_FEEDBACK__SLUG . 'emails' );
new NikitaFeedBackPlugin\View\Shortcodes();
register_activation_hook( __FILE__, [ 'NikitaFeedBackPlugin\Controller\Core', 'activate' ] );
/** Comment the line below if you want to keep data when plugin is deactivated. */
register_deactivation_hook( __FILE__, [ 'NikitaFeedBackPlugin\Controller\Core', 'deactivate' ] );
add_action( 'wp_enqueue_scripts', [ 'NikitaFeedBackPlugin\Model\Enqueue', 'enqueue' ] );
add_action( 'wp_ajax_nfbpForm', [ 'NikitaFeedBackPlugin\\Model\Ajax', 'ajaxForm' ] );
add_action( 'wp_ajax_nopriv_nfbpForm', [ 'NikitaFeedBackPlugin\Model\Ajax', 'ajaxForm' ] );
