<?php
class IndexController extends Zend_Controller_Action {

    public function init() {
        $this->db = $this->getInvokeArg('bootstrap')->getResource('db');
    }

    public function indexAction() {
        // action body
    }
}
