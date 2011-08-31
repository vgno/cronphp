<?php
class Cronphp_Model_Log extends Zend_Db_Table_Abstract {
    protected $_name = 'logs';
    protected $_rowClass = 'Cronphp_Model_Log_Row';

    public function getLog() {
        return $this->fetchAll();
    }
}

class Cronphp_Model_Log_Row extends Zend_Db_Table_Row_Abstract {
    public $cronjob;
}
