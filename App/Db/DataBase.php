<?php


namespace App\Db;


use PDO;

class DataBase
{
    private static $db = null;
    private static $fdb = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getDb()
    {
        if (self::$fdb === null)
        {
            if (self::$db === null)
            {
                self::$db = new PDO('sqlite:database.db');
            }
            self::$fdb = new \Envms\FluentPDO\Query(self::$db);
        }

        return self::$fdb;

    }

}