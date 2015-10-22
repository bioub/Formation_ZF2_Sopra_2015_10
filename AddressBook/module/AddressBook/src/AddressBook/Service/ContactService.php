<?php

namespace AddressBook\Service;


use AddressBook\Repository\ContactRepository;
use Doctrine\ORM\EntityManager;

class ContactService
{
    // si on envisage de passer à MongoDb ou CouchDb
    // utiliser plutôt ObjectManager (commun aux 2)
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * ContactService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return ContactRepository
     */
    protected function getRepository() {
        return $this->em->getRepository('AddressBook\Entity\Contact');
    }

    public function findAll() {
        return $this->getRepository()->findAll();
    }

    public function find($id) {
        return $this->getRepository()->findWithSociete($id);
    }

}