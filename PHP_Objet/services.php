<?php


$configArray = array(
    // new de la valeur à faire pour créer l'objet
    'invokables' => array(),
    // appel d'une fonction pour créer l'objet
    'factories' => array(
        'Config' => function () {
            return array(
                'db' => array(
                    'host' => 'localhost',
                    'dbname' => 'logger',
                    'charset' => 'UTF8',
                    'login' => 'root',
                    'pass' => ''
                )
            );
        },
        'PDO' => function ($sm) {
            $config = $sm->get('Config');
            $dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}";
            return new \PDO($dsn, $config['db']['login'], $config['db']['pass']);
        },
        'Sopra\Logger' => function ($sm) {
            $pdo = $sm->get('PDO');
            return new \Sopra\Logger\PDOLogger($pdo);
        }
    )
);

$config = new \Zend\ServiceManager\Config($configArray);
return new \Zend\ServiceManager\ServiceManager($config);