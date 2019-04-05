<?php

namespace App;

class DataBase
{
    private static $db = null;

    public static function getDb()
    {
        self::$db = sqlite_open("products.db");
        return self::$db;
    }
}