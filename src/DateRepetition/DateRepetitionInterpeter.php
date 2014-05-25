<?php

namespace DateRepetition;

use InvalidArgumentException;

/**
 * This class interpets strings and converts to a DateRepetition or convers DateRepetition to string
 */
class DateRepetitionInterpeter
{
    /**
     * "daily at 9:30" returns new DailyDateRepition(9, 30)
     * "weekly on monday at 8:15" returns new WeeklyDateRepetition('monday', 8, 15)
     * @param string
     * @return DateRepetition
     */
    public static function newDateRepetitionFromString($string)
    {
        $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        $regex = "/^(daily|weekly|monthly|yearly)( on (" . implode('|', $days) . "))?( at (.*))?$/";
        
        $result = preg_match($regex, $string, $timeStringMatches);
        if(1 !== $result) {
            throw new InvalidArgumentException('Inalid date repetition string');
        }

        $repetition = $timeStringMatches[1];
        $day = $timeStringMatches[3];
        $time = array_key_exists(5, $timeStringMatches) ? $timeStringMatches[5] : '0:00';

        if($repetition === 'daily' && $time != '') {
            return DailyDateRepetition::newFromTimeString($time);
        }

        if($repetition === 'weekly' && $day != '') {
            $timeString = trim('this ' . $day . ' ' . $time);
            return WeeklyDateRepetition::newFromTimeString($timeString);
        }

        if($repetition === 'monthly' || $repetition === 'yearly') {
            throw new \Exception('Not yet implemented');
        }

        throw new InvalidArgumentException('Inalid date repetition string');
    }

    /**
     * converts DateRepetition to a string accepted by 'newDateRepetitionFromString'
     *
     * @param DateRepetition
     * @return string
     */
    public static function convertDateRepetitionToString(DateRepetition $dateRepetition)
    {
        if($dateRepetition instanceof DailyDateRepetition) {
            $prefix = 'daily';
            $timeString = 'at ' . $dateRepetition->getHour() . ':' . $dateRepetition->getMinute();
        }

        if($dateRepetition instanceof WeeklyDateRepetition) {
            $prefix = 'weekly';
            $timeString = 'on ' . $dateRepetition->getDay() . ' ' . $timeString;
        }
        return $prefix . ' ' . $timeString;
    }
}
