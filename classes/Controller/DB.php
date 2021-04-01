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
    /**
     * Init Database class if not inited.
     *
     * @return class wpdb
     */
    private static function DB() {
        if ( null === self::$wpdb ) {
            global $wpdb;
            self::$wpdb = $wpdb;
        }
        return self::$wpdb;
    }

    /**
     * Perform SQL query
     *
     * @param string $query SQL Query.
     *
     * @return bool|string|object SQL result.
     */
    private static function query( $query ) {
        // @todo some query validation if use any external one.
        $result = self::DB()->query( (string) $query );
        if ( ! $result ) {
            return self::fail( self::DB()->last_error );
        }
        return self::success( $result );
    }

    /**
     * Insert data to table.
     *
     * @param string $table table name.
     * @param array  $values associated array of values.
     *
     * @return array results with status and SQL message|error.
     */
    public static function insert( $table, $values ) {
        if ( ! is_array( $values ) || [] === $values ) {
            return self::fail( 'wrong data' );
        }
        $res = self::DB()->insert( self::DB()->prefix . $table, $values );
        if ( ! $res ) {
            return self::fail( self::DB()->last_error );
        }
        return self::success( $res );

    }

    /**
     * Create table.
     *
     * @param string $table table name.
     * @param array  $cols Columns with requird arguments.
     *
     * @return array results with status and SQL message|error.
     */
    public static function tableCreate( $tableName, $cols ) {
        $table           = self::DB()->prefix . $tableName;
        $charset         = self::DB()->get_charset_collate();
        $charset_collate = self::DB()->get_charset_collate();
        $query           = "CREATE TABLE IF NOT EXISTS $table (
             " . implode( ', ', $cols ) . "
        ) $charset_collate;";
        return self::query( $query );
    }

    /**
     * Drop table
     *
     * @param string $tableName table name.
     *
     * @return array results with status and SQL message|error.
     */
    public static function tableDrop( $tableName ) {

        $table = self::DB()->prefix . $tableName;
        $query = "DROP TABLE IF EXISTS $table";
        return self::query( $query );
    }

    /**
     * Return fail.
     *
     * @param string $msg error message.
     *
     * @return array result.
     */
    public static function fail( $msg ) {
        return [
            'success' => false,
            'result'  => $msg,
        ];
    }

    /**
     * Return success.
     *
     * @param string $msg SQL message.
     *
     * @return array result.
     */
    public static function success( $msg ) {
        return [
            'success' => true,
            'result'  => $msg,
        ];
    }
}
