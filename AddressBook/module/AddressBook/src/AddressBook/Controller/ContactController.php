<?php

namespace AddressBook\Controller;

use AddressBook\Entity\Contact;
use AddressBook\Form\ContactForm;
use AddressBook\InputFilter\ContactInputFilter;
use AddressBook\Service\ContactService;
use Doctrine\ORM\EntityRepository;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Db\TableGateway\TableGateway;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactController extends AbstractActionController
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

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
        $form = $this->contactService->getForm();

        if ($this->request->isPost()) {
            $data = $this->request->getPost();

            $contact = $this->contactService->insert($data);

            if ($contact) {
                $message = $contact->getPrenom() . ' ' . $contact->getNom() . ' a bien été ajouté';
                $this->flashMessenger()->addSuccessMessage($message);

                return $this->redirect()->toRoute('contact');
            }
        }

        return new ViewModel(array(
            'contactForm' => $form->prepare()
        ));
    }

    public function deleteAction()
    {
        return new ViewModel();
    }


}

