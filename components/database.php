<?php

class Database
{
    public static function Connect()
    {

        $confPath = ROOT.'/configuration/db_conf.php';
        $conf=include($confPath);

        $dsn = "mysql:host={$conf['host']};dbname={$conf['dbName']}";
        $db = new PDO($dsn, $conf['user'], $conf['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    return $db;
    }
}
