<?php
class Api_Model_ListResponse {

    public $id;
    public $path;
    public $user;
    public $minute;
    public $hour;
    public $dayOfMonth;
    public $month;
    public $dayOfWeek;

    public function __construct(Cronphp_Model_Cronjob_Row $cronjob) {
        $this->id           = $cronjob->id;
        $this->path         = $cronjob->path;
        $this->user         = $cronjob->user;
        $this->minute       = $cronjob->minute;
        $this->hour         = $cronjob->hour;
        $this->dayOfMonth   = $cronjob->dayOfMonth;
        $this->month        = $cronjob->month;
        $this->dayOfWeek    = $cronjob->dayOfWeek;
    }
}
