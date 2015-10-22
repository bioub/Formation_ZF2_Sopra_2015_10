<?php

namespace AddressBook\InputFilter;


use Zend\Filter\StringTrim;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class ContactInputFilter extends InputFilter
{
    public function __construct()
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