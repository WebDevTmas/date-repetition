<?php

namespace DateRepetition;

class DateRepetitionInterpeter
{

    public static function createDateRepetitionFromString($string)
    {
        if(strpos($string, 'daily') === 0) {
            preg_match("/^(.*) at (.*)/", $string, $timeStringMatches);
            return DailyDateRepetition::newFromTimeString($timeStringMatches[2]);
        }
        throw \Exception('Inalid date repetition string');
    }
}
