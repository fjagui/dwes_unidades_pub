<?php
require 'vendor/autoload.php';
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
// test code, should output:
// api://default
// when you run $ php bootstrap.php
define("DBHOST", $_ENV['DBHOST']);
define("DBNAME", $_ENV['DBNAME']);
define("DBUSER", $_ENV['DBUSER']);
define("DBPASS", $_ENV['DBPASS']);
define("DBPORT", $_ENV['DBPORT']);


