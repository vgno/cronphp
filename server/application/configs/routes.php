<?php
return array(
    'cronjobs' => array(
        'type' => 'Zend_Controller_Router_Route_Static',
        'route' => 'cronjobs',
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
                'type' => 'Zend_Controller_Router_Route_static',
                'route' => 'create',
                'defaults' => array(
                    'controller' => 'cronjob',
                    'action' => 'create',
                ),
            ),
        ),
    ),
    'logs' => array(
        'Zend_Controller_Router_Route_Regex',
        'logs',
        array(),
        array(),
        ''
    ),
);
