<?php

class Api_LogController extends Zend_Controller_Action {

    public function init() {
        $this->_helper->layout->disableLayout();
    }

    public function indexAction() {
        $data = json_decode($_POST['data']);

        if (!isset($data->server)) {
            $this->view->response = array('success' => false, 'error' => 'Missing server');
        } else {
            $pdo = $this->getInvokeArg('bootstrap')->getResource('pdo');
            $logger = new Application_Model_Log($pdo);
            $cronjob = new Application_Model_Cronjob($pdo);

            $cronjob->getByPath($data->path, $data->server);

            $jobId = $cronjob->id;
            $server = $data->server;
            $start = new DateTime($data->start);
            $end = new DateTime($data->end);
            $runTime = $data->runTime;
            $response = $data->response;
            $output = $data->output;

            $result = $logger->log($jobId, $server, $start, $end, $runTime, $response, $output);
            $this->view->response = array('success' => $result);
        }
    }
}
