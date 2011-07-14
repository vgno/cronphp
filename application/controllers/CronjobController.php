<?php
class CronjobController extends Zend_Controller_Action {

    protected $cronjobs;
    protected $redirector;
    protected $form;

    public function init() {
        /* Initialize action controller here */
        $this->cronjobs = new Application_Model_CronjobMapper();
        $this->redirector = $this->_helper->getHelper('Redirector');
    }

    private function getForm() {
        if ($this->form === null) {
            $this->form = new Application_Form_Cronjob();
        }

        $this->form->setAction('cronjob/create');

        return $this->form;
    }

    public function indexAction() {
        // action body
        $this->view->form = $this->getForm();

        $this->view->cronjobs = $this->cronjobs->fetchAll();

        $this->render('form');
        $this->render('index');
    }

    public function createAction() {
        // action body
        $this->view->form = $this->getForm();

        $valid = $this->view->form->isValid($_POST);

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

            #$this->cronjobs->save($cronjob);
        }

        if ($valid) {
            $this->redirector->gotoSimple('index');
        }

        $this->render('form');
    }

    public function deleteAction() {
        // action body
    }

    public function updateAction() {
        // action body
    }
}
