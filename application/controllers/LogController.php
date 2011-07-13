<?php

class LogController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $this->db = $this->getInvokeArg('bootstrap')->getResource('db');
    }

    public function indexAction() {
        // action body
        $logger = new Application_Model_Log($this->db);

        $logs = $logger->getLog();
        foreach ($logs as &$log) {
            $job = new Application_Model_Cronjob($this->db);
            $job->getById($log['logCronjobId']);

            $log['cronjob'] = $job;
        }
        $this->view->list = $logs;
    }

    public function viewAction() {
        // action body
    }
}
