<?php

namespace DateRepetition;

use InvalidArgumentException;

class DateRepetitionInterpeter
{
    public static function newDateRepetitionFromString($string)
    {
        $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        $regex = "/^(daily|weekly)( on (" . implode('|', $days) . "))?( at (.*))?$/";
        
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

        throw new InvalidArgumentException('Inalid date repetition string');
    }
}
