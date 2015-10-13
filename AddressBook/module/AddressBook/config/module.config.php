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
                    'route'    => '/contacts',
                    'defaults' => array(
                        'controller' => 'AddressBook\Controller\Contact',
                        'action'     => 'list',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'add' => array(
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                            'route'    => '/add',
                            'defaults' => array(
                                'controller' => 'AddressBook\Controller\Contact',
                                'action'     => 'add',
                            ),
                        ),
                    ),
                    'show' => array(
                        'type' => 'Zend\Mvc\Router\Http\Segment',
                        'options' => array(
                            'route'    => '/:id',
                            'defaults' => array(
                                'controller' => 'AddressBook\Controller\Contact',
                                'action'     => 'show',
                            ),
                            'contraints' => array(
                                'id' => '[1-9][0-9]*'
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'delete' => array(
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => array(
                                    'route'    => '/delete',
                                    'defaults' => array(
                                        'controller' => 'AddressBook\Controller\Contact',
                                        'action'     => 'delete',
                                    ),
                                ),
                            ),
                        ),
                    ),

                )
            ),
        ),
    ),
    'view_manager' => array(
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
        // invokables
        // factories
        'factories' => array(
//            'AddressBook\TableGateway\Contact' => function($sm) {
//                $adapter = $sm->get('Zend\Db\Adapter\Adapter');
//                return new \Zend\Db\TableGateway\TableGateway('contact', $adapter);
//            }
        ),
        'abstract_factories' => array(
            'AddressBook\AbstractFactory\TableGatewayAbstractFactory'
        )
    )
);