<?php
class Cronphp_Model_Cronjob extends Zend_Db_Table_Abstract {
    protected $_name = 'cronjobs';
    protected $_rowClass = 'Cronphp_Model_Cronjob_Row';

    public function findByPath($id, $path, $server) {
        return $this->fetchRow($this->select()
            ->where('id = ?', $id)
            ->where('path = ?', $path)
            ->where('server = ?', $server)
        );
    }
}

class Cronphp_Model_Cronjob_Row extends Zend_Db_Table_Row_Abstract {

    public function __toString() {
        var_dump($this);
        return $this->name;
    }
}
