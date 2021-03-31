<?php
declare(strict_types=1);
/**
 * Plugin Nikita Feedback Form Core hooks class.
 *
 * @package   NNikitaFeedBackPlugin
 * @author    Nikita Menshutin
 * @copyright Copyright © 2021, Nikita Menshutin
 */
namespace NikitaFeedBackPlugin\Controller;

use NikitaFeedBackPlugin\Controller\DB as DB;
class Core {
    public static function activate( $networkWide ) {
        self::tableCreate();
        if ( is_multisite() && $networkWide ) {
            foreach ( get_sites( [ 'fields' => 'ids' ] ) as $blogId ) {
                switch_to_blog( $blogId );
                self::tableCreate();
                restore_current_blog();
            }
        }
    }
    public static function tableCreate() {

        $res = DB::tableCreate(
            NIKITA_FEEDBACK__SLUG . 'emails',
            [
                'email varchar(320) NOT NULL',
                'ip varchar(45) NOT NULL',
                'useragent TEXT NOT NULL',
                'UNIQUE (email)',
            ]
        );
        if ( true === $res['success'] ) {
            update_option( NIKITA_FEEDBACK__SLUG . 'version', NIKITA_FEEDBACK__VERSION );
        }
    }

    public static function tableDrop() {
        $res = DB::tableDrop(
            NIKITA_FEEDBACK__SLUG . 'emails',
        );
        delete_option( NIKITA_FEEDBACK__SLUG . 'version' );
    }

    public static function deactivate( $networkWide ) {
        if ( is_multisite() && $networkWide ) {
            foreach ( get_sites( [ 'fields' => 'ids' ] ) as $blogId ) {
                switch_to_blog( $blogId );
                self::tableDrop();
                restore_current_blog();
            }
        }
    }
}
