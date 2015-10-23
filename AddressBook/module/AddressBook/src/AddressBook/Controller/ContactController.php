<?php

namespace AddressBook\Controller;

use AddressBook\Service\ContactService;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactController extends AbstractActionController
{

    /**
     * @var Request
     */
    protected $request = null;

    /**
     * @var Response
     */
    protected $response = null;

    /**
     * @var ContactService
     */
    protected $contactService = null;

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
        $listeContacts = $this->contactService->findAll();

        return new ViewModel(array(
            'contacts' => $listeContacts
        ));
    }

    public function showAction()
    {
        $id = $this->params('id');

        $contact = $this->contactService->findWithSociete($id);

        if (!$contact) {
            return $this->notFoundAction();
        }

        return new ViewModel(array(
            'contact' => $contact
        ));
    }

    public function addAction()
    {
        $form = $this->contactService->createForm();

        if ($this->request->isPost()) {
            $data = $this->request->getPost();

            $contact = $this->contactService->persist($data);

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
        $id = $this->params('id');
        $contact = $this->contactService->find($id);

        if (!$contact) {
            return $this->notFoundAction();
        }

        if ($this->request->isPost()) {
            if ($this->request->getPost('confirm') === 'oui') {
                $this->contactService->remove($contact);

                $message = $contact->getPrenom() . ' ' . $contact->getNom() . ' a bien été supprimé';
                $this->flashMessenger()->addSuccessMessage($message);
            }

            return $this->redirect()->toRoute('contact');
        }

        return new ViewModel(array(
            'contact' => $contact
        ));
    }

    public function modifyAction()
    {
        $id = $this->params('id');
        $contact = $this->contactService->find($id);

        if (!$contact) {
            return $this->notFoundAction();
        }
        $form = $this->contactService->createForm($contact);

        if ($this->request->isPost()) {
            $data = $this->request->getPost();

            $contact = $this->contactService->persist($data);

            if ($contact) {
                $message = $contact->getPrenom() . ' ' . $contact->getNom() . ' a bien été modifié';
                $this->flashMessenger()->addSuccessMessage($message);

                return $this->redirect()->toRoute('contact');
            }
        }

        return new ViewModel(array(
            'contactForm' => $form->prepare()
        ));
    }


}

