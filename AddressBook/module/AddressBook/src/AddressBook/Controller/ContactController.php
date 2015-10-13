<?php

namespace AddressBook\Controller;

use Zend\Db\Adapter\AdapterServiceFactory;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactController extends AbstractActionController
{

    public function listAction()
    {
//        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        /*$factory = new AdapterServiceFactory();
        $adapter = $factory->createService($this->serviceLocator);*/

//        $tableGateway = new TableGateway('contact', $adapter);
        $tableGateway = $this->serviceLocator->get('AddressBook\TableGateway\Contact');

        $listeContacts = $tableGateway->select()->toArray();

        var_dump($listeContacts);

        return new ViewModel(array(

        ));
    }

    public function showAction()
    {
        return new ViewModel();
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

