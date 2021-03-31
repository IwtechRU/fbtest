<?php
declare(strict_types=1);

/**
 * Plugin Nikita Feedback Form Ajax response class.
 *
 * @package   NNikitaFeedBackPlugin
 * @author    Nikita Menshutin
 * @copyright Copyright © 2021, Nikita Menshutin
 */
namespace NikitaFeedBackPlugin\Controller;

class DB {

    private static $wpdb = null;
    private static function DB() {
        if ( null === self::$wpdb ) {
            global $wpdb;
            self::$wpdb = $wpdb;
        }
        return self::$wpdb;
    }

    public static function query( $query ) {
        if ( ! $query = self::DB()->prepare( $query ) ) {
            return self::fail( 'Invalid request' );
        }
        $result = self::DB()->query( $query );
        if ( ! $result ) {
            return self::fail( self::DB()->last_error );
        }
        return self::success( $result );
    }

    public static function tableCreate( $tableName, $cols ) {
        $table           = self::DB()->prefix . $tableName;
        $charset         = self::DB()->get_charset_collate();
        $charset_collate = self::DB()->get_charset_collate();
        $query           = "CREATE TABLE IF NOT EXISTS $table (
             " . implode( ', ', $cols ) . "
        ) $charset_collate;";
        return self::query( $query );
    }

    public static function tableDrop( $tableName ) {

        $table = self::DB()->prefix . $tableName;
        $query = "DROP TABLE IF EXISTS $table";
        return self::query( $query );
    }

    public static function fail( $msg ) {
        return [
            'success' => false,
            'result'  => $msg,
        ];
    }

    public static function success( $msg ) {
        return [
            'success' => true,
            'result'  => $msg,
        ];
    }

}
