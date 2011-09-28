<?php
class Cronphp_Model_Log extends Zend_Db_Table_Abstract {
    protected $_name = 'logs';
    protected $_rowClass = 'Cronphp_Model_Log_Row';

    public function getLog($cronjobs = true) {
        $logs = $this->fetchAll();

        if ($cronjobs) {
            $logs = $this->getCronjobs($logs);
        }

        return $logs;
    }

    public function getLogForServer($server, $cronjobs = true) {
        $logs = $this->fetchAll($this->select()->where('hostname = ?', $server));

        if ($cronjobs) {
            $logs = $this->getCronjobs($logs);
        }
        return $logs;
    }

    private function getCronjobs($logs) {
        $cronjobs = new Cronphp_Model_Cronjob();

        foreach ($logs as $log) {
            $job = $cronjobs->fetchRow($cronjobs->select()->where('cronjobId = ?', $log->cronjobId));
            $log->cronjob = $job;
        }

        return $logs;
    }
}

class Cronphp_Model_Log_Row extends Zend_Db_Table_Row_Abstract {
    public $cronjob;
}
