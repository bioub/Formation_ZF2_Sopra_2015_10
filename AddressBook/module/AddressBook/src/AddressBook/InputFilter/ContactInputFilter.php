<?php

namespace AddressBook\InputFilter;


use Doctrine\ORM\EntityManager;
use DoctrineModule\Validator\NoObjectExists;
use Zend\Filter\StringTrim;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class ContactInputFilter extends InputFilter
{
    public function __construct(EntityManager $em)
    {
        $input = new Input('prenom');

        $validator = new NotEmpty();
        $validator->setMessage('Le prénom est obligatoire', NotEmpty::IS_EMPTY);
        $input->getValidatorChain()->attach($validator);

        $filter = new StringTrim();
        $input->getFilterChain()->attach($filter);

        $this->add($input);

        $input = new Input('email');
        $input->setRequired(false);

        // TODO ne fonctionne pas pour l'UPDATE
        $validator = new NoObjectExists(array(
            'object_repository' => $em->getRepository('AddressBook\Entity\Contact'),
            'fields'            => 'email'
        ));
        $validator->setMessage("Un utilisateur utilise déjà cet email", NoObjectExists::ERROR_OBJECT_FOUND);
        $input->getValidatorChain()->attach($validator);

        if (class_exists('Zend\Filter\ToNull')) {
            $filter = new \Zend\Filter\ToNull();
        }
        else if(class_exists('Zend\Filter\Null')) {
            $filter = new \Zend\Filter\Null();
        }

        $input->getFilterChain()->attach($filter);

        $this->add($input);

        $input = new Input('societe');
        $input->setRequired(false);

        if (class_exists('Zend\Filter\ToNull')) {
            $filter = new \Zend\Filter\ToNull();
        }
        else if(class_exists('Zend\Filter\Null')) {
            $filter = new \Zend\Filter\Null();
        }

        $input->getFilterChain()->attach($filter);

        $this->add($input);
    }

}