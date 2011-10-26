<?php
class Api_ListController extends Zend_Controller_Action {

    private $cronjobs;

    public function init() {
        $this->cronjobs = new Cronphp_Model_Cronjob();
    }

    public function indexAction() {
        if (!isset($_GET['server'])) {
            $this->view->response = array('success' => false, 'error' => 'Missing server');
        } else {
            $cronjobs = $this->cronjobs->getActiveJobsByServer($_GET['server']);

            $response = array();

            foreach ($cronjobs as $cronjob) {
                $response[] = new Api_Model_ListResponse($cronjob);
            }

            $this->view->response = $response;
        }
    }
}
