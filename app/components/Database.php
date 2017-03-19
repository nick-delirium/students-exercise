<?php

namespace components;
use \PDO;

class Database
{

    public function __construct()
    {
      $this->Connect();
    }

    public static function Connect()
    {

        $confPath = ROOT.'/app/configuration/db_conf.php';
        $conf=include($confPath);

        $dsn = "mysql:host={$conf['host']};dbname={$conf['dbName']}";
        $db = new \PDO($dsn, $conf['user'], $conf['pass'], [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);

    return $db;
    }
}
