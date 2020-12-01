<?php

use core_php_time_limit;

class long_poll {

    var $timelimit;

    var $checkinterval = 1;

    /** @var callable */
    var $checkfunc;
    /** @var callable */
    var $returnfunc;

    /**
     * long_poll constructor.
     *
     * @param callable $checkfunc
     * @param callable $returnfunc
     * @param int $interval
     * @throws \dml_exception
     */
    public function __construct(callable $checkfunc, callable $returnfunc, int $interval) {
        // get timelimit from confing in seconds.
        $this->timelimit = 5;
        core_php_time_limit::raise($this->timelimit + 10);
        $this->checkinterval = $interval;
        $this->checkfunc = $checkfunc;
        $this->returnfunc = $returnfunc;
    }

    /**
     * @return mixed
     */
    public function loop() {

        // Unblock the session if needed.

        while (time() - $_SERVER['REQUEST_TIME'] < $this->timelimit) {
            if (($this->checkfunc)()) {
                break;
            }
            sleep($this->checkinterval);
        }
        return ($this->returnfunc)();
    }
}
