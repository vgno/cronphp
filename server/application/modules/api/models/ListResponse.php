<?php
class Api_Model_ListResponse extends Application_Model_Cronjob {

    public $path;
    public $user;
    public $minute;
    public $hour;
    public $dayOfMonth;
    public $month;
    public $dayOfWeek;

    public function __construct(Application_Model_Cronjob $cronjob) {
        $this->path         = $cronjob->getPath();
        $this->user         = $cronjob->getUser();
        $this->minute       = $cronjob->getMinute();
        $this->hour         = $cronjob->getHour();
        $this->dayOfMonth   = $cronjob->getDayOfMonth();
        $this->month        = $cronjob->getMonth();
        $this->dayOfWeek    = $cronjob->getDayOfWeek();
    }
}
