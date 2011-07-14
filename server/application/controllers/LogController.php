<?php

class LogController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $this->logs = new Application_Model_LogMapper();
        $this->cronjobs= new Application_Model_CronjobMapper();
    }

    public function indexAction() {
        // action body

        $logs = $this->logs->getLog();
        foreach ($logs as &$log) {
            $job = new Application_Model_Cronjob();
            $this->cronjobs->find($log->getCronjobId(), $job);

            $log->setCronjob($job);
        }
        $this->view->list = $logs;
    }

    public function viewAction() {
        // action body
    }
}
