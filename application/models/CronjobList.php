<?php

class Application_Model_CronjobList {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getByServer($server) {

        $stmt = $this->pdo->prepare('SELECT cronjobId FROM cronjobs WHERE cronjobServer = :server');
        $stmt->bindValue(':server', $server, PDO::PARAM_STR);
        $stmt->execute();

        $list = array();
        while ($cron = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $model = new Application_Model_Cronjob($this->pdo);
            $list[] = $model->getById($cron['cronjobId']);
        }
        return $list;
    }
}
