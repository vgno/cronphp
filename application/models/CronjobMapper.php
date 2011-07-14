<?php
class Application_Model_CronjobMapper extends Cronphp_Mapper {
    protected function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Cronjob');
        }

        return $this->_dbTable;
    }

    public function save(Application_Model_Cronjob $cronjob) {
        $data = array(
            'cronjobServer'     => $cronjob->getServer(),
            'cronjobPath'       => $cronjob->getPath(),
            'cronjobUser'       => $conrjob->getUser(),
            'cronjobMinute'     => $cronjob->getMinute(),
            'cronjobHour'       => $cronjob->getHour(),
            'cronjobDayOfMonth' => $cronjob->getDayOfMonth(),
            'cronjobMonth'      => $cronjob->getMonth(),
            'cronjobDayOfWeek'  => $cronjob->getDayOfWeek(),
        );

        if (null === ($id = $cronjob->getId())) {
            unset($data['id']);
            return $this->getDbTable()->insert($data);
        } else {
            return $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }


    public function find($id, Application_Model_Cronjob $cronjob) {
        $result = $this->getDbTable()->find($id);

        if (0 == count($result)) {
            return false;
        }

        $row = $result->current();

        $this->fill($row, $cronjob);

        return true;
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Cronjob();

            $this->fill($row, $entry);

            $entries[] = $entry;
        }

        return $entries;
    }

    public function getByPath($path, $server) {
        $db = $this->getDbTable();

        $select =  $db->select()
                    ->where('cronjobPath = ?', $path)
                    ->where('cronjobServer = ?', $server);

        $result = $db->fetchRow($select);

        if (0 == count($result)) {
            return;
        }

        $entry = new Application_Model_Cronjob();
        $this->fill($result, $entry);

        return $entry;
    }

    protected function fill($row, $model) {
        $model->setId($row->cronjobId)
                ->setServer($row->cronjobServer)
                ->setPath($row->cronjobPath)
                ->setUser($row->cronjobUser)
                ->setMinute($row->cronjobMinute)
                ->setHour($row->cronjobHour)
                ->setDayOfMonth($row->cronjobDayOfMonth)
                ->setMonth($row->cronjobMonth)
                ->setDayOfWeek($row->cronjobDayOfWeek);
    }
}
