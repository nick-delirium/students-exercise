<?php

// index controller

// display errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

// load classes
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/vendor/moonframe/core/autoload.php');
$loader = new NameAutoloader();
$loader->register();

// open session
session_start();

// call Database
include_once(ROOT.'/app/components/Database.php');

// call router
$router = new moonframe\Router();
$router->run();
