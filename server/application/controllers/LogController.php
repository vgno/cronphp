<?php
class LogController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $this->logs = new Cronphp_Model_Log();
        $this->cronjobs= new Cronphp_Model_Cronjob();
    }

    public function indexAction() {
        $logs = $this->logs->getLog();

        foreach ($logs as $log) {
            $job = $this->cronjobs->fetchRow($this->cronjobs->select()->where('cronjobId = ?', $log->cronjobId));
            $log->cronjob = $job;
        }
        $this->view->list = $logs;
    }

    public function serverAction() {
        $hostname = $this->getRequest()->getParam('server');
        $logs = $this->logs->getLogForServer($hostname);

        foreach ($logs as $log) {
            $job = $this->cronjobs->fetchRow($this->cronjobs->select()->where('cronjobId = ?', $log->cronjobId));
            $log->cronjob = $job;
        }

        $this->view->hostname = $hostname;
        $this->view->list = $logs;
    }
}
