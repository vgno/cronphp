<?php
class ServerController extends Zend_Controller_Action {
    public function init() {
    }

    public function indexAction() {
        $model = new Cronphp_Model_Server();

        $servers = $model->fetchAll();

        foreach ($servers as $server) {
            var_dump($server->hostname);
        }
    }
}
