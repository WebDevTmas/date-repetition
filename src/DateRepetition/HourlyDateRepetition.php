<?php

namespace DateRepetition;

use DateTime;
use InvalidArgumentException;

/**
 * Hourly date repetition implements a daterepetition
 * it contains the time of a repetition that should occure hourly
 */
class HourlyDateRepetition implements DateRepetition
{
	protected $minute;

    /**
     * Sets minute and hour of new hourly date repetition
     *
     * @param integer hour
     * @param integer minutes
     */
	public function __construct($minute)
	{
		$this->setMinute($minute);
	}

    /**
     * Creates new HourlyDateRepetition from string readable by DateTime
     *
     * @param string time string
     * @return HourlyDateRepetition
     */
	public static function newFromTimeString($timeString)
	{
        try {
    		$dateTime = new DateTime($timeString);
        } catch(\Exception $e) {
            throw new InvalidArgumentException('Time string must be valid, see DateTime for documentation');
        }
		return new self($dateTime->format('i'));
	}
	
    /**
     * Returns the minutes in repetition
     *
     * @return integer minutes
     */
 	public function getMinute()
 	{
 		return $this->minute;
 	}
 
    /**
     * Sets minutes in repetition
     *
     * @param integer minutes
     * @return this
     */   
  	public function setMinute($minute)
 	{
		if(! in_array($minute, range(0, 59))) {
			throw new InvalidArgumentException('Minute must be between 0 and 59');
		}
 		$this->minute = $minute;
        return $this;
 	}
}
