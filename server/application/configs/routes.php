<?php
return array(
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
            'toggleJob' => array(
                'type' => 'Zend_Controller_Router_Route_Regex',
                'route' => '(\d+)/toggle/(enable|disable)',
                'defaults' => array(
                    'controller' => 'cronjob',
                    'action' => 'toggle',
                    'cronjobId' => 0,
                    'toggle' => '',
                ),
                'map' => array(
                    1 => 'cronjobId',
                    2 => 'toggle',
                ),
                'reverse' => '%d/toggle/%s',
            ),
        ),
    ),
    'log' => array(
        'type' => 'Zend_Controller_Router_Route_Static',
        'route' => 'logs',
        'chains' => array(
            'list' => array(
                'type' => 'Zend_Controller_Router_Route_Static',
                'route' => 'list',
                'defaults' => array(
                    'controller' => 'log',
                    'action' => 'index',
                ),
            ),
        ),
    ),
);
