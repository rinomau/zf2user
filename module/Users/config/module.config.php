<?php

namespace Users;

return array(
    'router' => array(
        'routes' => array(
            'users' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/users[/:action][/:id]',
                    'defaults' => array(
                        'controller' => 'Users\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'userdetail' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/user[/:action][/:id]',
                    'defaults' => array(
                        'controller' => 'Users\Controller\User',
                        'action'     => 'index',
                    ),
                ),
            ),        
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'bjyauthorize' => array(
        'guards' => array(
            'BjyAuthorize\Guard\Controller' => array(
                array('controller' => 'Users\Controller\Index', 'roles' => array()),
                array('controller' => 'Users\Controller\User', 'roles' => array()),
            ),
        ),
    ),
);
