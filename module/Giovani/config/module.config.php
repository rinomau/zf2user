<?php

namespace Giovani;

return array(
    'router' => array(
        'routes' => array(
            'giovani' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/giovani',
                    'defaults' => array(
                        'controller' => 'Giovani\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'tutti' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/mostra-tutti',
                            'defaults' => array(
                                'controller' => 'index',
                                'action'     => 'login',
                            ),
                        ),
                    ),
                    'process' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/process',
                            'defaults' => array(
                                'controller' => 'Giovani\Controller\Index',
                                'action'     => 'process',
                            ),
                        ),
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
                array('controller' => 'Giovani\Controller\Index', 'roles' => array()),
            ),
        ),
    ),
    'MvaCrud' => array(
        __NAMESPACE__ => array(
            's_indexTitle'      => 'Gestione curriculum vitae',
            //'s_indexTemplate'   => 'giovani/index/index',
            's_newTitle'        => 'Inserisci nuovo cv',
            // 's_newTemplate'     => 'users/index/default-form',
            's_editTitle'       => 'Modifica dati utente',
            // 's_editTemplate'    => 'crud/index/default-form',
            's_detailTitle'     => 'Dettagli',
            // 's_detailTemplate'  => 'crud/index/detail',
            's_processErrorTitle'       => 'Form errors page default',
            //'s_processErrorTemplate'    => 'crud/index/default-form',
            's_deleteRouteRedirect'     => 'giovani',
            's_processRouteRedirect'     => 'giovani',
        )
    )
);
