<?php
class Application_Model_LogMapper extends Cronphp_Mapper {
    protected function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Log');
        }

        return $this->_dbTable;
    }

    public function save(Application_Model_Log $log) {
        $data = array(
            'logCronjobId'  => $log->getCronjobId(),
            'logServer'     => $log->getServer(),
            'logStart'      => $log->getStart(),
            'logEnd'        => $log->getEnd(),
            'logRunTime'    => $log->getRunTime(),
            'logResponse'   => $log->getResponse(),
            'logOutput'     => $log->getOutput(),
        );

        if (null === ($id = $cronjob->getId())) {
            unset($data['id']);
            return $this->getDbTable()->insert($data);
        } else {
            return $this->getDbTable()->update($data, array('logId = ?' => $id));
        }
    }


    public function find($id, Application_Model_Log $log) {
        $result = $this->getDbTable()->find($id);

        if (0 == count($result)) {
            return false;
        }

        $row = $result->current();

        $this->fill($row, $log);

        return true;
    }

    public function getLog($offset = 0, $limit = 20) {
        $db = $this->getDbTable();

        $select =  $db->select()
                    ->order('logId DESC')
                    ->limit($limit, $offset);

        $result = $db->fetchRow($select);

        if (0 == count($result)) {
            return;
        }

        $entries = array();
        foreach ($result as $row) {
            $entry = new Application_Model_Log();
            $this->fill($result, $entry);

            $entries[] = $entry;
        }

        return $entries;
    }

    protected function fill($row, $model) {
        $model->setId($row->logId)
                ->setCronjobId($row->logCronjobId)
                ->setServer($row->logServer)
                ->setStart($row->logStart)
                ->setEnd($row->logEnd)
                ->setRunTime($row->logRunTime)
                ->setResponse($row->logResponse)
                ->setOutput($row->logOutput);
    }
}
