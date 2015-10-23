<?php

namespace AddressBook\Service;


use AddressBook\Entity\Contact;
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
     * @var ContactForm
     */
    protected $form;

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
        return $this->getRepository()->find($id);
    }

    public function findWithSociete($id) {
        return $this->getRepository()->findWithSociete($id);
    }

    public function remove(Contact $contact) {
        $this->em->remove($contact);
        $this->em->flush();
    }

    public function persist($data) {
        $form = $this->getForm();

        $form->setData($data);

        if (!$form->isValid()) {
            return null;
        }

        $contact = $form->getData();

        $this->em->persist($contact);
        $this->em->flush();

        return $contact;
    }

    /**
     * @return ContactForm
     */
    public function createForm(Contact $contact = null) {
        $contact = ($contact) ? $contact : new Contact();

        $this->form = $this->serviceLocator->get('AddressBook\Form\Contact');
        $this->form->bind($contact);

        return $this->form;
    }

    /**
     * @return ContactForm
     */
    public function getForm()
    {
        return $this->form;
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