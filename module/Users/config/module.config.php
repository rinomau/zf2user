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
                array('controller' => 'Users\Controller\Index', 'roles' => array('admin')),
                array('controller' => 'Users\Controller\User', 'roles' => array()),
            ),
        ),
    ),
    'MvaCrud' => array(
        __NAMESPACE__ => array(
            's_indexTitle'      => 'Gestione utenti copernico',
            's_indexTemplate'   => 'users/index/index',
            's_newTitle'        => 'Crea nuovo utente',
            // 's_newTemplate'     => 'users/index/default-form',
            's_editTitle'       => 'Modifica dati utente',
            // 's_editTemplate'    => 'crud/index/default-form',
            's_detailTitle'     => 'Dettagli',
            // 's_detailTemplate'  => 'crud/index/detail',
            's_processErrorTitle'       => 'Form errors page default',
            //'s_processErrorTemplate'    => 'crud/index/default-form',
            's_deleteRouteRedirect'     => 'users',
            's_processRouteRedirect'     => 'users',
        )
    )
);
