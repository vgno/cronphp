<?php
class Cronphp_Model_Log extends Zend_Db_Table_Abstract {
    protected $_name = 'logs';
    protected $_rowClass = 'Cronphp_Model_Log_Row';

    public function getLog() {
        $logs = $this->fetchAll();

        return $logs;
    }

    public function getLogForJob($cronjob) {
        $logs = $this->fetchAll($this->select()->where('cronjobId = ?', $cronjob)->order('start DESC'));

        return $logs;
    }

    public function getLogForServer($server, $cronjobs = true) {
        $logs = $this->fetchAll($this->select()->where('hostname = ?', $server)->order('start DESC'));

        return $logs;
    }
}

class Cronphp_Model_Log_Row extends Zend_Db_Table_Row_Abstract {
    private $cronjob;

    public function getCronjob() {
        if (is_null($this->cronjob)) {
            $cronjobs = new Cronphp_Model_Cronjob();

            $this->cronjob = $cronjobs->find($this->cronjobId)->current();
        }

        return $this->cronjob;
    }
}
