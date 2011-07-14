<?php
abstract class Cronphp_Mapper {
    protected $_dbTable;

    public function setDbTable($dbTable) {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }

        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }

        $this->_dbTable = $dbTable;

        return $this;
    }

    abstract protected function getDbTable();
    abstract protected function fill($row, $object);

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Log();

            $this->fill($row, $entry);

            $entries[] = $entry;
        }

        return $entries;
    }
}
