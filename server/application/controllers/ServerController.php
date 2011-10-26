<?php
class ServerController extends Zend_Controller_Action {
    public function init() {
    }

    public function indexAction() {
        $model = new Cronphp_Model_Server();

        $servers = $model->fetchAll();

        $this->view->servers = $servers;
    }

    public function viewAction() {
        $hostname = $this->getRequest()->getParam('server');
        $this->view->hostname = $hostname;

        $cronjobs = new Cronphp_Model_Cronjob();
        $this->view->cronjobs = $cronjobs->fetchAll($cronjobs->select()->where('server = ?', $hostname));

        $logs = new Cronphp_Model_Log();
        $this->view->log = $logs->getLogForServer($hostname);
    }
}
