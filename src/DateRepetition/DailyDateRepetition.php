<?php

namespace DateRepetition;

class DailyDateRepetition implements DateRepetition
{
	protected $minute;
	protected $hour;

	public function __construct($hour, $minute)
	{
		$this->setMinute($minute);
		$this->setHour($hour);
	}

	public static function newFromTimeString($timeString)
	{
		$dateTime = new DateTime($timeString);
		return new self($dateTime->format('G'), $dateTime->format('i'));
	}
	
 	public function getMinute()
 	{
 		return $this->minute;
 	}
 
 	public function setMinute($minute)
 	{
		if(! in_array($minute, range(0, 59))) {
			throw new InvalidArgumentException('Minute must be between 0 and 59');
		}
 		$this->minute = $minute;
 	}
 
 	public function getHour()
 	{
 		return $this->hour;
 	}
 
 	public function setHour($hour)
 	{
		if(! in_array($hour, range(0, 23))) {
			throw new InvalidArgumentException('Hour must be between 0 and 23');
		}
 		$this->hour = $hour;
 	}

    public function getCurrentDateTime()
    {
        $currentDateTime = new DateTime();
        $currentDateTime->setTime($this->hour, $this->minute);
        return $currentDateTime;
    }
}
