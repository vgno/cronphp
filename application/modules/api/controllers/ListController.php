<?php

class Api_ListController extends Zend_Controller_Action {

    public function init() {
        #$this->_helper->layout->disableLayout();
        $this->db = $this->getInvokeArg('bootstrap')->getResource('db');
    }

    public function indexAction() {
        if (!isset($_GET['server'])) {
            $this->view->response = array('success' => false, 'error' => 'Missing server');
        } else {
            $cronjobList = new Application_Model_CronjobList($this->db);
            $cronjobs = $cronjobList->getByServer($_GET['server']);

            $this->view->response = $cronjobs;
        }
    }
}
