<?php
class CronjobController extends Zend_Controller_Action {
    protected $cronjobs;
    protected $redirector;
    protected $form;

    public function init() {
        $this->cronjobs = new Cronphp_Model_Cronjob();
        $this->redirector = $this->_helper->getHelper('Redirector');
    }

    private function getForm() {
        if ($this->form === null) {
            $this->form = new Cronphp_Form_Cronjob();
        }

        return $this->form;
    }

    public function indexAction() {
        $this->view->form = $this->getForm();

        $this->view->activeCronjobs = $this->cronjobs->fetchAll($this->cronjobs->select()->where('active = 1'));
        $this->view->inactiveCronjobs = $this->cronjobs->fetchAll($this->cronjobs->select()->where('active = 0'));
    }

    public function listAction() {
        $hostname = $this->getRequest()->getParam('hostname');

        $this->view->hostname = $hostname;
        $this->view->cronjobs = $this->cronjobs->fetchAll($this->cronjobs->select()->where('hostname = ?', $hostname));
    }

    public function createAction() {
        $this->view->form = $this->getForm();

        if (!empty($_POST)) {
            $valid = $this->view->form->isValid($_POST);

            if ($valid) {
                $values = $this->view->form->getValues();

                $cronjob = new Cronphp_Model_Cronjob();
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
        }
    }

    public function toggleAction() {
        $id = $this->getRequest()->getParam('cronjobId');
        $toggle = $this->getRequest()->getParam('toggle');

        $cronjob = $this->cronjobs->fetchRow($this->cronjobs->select()->where('cronjobId = ?', $id));

        $cronjob->$toggle(); // The regexp in the route validates if its either enable or disable
        $success = $cronjob->save();

        $this->_helper->json(array('success' => (bool) $success));
    }

    public function deleteAction() {
        // action body
    }

    public function updateAction() {
        // action body
    }
}
