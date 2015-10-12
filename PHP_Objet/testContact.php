<?php

require_once 'vendor/autoload.php';


$steve = new Sopra\Entity\Contact();
$steve->setPrenom('Steve')
      ->setNom('Jobs');

$apple = new Sopra\Entity\Societe();
$apple->setNom('Apple');

$steve->setSociete($apple);

// Vue
echo $steve->getPrenom() . "\n";
echo $steve->getNom() . "\n";
echo $steve->getSociete()->getNom() . "\n";