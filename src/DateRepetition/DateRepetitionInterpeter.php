<?php

namespace DateRepetition;

use InvalidArgumentException;

/**
 * This class interpets strings and converts to a DateRepetition or convers DateRepetition to string
 */
class DateRepetitionInterpeter
{
    /**
     * "hourly at minute 15" returns new HourlyDateRepetition(15)
     * "daily at 9:30" returns new DailyDateRepition(9, 30)
     * "weekly on monday at 8:15" returns new WeeklyDateRepetition('monday', 8, 15)
     * @param string
     * @return DateRepetition
     */
    public static function newDateRepetitionFromString($string)
    {
        $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        $regex = "/^(hourly|daily|weekly|monthly|yearly)( on (" . implode('|', $days) . "))?( at (.*))?$/";
        
        $result = preg_match($regex, $string, $timeStringMatches);
        if(1 !== $result) {
            throw new InvalidArgumentException('Inalid date repetition string');
        }

        $repetition = $timeStringMatches[1];
        $day = $timeStringMatches[3];
        $time = array_key_exists(5, $timeStringMatches) ? $timeStringMatches[5] : '0:00';

        switch(true) {
            case $repetition === 'hourly' && $time != '':
                $minute = trim(str_replace('minute', '', $time));
                return new HourlyDateRepetition($minute);
            case $repetition === 'daily' && $time != '':
                return DailyDateRepetition::newFromTimeString($time);
            case $repetition === 'weekly' && $day != '':
                $timeString = trim('this ' . $day . ' ' . $time);
                return WeeklyDateRepetition::newFromTimeString($timeString);
            case $repetition === 'monthly' || $repetition === 'yearly':
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
        $dateString = '';
        if($dateRepetition instanceof HourlyDateRepetition) {
            $prefix = 'hourly';
            $timeString = ' at minute ' . $dateRepetition->getMinute();
        }

        if($dateRepetition instanceof DailyDateRepetition) {
            $prefix = 'daily';
            $timeString = ' at ' . $dateRepetition->getHour() . ':' . $dateRepetition->getMinute();
        }

        if($dateRepetition instanceof WeeklyDateRepetition) {
            $prefix = 'weekly';
            $dateString = ' on ' . $dateRepetition->getDay();
        }
        return $prefix . $dateString . $timeString;
    }
}
