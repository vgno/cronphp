<?php
class Api_Bootstrap extends Zend_Application_Module_Bootstrap {
    protected function _initRoutes() {
        $router = $this->bootstrap('frontController')->getResource('frontController')->getRouter();

        $routes = new Zend_Config(array(
            'api' => array(
                'type' => 'Zend_Controller_Router_Route_Static',
                'route' => 'api',
                'defaults' => array(
                    'module' => 'api',
                    'controller' => 'api',
                    'action' => 'index',
                ),
                'chains' => array(
                    'list' => array(
                        'type' => 'Zend_Controller_Router_Route_Static',
                        'route' => 'list',
                        'defaults' => array(
                            'module' => 'api',
                            'controller' => 'list',
                            'action' => 'index',
                        ),
                    ),
                    'log' => array(
                        'type' => 'Zend_Controller_Router_Route_Static',
                        'route' => 'log',
                        'defaults' => array(
                            'module' => 'api',
                            'controller' => 'log',
                            'action' => 'index',
                        ),
                    ),
                ),
            ),
        ));

        $router->addConfig($routes);
    }
}
