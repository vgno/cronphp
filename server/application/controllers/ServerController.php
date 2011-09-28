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

    public function viewAction() {
        $hostname = $this->getRequest()->getParam('server');
        $this->view->hostname = $hostname;

        $cronjobs = new Cronphp_Model_Cronjob();
        $this->view->cronjobs = $cronjobs->fetchAll($cronjobs->select()->where('cronjobServer = ?', $hostname));

        $logs = new Cronphp_Model_Log();
        $this->view->log = $logs->getLogForServer($hostname);
    }
}
