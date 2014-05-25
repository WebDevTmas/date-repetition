<?php

namespace DateRepetition;

use DateTime;
use InvalidArgumentException;

/**
 * Extends daily date repetition
 * Next to the time it should occur weekly it also takes the day
 */
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

    /**
     * @param string day of repetition (monday, tuesday, wednesday, thursday, friday, saturday, sunday)
     * @param integer hour of repetition
     * @param integer minute of repetition
     */
	public function __construct($day, $hour, $minute)
	{
        $this->setDay($day);
        parent::__construct($hour, $minute);
	}

    /**
     * Creates new weekly date repetition from time string accepted by DateTime
     *
     * @param string time string accepted by DateTime
     * @return WeeklyDateRepetition
     */
	public static function newFromTimeString($timeString)
	{
        try {
    		$dateTime = new DateTime($timeString);
        } catch(\Exception $e) {
            throw new InvalidArgumentException('Time string must be valid, see DateTime for documentation');
        }
        return new self(strtolower($dateTime->format('l')), $dateTime->format('G'), $dateTime->format('i'));
	}
	
    /**
     * Sets weekday of the weekly date repetition
     *
     * @param string day of the week (monday, tuesday, wednesday, thursday, friday, saturday, sunday)
     * @return this
     */
    public function setDay($day)
    {
        if(! in_array($day, $this->weekDays)) {
            throw new InvalidArgumentException('Argument is not a day of the week');
        }
        $this->day = $day;
        return $this;
    }

    /**
     * Gets weekday of this weekly date repetition
     *
     * @return string week day of this weekly date repetition
     */
    public function getDay()
    {
        return $this->day;
    }
}
