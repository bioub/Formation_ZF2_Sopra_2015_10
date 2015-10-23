<?php

namespace AddressBook\Form;

use Doctrine\ORM\EntityManager;
use Zend\Form\Form;

class ContactForm extends Form
{
    public function __construct(EntityManager $em)
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

        $this->add(
            array(
                'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                'name' => 'societe',
                'options' => array(
                    'label' => 'Société',
                    'object_manager'     => $em,
                    'target_class'       => 'AddressBook\Entity\Societe',
                    'property'           => 'nom',
                    'display_empty_item' => true,
                    'empty_item_label'   => '-- Pas de société --',
                ),
            )
        );

        $element = new \Zend\Form\Element\Submit('submit');
        $element->setValue('Valider');
        $this->add($element);

    }

}