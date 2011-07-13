<?php
class Application_Model_CronjobMapper extends Cronphp_Mapper {
    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Cronjob');
        }

        return $this->_dbTable;
    }

    public function save(Application_Model_Cronjob $cronjob) {
        $data = array(
            'email'   => $cronjob->getEmail(),
            'comment' => $cronjob->getComment(),
            'created' => date('Y-m-d H:i:s'),
        );

        if (null === ($id = $cronjob->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Cronjob $cronjob) {
        $result = $this->getDbTable()->find($id);

        if (0 == count($result)) {
            return;
        }

        $row = $result->current();

        $cronjob->setId($row->cronjobId)
                ->setServer($row->cronjobServer)
                ->setPath($row->cronjobPath)
                ->setUser($row->cronjobUser)
                ->setMinute($row->cronjobMinute)
                ->setHour($row->cronjobHour)
                ->setDayOfMonth($row->cronjobDayOfMonth)
                ->setMonth($row->cronjobMonth)
                ->setDayOfWeek($row->cronjobDayOfWeek);
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Cronjob();

            $entry->setId($row->cronjobId)
                    ->setServer($row->cronjobServer)
                    ->setPath($row->cronjobPath)
                    ->setUser($row->cronjobUser)
                    ->setMinute($row->cronjobMinute)
                    ->setHour($row->cronjobHour)
                    ->setDayOfMonth($row->cronjobDayOfMonth)
                    ->setMonth($row->cronjobMonth)
                    ->setDayOfWeek($row->cronjobDayOfWeek);

            $entries[] = $entry;
        }

        return $entries;
    }

    public function getByPath($path, $server) {
        $stmt = $this->pdo->prepare('SELECT cronjobId FROM cronjobs WHERE cronjobPath = :path AND cronjobServer = :server LIMIT 1');
        $stmt->bindValue(':path', $path, PDO::PARAM_STR);
        $stmt->bindValue(':server', $server, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->getById($result['cronjobId']);
    }
}
