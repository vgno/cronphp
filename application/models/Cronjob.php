<?php
class Application_Model_Cronjob {

    public $id;
    public $server;
    public $path;
    public $user;
    public $minute;
    public $hour;
    public $dayOfMonth;
    public $month;
    public $dayOfWeek;

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM cronjobs WHERE cronjobId = :id LIMIT 1');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $result['cronjobId'];
        $this->server = $result['cronjobServer'];
        $this->path = $result['cronjobPath'];
        $this->user = $result['cronjobUser'];
        $this->minute = $result['cronjobMinute'];
        $this->hour = $result['cronjobHour'];
        $this->dayOfMonth = $result['cronjobDayOfMonth'];
        $this->month = $result['cronjobMonth'];
        $this->dayOfWeek = $result['cronjobDayOfWeek'];

        return $this;
    }

    public function getByPath($path, $server) {
        $stmt = $this->pdo->prepare('SELECT cronjobId FROM cronjobs WHERE cronjobPath = :path AND cronjobServer = :server LIMIT 1');
        $stmt->bindValue(':path', $path, PDO::PARAM_STR);
        $stmt->bindValue(':server', $server, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->getById($result['cronjobId']);
    }

    public function save() {
        $sql = 'INSERT INTO cronjobs SET
            cronjobServer = "' . $this->server . '",
            cronjobPath = "' . $this->path . '",
            cronjobUser = "' . $this->user . '",
            cronjobMinute = "' . $this->minute. '",
            cronjobHour = "' . $this->hour . '",
            cronjobDayOfMonth = "' . $this->dayOfMonth . '",
            cronjobMonth = "' . $this->month . '",
            cronjobDayOfWeek = "' . $this->dayOfWeek . '"';

        $this->pdo->query($sql);
    }

    public function __toString() {
        return $this->path;
    }
}
