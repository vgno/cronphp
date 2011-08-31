<?php
class CronjobController extends Zend_Controller_Action {
    protected $cronjobs;
    protected $redirector;
    protected $form;

    public function init() {
        $this->cronjobs = new Application_Model_CronjobMapper();
        $this->redirector = $this->_helper->getHelper('Redirector');
    }

    private function getForm() {
        if ($this->form === null) {
            $this->form = new Application_Form_Cronjob();
        }

        return $this->form;
    }

    public function indexAction() {
        $this->view->form = $this->getForm();

        $this->view->cronjobs = $this->cronjobs->fetchAll();
    }

    public function listAction() {
        $hostname = $this->getRequest()->getParam('hostname');

        $this->view->hostname = $hostname;
        $this->view->cronjobs = $this->cronjobs->fetchAll();
    }

    public function createAction() {
        $this->view->form = $this->getForm();

        $valid = $this->view->form->isValid($_POST);

        if ($valid) {
            $values = $this->view->form->getValues();

            $cronjob = new Application_Model_Cronjob();
            $cronjob->server = $values['server'];
            $cronjob->path = $values['path'];
            $cronjob->user = $values['user'];
            $cronjob->minute = $values['minute'];
            $cronjob->hour = $values['hour'];
            $cronjob->dayOfMonth = $values['dayOfMonth'];
            $cronjob->month = $values['month'];
            $cronjob->dayOfWeek = $values['dayOfWeek'];

            $this->cronjobs->save($cronjob);
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
