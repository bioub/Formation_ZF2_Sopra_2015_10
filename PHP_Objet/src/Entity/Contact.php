<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 12/10/15
 * Time: 10:30
 */

namespace Sopra\Entity;


use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

class Contact implements LoggerAwareInterface
{
    protected $prenom;
    protected $nom;

    /**
     * @var Societe
     */
    protected $societe;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     * @return Contact
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Contact
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return Societe
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * @param Societe $societe
     * @return Contact
     */
    public function setSociete(Societe $societe)
    {
        if ($this->logger) {
            $this->logger->debug('Appel à setSociete');
        }

        $this->societe = $societe;
        return $this;
    }

    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     * @return null
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}