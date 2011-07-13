<?php

class Api_ListController extends Zend_Controller_Action {

    public function init() {
        $this->_helper->layout->disableLayout();
    }

    public function indexAction() {
        if (!isset($_GET['server'])) {
            $this->view->response = array('success' => false, 'error' => 'Missing server');
        } else {
            $pdo = $this->getInvokeArg('bootstrap')->getResource('pdo');
            $cronjobList = new Application_Model_CronjobList($pdo);
            $cronjobs = $cronjobList->getByServer($_GET['server']);

            $this->view->response = $cronjobs;
        }
    }
}
