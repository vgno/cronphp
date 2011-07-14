<?php

class CronjobController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $this->cronjobs = new Application_Model_CronjobMapper();
    }

    public function indexAction() {
        // action body
        $this->view->form = new Application_Form_Cronjob();

        $this->view->cronjobs = $this->cronjobs->fetchAll();
    }

    public function createAction() {
        // action body
        $form = new Application_Form_Cronjob();

        $valid = $form->isValid($_POST);

        if ($valid) {
            $cronjob = new Application_Model_Cronjob();
            $cronjob->server = $_POST['server'];
            $cronjob->path = $_POST['path'];
            $cronjob->user = $_POST['user'];
            $cronjob->minute = $_POST['minute'];
            $cronjob->hour = $_POST['hour'];
            $cronjob->dayOfMonth = $_POST['dayOfMonth'];
            $cronjob->month = $_POST['month'];
            $cronjob->dayOfWeek = $_POST['dayOfWeek'];

            $this->cronjobs->save($cronjob);
        }

        $this->view->valid = $valid;
    }

    public function deleteAction() {
        // action body
    }

    public function updateAction() {
        // action body
    }
}
