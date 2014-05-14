<?php

namespace DateRepetition;

use InvalidArgumentException;

class DateRepetitionInterpeter
{
    public static function newDateRepetitionFromString($string)
    {
        if(strpos($string, 'daily') === 0) {
            preg_match("/^(.*) at (.*)/", $string, $timeStringMatches);
            return DailyDateRepetition::newFromTimeString($timeStringMatches[2]);
        }
        throw new InvalidArgumentException('Inalid date repetition string');
    }
}
