<?php
class CronjobController extends Zend_Controller_Action {
    protected $cronjobs;
    protected $logs;
    protected $redirector;
    protected $form;

    public function init() {
        $this->redirector = $this->_helper->getHelper('Redirector');
    }

    private function getForm() {
        if ($this->form === null) {
            $this->form = new Cronphp_Form_Cronjob();
        }

        $servers = new Cronphp_Model_Server();
        $this->form->addServers($servers->fetchAll());

        return $this->form;
    }

    private function getCronjobs() {
        if (is_null($this->cronjobs)) {
            $this->cronjobs = new Cronphp_Model_Cronjob();
        }

        return $this->cronjobs;
    }

    private function getLogs() {
        if (is_null($this->logs)) {
            $this->logs = new Cronphp_Model_Log();
        }

        return $this->logs;
    }

    public function indexAction() {
        $this->view->form = $this->getForm();

        $this->view->activeCronjobs = $this->getCronjobs()->fetchAll($this->getCronjobs()->select()->where('active = 1'));
        $this->view->inactiveCronjobs = $this->getCronjobs()->fetchAll($this->getCronjobs()->select()->where('active = 0'));
    }

    public function viewAction() {
        $this->view->cronjob = $this->getCronjobs()->find($this->getRequest()->getParam('cronjobId'))->current();
        $this->view->logs = $this->getLogs()->getLogForJob($this->getRequest()->getParam('cronjobId'));
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

                $this->getCronjobs()->save($cronjob);
                $this->redirector->gotoSimple('index');
            }
        }
    }

    public function toggleAction() {
        $id = $this->getRequest()->getParam('cronjobId');
        $toggle = $this->getRequest()->getParam('toggle');

        $cronjob = $this->getCronjobs()->fetchRow($this->getCronjobs()->select()->where('id = ?', $id));

        $cronjob->$toggle(); // The regexp in the route validates if its either enable or disable
        $success = $cronjob->save();

        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->_helper->json(array('success' => (bool) $success));
        } else {
            $this->_helper->redirector->gotoUrl($this->getRequest()->get('HTTP_REFERER'));
        }
    }

    public function deleteAction() {
        // action body
    }

    public function updateAction() {
        // action body
    }
}
