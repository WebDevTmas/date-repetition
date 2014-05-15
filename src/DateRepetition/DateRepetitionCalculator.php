<?php

namespace DateRepetition;

use DateTime;

class DateRepetitionCalculator
{
    public function getNextOccurence(DateRepetition $dateRepetition, DateTime $datetime = null)
    {
        if(null === $datetime) {
            $datetime = new DateTime();
        }

        if($dateRepetition instanceof DailyDateRepetition) {
            return $this->getNextOccurenceForDailyDateRepetition($dateRepetition, $datetime);
        }

        if($dateRepetition instanceof WeeklyDateRepetition) {
            return $this->getNextOccurenceForWeeklyDateRepetition($dateRepetition, $datetime);
        }

        return new \Exception('Not yet implemented');
    }

    public function getPreviousOccurence(DateRepetition $dateRepetition, DateTime $datetime = null)
    {
        if(null === $datetime) {
            $datetime = new DateTime();
        }

        if($dateRepetition instanceof DailyDateRepetition) {
            return $this->getPreviousOccurenceForDailyDateRepetition($dateRepetition, $datetime);
        }

        if($dateRepetition instanceof WeeklyDateRepetition) {
            return $this->getPreviousOccurenceForWeeklyDateRepetition($dateRepetition, $datetime);
        }

        return new \Exception('Not yet implemented');
   }

   public function getNearestOccurence(DateRepetition $dateRepetition, DateTime $datetime = null)
   {
        if(null === $datetime) {
            $datetime = new DateTime();
        }

        $nextOccurence = $this->getNextOccurenceForDateRepetition($dateRepetition, $datetime);
        $prevOccurence = $this->getPreviousOccurenceForDateRepetition($dateRepetition, $datetime);
        $nextTimestamp = $nextOccurence->getTimeStamp();
        $prevTimestamp = $prevOccurence->getTimeStamp();
        $timestamp = $datetime->getTimeStamp();

        if(abs($nextTimestamp - $timestamp) > abs($prevTimestamp - $timestamp)) {
            return $prevOccurence;
        } else {
            return $nextOccurence;
        }

        return new \Exception('Not yet implemented');
   }

    protected function getPreviousOccurenceForDailyDateRepetition(DailyDateRepetition $dateRepetition, DateTime $datetime)
    {
        $datetimeString = $datetime->format('Y-m-d') . ' ' . $dateRepetition->getHour() . ':' . $dateRepetition->getMinute();
        $repetitionDatetime = new DateTime($datetimeString);
        if($repetitionDatetime < $datetime)
        {
            return $repetitionDatetime;
        }
        return $repetitionDatetime->modify('-1 day');
    }

    protected function getNextOccurenceForDailyDateRepetition(DailyDateRepetition $dateRepetition, DateTime $datetime)
    {
        $datetimeString = $datetime->format('Y-m-d') . ' ' . $dateRepetition->getHour() . ':' . $dateRepetition->getMinute();
        $repetitionDatetime = new DateTime($datetimeString);
        if($repetitionDatetime >= $datetime)
        {
            return $repetitionDatetime;
        }
        return $repetitionDatetime->modify('+1 day');
    }


    protected function getPreviousOccurenceForWeeklyDateRepetition(DailyDateRepetition $dateRepetition, DateTime $datetime)
    {
        $datetimeString = $datetime->format('Y-m-d') . ' ' . $dateRepetition->getHour() . ':' . $dateRepetition->getMinute();
        $repetitionDatetime = new DateTime($datetimeString);
        $repetitionDatetime->modify($dateRepetition->getDay());
        if($repetitionDatetime < $datetime) {
            return $repetitionDatetime;
        }
        return $repetitionDatetime->modify('-1 week');
    }

    protected function getNextOccurenceForWeeklyDateRepetition(DailyDateRepetition $dateRepetition, DateTime $datetime)
    {
        $datetimeString = $datetime->format('Y-m-d') . ' ' . $dateRepetition->getHour() . ':' . $dateRepetition->getMinute();
        $repetitionDatetime = new DateTime($datetimeString);
        $repetitionDatetime->modify($dateRepetition->getDay());
        if($repetitionDatetime >= $datetime) {
            return $repetitionDatetime;
        }
        return $repetitionDatetime->modify('+1 week');
    }
}
