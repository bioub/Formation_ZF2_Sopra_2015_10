<?php

$psr4Config = array(
    'Sopra\\' => '/../src/'
);

spl_autoload_register(function ($fqcn) use ($psr4Config) {

    foreach ($psr4Config as $prefix => $baseDir) {
        if (strpos($fqcn, $prefix) === 0) {

            $classPath = strtr($fqcn, '\\', DIRECTORY_SEPARATOR);
            $classPath = substr($classPath, strlen($prefix));

            require_once __DIR__ . $baseDir . $classPath . '.php';
            return;
        }
    }

});