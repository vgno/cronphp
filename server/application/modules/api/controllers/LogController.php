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
            $logs = new Cronphp_Model_Log();
            $cronjob = new Cronphp_Model_Cronjob();

            // Verify that the reported cronjob is running on the correct
            // server and reports the correct id.
            $job = $cronjob->findByPath($data->id, $data->path, $data->server);

            $start = new DateTime($data->start);
            $end = new DateTime($data->end);

            $log = array(
                'cronjobId' => $data->id,
                'hostname' => $data->server,
                'start' => $start->format('Y-m-d H:I:s'),
                'end' => $end->format('Y-m-d H:I:s'),
                'runTime' => $data->runTime,
                'response' => $data->response,
                'output' => $data->output,
            );

            $result = $logs->insert($log);
            $this->view->response = array('success' => $result);
        }
    }
}
