<?php
class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $this->db = $this->getInvokeArg('bootstrap')->getResource('db');
    }

    public function indexAction() {
        // action body
    }
}
