<?php

namespace DateRepetition;

use DateTime;
use InvalidArgumentException;

class WeeklyDateRepetition extends DailyDateRepetition
{
    const MONDAY = 'monday';
    const TUESDAY = 'tuesday';
    const WEDNESDAY = 'wednesday';
    const THURSDAY = 'thursday';
    const FRIDAY = 'friday';
    const SATURDAY = 'saturday';
    const SUNDAY = 'sunday';

    protected $weekDays = array(
        self::MONDAY,
        self::TUESDAY,
        self::WEDNESDAY,
        self::THURSDAY,
        self::FRIDAY,
        self::SATURDAY,
        self::SUNDAY,
    );
    protected $day;

	public function __construct($day, $hour, $minute)
	{
        $this->setDay($day);
        parent::__construct($hour, $minute);
	}

	public static function newFromTimeString($timeString)
	{
        try {
    		$dateTime = new DateTime($timeString);
        } catch(\Exception $e) {
            throw new InvalidArgumentException('Time string must be valid, see DateTime for documentation');
        }
        return new self(strtolower($dateTime->format('l')), $dateTime->format('G'), $dateTime->format('i'));
	}
	
    public function setDay($day)
    {
        if(! in_array($day, $this->weekDays)) {
            throw new InvalidArgumentException('Argument is not a day of the week');
        }
        $this->day = $day;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function getCurrentDateTime()
    {
        return new DateTime('this ' . $this->day . ' ' . $this->hour . ':' . $this->minute);
    }
}
