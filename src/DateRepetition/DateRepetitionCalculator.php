<?php

namespace DateRepetition;

use DateTime;

/**
 * DateRepetitionCalculator offers functionality to find occurences of a date repetition
 *
 * @todo implement yearly, monthly and hourly
 */
class DateRepetitionCalculator
{
    protected $timeProvider;

    /** 
     * Accepts timeprovider and uses it for the calculations for a better testability
     *
     * @param TimeProvider
     */
    public function __construct(TimeProvider $timeProvider)
    {
        $this->timeProvider = $timeProvider;
    }

    /** 
     * Find next occurence of date repetition
     *
     * @param DateRepetition 
     * @param DateTime next occurence from this date (null == now)
     * @return DateTime date/time of next occurence
     */
    public function getNextOccurence(DateRepetition $dateRepetition, DateTime $datetime = null)
    {
        if(null === $datetime) {
            $datetime = $this->timeProvider->now();
        }

        if($dateRepetition instanceof DailyDateRepetition) {
            return $this->getNextOccurenceForDailyDateRepetition($dateRepetition, $datetime);
        }

        if($dateRepetition instanceof WeeklyDateRepetition) {
            return $this->getNextOccurenceForWeeklyDateRepetition($dateRepetition, $datetime);
        }

        return new \Exception('Not yet implemented');
    }

    /**
     * @param DateRepetition
     * @param DateTime previous occurence from this date (null == now)
     * @return DateTime date/time of previous occurence
     */
    public function getPreviousOccurence(DateRepetition $dateRepetition, DateTime $datetime = null)
    {
        if(null === $datetime) {
            $datetime = $this->timeProvider->now();
        }

        if($dateRepetition instanceof DailyDateRepetition) {
            return $this->getPreviousOccurenceForDailyDateRepetition($dateRepetition, $datetime);
        }

        if($dateRepetition instanceof WeeklyDateRepetition) {
            return $this->getPreviousOccurenceForWeeklyDateRepetition($dateRepetition, $datetime);
        }

        return new \Exception('Not yet implemented');
   }

   /**
    * @param DateRepetition
    * @param DateTime date/time nearest occurence that's returned from this date (null == now)
    * @return DateTime date/time of nearest occurence (before or after)
    */
   public function getNearestOccurence(DateRepetition $dateRepetition, DateTime $datetime = null)
   {
        if(null === $datetime) {
            $datetime = $this->timeProvider->now();
        }

        $nextOccurence = $this->getNextOccurence($dateRepetition, $datetime);
        $prevOccurence = $this->getPreviousOccurence($dateRepetition, $datetime);
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
