<?php
class Application_Model_Cronjob extends Cronphp_Model {

    protected $id;
    protected $server;
    protected $path;
    protected $user;
    protected $minute;
    protected $hour;
    protected $dayOfMonth;
    protected $month;
    protected $dayOfWeek;

    public function setId($id) {
        $this->id = (int) $id;

        return $this;
    }

    public function setServer($server) {
        $this->server = (string) $server;

        return $this;
    }

    public function setPath($path) {
        $this->path = (string) $path;

        return $this;
    }

    public function setUser($user) {
        $this->user = (string) $user;

        return $this;
    }

    public function setMinute($minute) {
        $this->minute = (string) $minute;

        return $this;
    }

    public function setHour($hour) {
        $this->hour = (string) $hour;

        return $this;
    }

    public function setDayOfMonth($dayOfMonth) {
        $this->dayOfMonth = (string) $dayOfMonth;

        return $this;
    }

    public function setMonth($month) {
        $this->month = (string) $month;

        return $this;
    }

    public function setDayOfWeek($dayOfWeek) {
        $this->dayOfWeek = (string) $dayOfWeek;

        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function getServer() {
        return $this->server;
    }

    public function getPath() {
        return $this->path;
    }

    public function getUser() {
        return $this->user;
    }

    public function getMinute() {
       return  $this->minute;
    }

    public function getHour() {
        return $this->hour;
    }

    public function getDayOfMonth() {
        return $this->dayOfMonth;
    }

    public function getMonth() {
        return $this->month;
    }

    public function getDayOfWeek() {
        return $this->dayOfWeek;
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
