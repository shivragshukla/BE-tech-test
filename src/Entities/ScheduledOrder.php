<?php

namespace App\Entities;

use Carbon\Carbon;

class ScheduledOrder
{
    /**
     * The delivery date of this scheduled order.
     *
     * @var \Carbon\Carbon
     */
    protected $deliveryDate;

    /**
     * Is this delivery marked as a holiday that will be skipped.
     *
     * @var bool
     */
    protected $holiday = false;

    /**
     * Is this scheduled order an opt in order that is not part of the normal subscription's plan cycle.
     *
     * @var bool
     */
    protected $optIn = false;

    /**
     * Is this scheduled order part of the subscriptions normal plan cycle.
     *
     * @var bool
     */
    protected $interval = true;

    /**
     * ScheduledOrder constructor.
     *
     * @param \Carbon\Carbon     $deliveryDate
     * @param \App\Entities\bool $isInterval
     */
    public function __construct(Carbon $deliveryDate, bool $isInterval)
    {
        $this->deliveryDate = $deliveryDate;
        $this->interval     = $isInterval;
    }

    /**
     * get interval
     * 
     * @return boolean
     */
    public function isInterval() {
        return $this->interval;
    }

     /**
     * set holiday
     * 
     *  @var boolean
     */
    public function setHoliday(bool $holiday) {

        if ($holiday == true && $this->interval == true) {
            $this->holiday  = true;
        }else{
            $this->holiday  = false;
        }
    }

    /**
     * get holiday
     * 
     * @return boolean
     */
    public function isHoliday() {
        return $this->holiday;
    }

}