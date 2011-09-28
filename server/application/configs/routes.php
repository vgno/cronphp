<?php
return array(
    'default' => array(),
    'index' => array(
        'type' => 'Zend_Controller_Router_Route_Static',
        'route' => '',
        'defaults' => array(
            'controller' => 'index',
            'action' => 'index',
        ),
    ),
    'cronjob' => array(
        'type' => 'Zend_Controller_Router_Route_Static',
        'route' => 'cronjob',
        'chains' => array(
            'index' => array(
                'type' => 'Zend_controller_Router_Route_Static',
                'defaults' => array(
                    'controller' => 'cronjob',
                    'action' => 'index',
                ),
            ),
            'list' => array(
                'type' => 'Zend_Controller_Router_Route_Regex',
                'route' => 'list/(\w+)',
                'defaults' => array(
                    'controller' => 'cronjob',
                    'action' => 'list',
                    'hostname' => '',
                ),
                'map' => array(
                    1 => 'hostname',
                ),
                'reverse' => 'cronjobs/%s',
            ),
            'create' => array(
                'type' => 'Zend_Controller_Router_Route_Static',
                'route' => 'create',
                'defaults' => array(
                    'controller' => 'cronjob',
                    'action' => 'create',
                ),
            ),
            'job' => array(
                'type' => 'Zend_Controller_Router_Route_Regex',
                'route' => '(\d+)',
                'defaults' => array(
                    'controller' => 'cronjob',
                    'action' => 'toggle',
                    'cronjobId' => 0,
                ),
                'map' => array(
                    1 => 'cronjobId',
                ),
                'reverse' => '%d',
                'chains' => array(
                    'view' => array(
                        'type' => 'Zend_Controller_Router_Route_Static',
                        'route' => '',
                        'defaults' => array(
                            'controller' => 'cronjob',
                            'action' => 'view',
                        ),
                    ),
                    'toggle' => array(
                        'type' => 'Zend_Controller_Router_Route_Regex',
                        'route' => 'toggle/(enable|disable)',
                        'defaults' => array(
                            'controller' => 'cronjob',
                            'action' => 'toggle',
                            'toggle' => '',
                        ),
                        'map' => array(
                            1 => 'toggle',
                        ),
                        'reverse' => 'toggle/%s',
                    ),
                ),
            ),
        ),
    ),
    'log' => array(
        'type' => 'Zend_Controller_Router_Route_Static',
        'route' => 'logs',
        'defaults' => array(
            'controller' => 'log',
            'action' => 'index',
        ),
        'chains' => array(
            'list' => array(
                'type' => 'Zend_Controller_Router_Route_Static',
                'route' => 'list',
                'defaults' => array(
                    'controller' => 'log',
                    'action' => 'index',
                ),
            ),
            'server' => array(
                'type' => 'Zend_Controller_Router_Route_Regex',
                'route' => 'server/(\w+)',
                'defaults' => array(
                    'controller' => 'log',
                    'action' => 'server',
                    'server' => '',
                ),
                'map' => array(
                    1 => 'server',
                ),
                'reverse' => 'server/%s',
            ),
        ),
    ),
);
