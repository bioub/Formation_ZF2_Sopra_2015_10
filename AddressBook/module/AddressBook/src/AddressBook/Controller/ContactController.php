<?php

namespace AddressBook\Controller;

use AddressBook\Service\ContactService;
use Doctrine\ORM\EntityRepository;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactController extends AbstractActionController
{
    /**
     * @var ContactService
     */
    protected $contactService;

    /**
     * ContactController constructor.
     * @param ContactService $contactService
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }


    public function listAction()
    {
//        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        /*$factory = new AdapterServiceFactory();
        $adapter = $factory->createService($this->serviceLocator);*/

//        $tableGateway = new TableGateway('contact', $adapter);
        //$tableGateway = $this->serviceLocator->get('AddressBook\TableGateway\Contact');

        /** @var  $tableGateway TableGateway */
        //$listeContacts = $tableGateway->select()->toArray();


        /** @var EntityRepository $repo  */

        $listeContacts = $this->contactService->findAll();



        return new ViewModel(array(
            'contacts' => $listeContacts
        ));
    }

    public function showAction()
    {
        $id = $this->params('id');

        $contact = $this->contactService->find($id);

        if (!$contact) {
            return $this->notFoundAction();
        }

        return new ViewModel(array(
            'contact' => $contact
        ));
    }

    public function addAction()
    {
        return new ViewModel();
    }

    public function deleteAction()
    {
        return new ViewModel();
    }


}

