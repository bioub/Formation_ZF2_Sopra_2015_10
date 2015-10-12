<?php

require_once 'vendor/autoload.php';

$logger = new \Sopra\Logger\FileLoggerAvecInterface('tmp/app.log');
$logger->alert('Un message grave');

$contact = new \Sopra\Entity\Contact();
$societe = new \Sopra\Entity\Societe();
$contact->setLogger($logger);
$contact->setSociete($societe);