<?php

use Sopra\Logger\PDOLogger;

require_once 'vendor/autoload.php';

$sm = require_once 'services.php';

//$config = array(
//    'db' => array(
//        'host' => 'localhost',
//        'dbname' => 'logger',
//        'charset' => 'UTF8',
//        'login' => 'root',
//        'pass' => ''
//    )
//);
//
//$dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}";
//$pdo = new PDO($dsn, $config['db']['login'], $config['db']['pass']);
//
//$logger = new PDOLogger($pdo);
//$logger->info('Coucou le log');


$logger = $sm->get('Sopra\Logger');
$logger->info('Coucou le log avec les services');