<?php

return array(
    'db' => array(
        'driver' => 'Pdo_mysql',
        'host' => 'localhost',
        'database' => 'address_book',
        'charset' => 'UTF8',
        'username' => 'root',
        'password' => ''
    ),
    'service_manager' => array(
        'factories' => array(
            // une fabrique est une fonction qui créé l'objet à la demande
            // la valeur peut être soit une fonction anonyme
            // soit une classe qui implemente Zend\ServiceManager\FactoryInterface
            // et sa fonction createService
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory'
        )
    )
);