<?php

return array(
    'controllers' => array(
        // invokables => new de la valeur
        // exemple :
        // $sm->get('AddressBook\Controller\Contact') =>
        // new AddressBook\Controller\ContactController()
//        'invokables' => array(
//            'AddressBook\Controller\Contact' => 'AddressBook\Controller\ContactController'
//        ),
        'factories' => array(
            'AddressBook\Controller\Contact' => function($cm) {
                $sm = $cm->getServiceLocator();
                $service = $sm->get('AddressBook\Service\Contact');
                return new \AddressBook\Controller\ContactController($service);
            }
        )
    ),
    'router' => array(
        'routes' => array(
            'contact' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/contacts',
                    'defaults' => array(
                        'controller' => 'AddressBook\Controller\Contact',
                        'action' => 'list',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'add' => array(
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                            'route' => '/add',
                            'defaults' => array(
                                'controller' => 'AddressBook\Controller\Contact',
                                'action' => 'add',
                            ),
                        ),
                    ),
                    'show' => array(
                        'type' => 'Zend\Mvc\Router\Http\Segment',
                        'options' => array(
                            'route' => '/:id',
                            'defaults' => array(
                                'controller' => 'AddressBook\Controller\Contact',
                                'action' => 'show',
                            ),
                            'constraints' => array(
                                'id' => '[1-9][0-9]*'
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'delete' => array(
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => array(
                                    'route' => '/delete',
                                    'defaults' => array(
                                        'controller' => 'AddressBook\Controller\Contact',
                                        'action' => 'delete',
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
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'display_not_found_reason' => false,
        'display_exceptions'       => false,
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
        // invokables
        // factories
        'invokables' => array(
            //'AddressBook\Form\Contact' => 'AddressBook\Form\ContactForm',
            'AddressBook\InputFilter\Contact' => 'AddressBook\InputFilter\ContactInputFilter'
        ),
        'factories' => array(
            'AddressBook\Form\Contact' => function($sm) {
                $form = new \AddressBook\Form\ContactForm();

                $inputFilter = $sm->get('AddressBook\InputFilter\Contact');
                $form->setInputFilter($inputFilter);

                $hydratorManager = $sm->get('HydratorManager');
                $hydrator = $hydratorManager->get('DoctrineModule\Stdlib\Hydrator\DoctrineObject');
                $form->setHydrator($hydrator);

                return $form;
            },
            'AddressBook\Service\Contact' => function($sm) {
                $em = $sm->get('doctrine.entitymanager.orm_default');
                return new \AddressBook\Service\ContactService($em);
            }
        ),
        'abstract_factories' => array(
            'AddressBook\AbstractFactory\TableGatewayAbstractFactory'
        )
    ),

    'doctrine' => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'annotation_driver' => array(
//                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
//                'cache' => 'array',
                'paths' => array(
                     __DIR__ . '/../src/AddressBook/Entity'
                ),
            ),

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'AddressBook\Entity' => 'annotation_driver'
                )
            )
        )
    )
);