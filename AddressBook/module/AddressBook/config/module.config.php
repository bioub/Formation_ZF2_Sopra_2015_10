<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'AddressBook\Controller\Contact' => 'AddressBook\Controller\ContactController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'contact' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'AddressBook\Controller\Contact',
                        'action'     => 'list',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array(
            'address-book/contact/list' => __DIR__ . '/../view/contact.phtml'
        )
    ),
);