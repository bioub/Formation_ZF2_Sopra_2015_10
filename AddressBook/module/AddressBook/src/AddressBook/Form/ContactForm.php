<?php

namespace AddressBook\Form;

use Zend\Form\Form;

class ContactForm extends Form
{
    public function __construct()
    {
        parent::__construct('contact');
        $this->setAttribute('novalidate', 'novalidate');

        $element = new \Zend\Form\Element\Text('prenom');
        $element->setLabel('Prénom');
        $this->add($element);

        $element = new \Zend\Form\Element\Text('nom');
        $element->setLabel('Nom');
        $this->add($element);

        $element = new \Zend\Form\Element\Email('email');
        $element->setLabel('Email');
        $this->add($element);

        $element = new \Zend\Form\Element\Text('telephone');
        $element->setLabel('Téléphone');
        $this->add($element);

        $element = new \Zend\Form\Element\Submit('submit');
        $element->setValue('Ajouter');
        $this->add($element);

    }

}