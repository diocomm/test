<?php
// FRONT CONTROLLER


// display errors 
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/controllers/Router.php');

// query Router
$rout = new Router();
$rout->run();