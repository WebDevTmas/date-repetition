<?php

namespace DateRepetition;

use DateTime;
use InvalidArgumentException;

/**
 * Daily date repetition implements a daterepetition
 * it contains the time of a repetition that should occure daily
 */
class DailyDateRepetition extends HourlyDateRepetition
{
	protected $hour;

    /**
     * Sets minute and hour of new daily date repetition
     *
     * @param integer hour
     * @param integer minutes
     */
	public function __construct($hour, $minute)
	{
        parent::__construct($minute);
		$this->setHour($hour);
	}

    /**
     * Creates new DailyDateRepetition from string readable by DateTime
     *
     * @param string time string
     * @return DailyDateRepetition
     */
	public static function newFromTimeString($timeString)
	{
        try {
    		$dateTime = new DateTime($timeString);
        } catch(\Exception $e) {
            throw new InvalidArgumentException('Time string must be valid, see DateTime for documentation');
        }
		return new self($dateTime->format('G'), $dateTime->format('i'));
	}
	
    /**
     * Gets hours in repetition
     *
     * @return integer hour of repetition
     */
 	public function getHour()
 	{
 		return $this->hour;
 	}
 
    /** 
     * Sets hour of repetition
     *
     * @param integer hour
     * @return this
     */
 	public function setHour($hour)
 	{
		if(! in_array($hour, range(0, 23))) {
			throw new InvalidArgumentException('Hour must be between 0 and 23');
		}
 		$this->hour = $hour;
        return $this;
 	}
}
