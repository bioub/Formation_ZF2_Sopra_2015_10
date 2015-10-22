<?php

namespace AddressBook\Service;


use AddressBook\Form\ContactForm;
use AddressBook\Repository\ContactRepository;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContactService implements ServiceLocatorAwareInterface
{
    // si on envisage de passer à MongoDb ou CouchDb
    // utiliser plutôt ObjectManager (commun aux 2)
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

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

    public function insert($data) {
        $contact = new Contact();
        $form = $this->getForm();
        $form->bind($contact);

        $form->setData($data);

        if (!$form->isValid()) {
            return null;
        }

        $this->em->persist($contact);
        $this->em->flush();

        return $contact;
    }

    /**
     * @return ContactForm
     */
    public function getForm() {
        return $this->serviceLocator->get('AddressBook\Form\Contact');
    }

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}