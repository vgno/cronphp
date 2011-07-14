<?php
class Application_Model_Log extends Cronphp_Model {

    protected $id;
    protected $cronjobId;
    protected $cronjob;
    protected $server;
    protected $start;
    protected $end;
    protected $runTime;
    protected $response;
    protected $output;

    public function setId($id) {
        $this->id = (int) $id;

        return $this;
    }

    public function setCronjobId($cronjobId) {
        $this->cronjobId = (int) $cronjobId;

        return $this;
    }

    public function setCronjob($cronjob) {
        $this->cronjob =  $cronjob;

        return $this;
    }

    public function setServer($server) {
        $this->server = (string) $server;

        return $this;
    }

    public function setStart($start) {
        if ($start instanceof \DateTime) {
            $this->start = $start;
        } else {
            $this->start = new \DateTime($start);
        }

        return $this;
    }

    public function setEnd($end) {
        if ($end instanceof \DateTime) {
            $this->end = $end;
        } else {
            $this->end = new \DateTime($end);
        }

        return $this;
    }

    public function setRunTime($runTime) {
        $this->runTime = (float) $runTime;

        return $this;
    }

    public function setResponse($response) {
        $this->response = (int) $response;

        return $this;
    }

    public function setOutput($output) {
        $this->output = (string) $output;

        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function getCronjobId() {
        return $this->cronjobId;
    }

    public function getCronjob() {
        return $this->cronjob;
    }

    public function getServer() {
        return $this->server;
    }

    public function getStart($format = 'Y-m-d H:i:s') {
        return $this->start->format($format);
    }

    public function getEnd($format = 'Y-m-d H:i:s') {
        return $this->end->format($format);
    }

    public function getRunTime() {
        return $this->runTime;
    }

    public function getResponse() {
        return $this->response;
    }

    public function getOutput() {
        return $this->output;
    }
}
