<?php
class Api_ListController extends Zend_Controller_Action {

    private $cronjobs;

    public function init() {
        $this->cronjobs = new Application_Model_CronjobMapper();
    }

    public function indexAction() {
        if (!isset($_GET['server'])) {
            $this->view->response = array('success' => false, 'error' => 'Missing server');
        } else {
            $cronjobs = $this->cronjobs->getByServer($_GET['server']);

            foreach ($cronjobs as &$cronjob) {
                $cronjob = new Api_Model_ListResponse($cronjob);
            }

            $this->view->response = $cronjobs;
        }
    }
}
