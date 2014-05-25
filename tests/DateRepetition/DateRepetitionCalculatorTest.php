<?php

namespace DateRepetition;

use PHPUnit_Framework_TestCase;
use DateTime;
use DateInterval;
use DateRepetition\Fixtures\MockTimeProvider;

class DateRepetitionCalculatorTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function testNextOccuranceHourly()
	{
        $timeProvider = new MockTimeProvider(new DateTime('2014-05-14 8:11'));
        $dateRepetitionCalculator = new DateRepetitionCalculator($timeProvider);
        $dateRepetition = new HourlyDateRepetition(12);

        $nextOccurance = $dateRepetitionCalculator->getNextOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 8:12'), $nextOccurance);

        $timeProvider->wait(new DateInterval('PT1M'));
        $nextOccurance = $dateRepetitionCalculator->getNextOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 8:12'), $nextOccurance);
       
        $timeProvider->wait(new DateInterval('PT1M')); 
        $nextOccurance = $dateRepetitionCalculator->getNextOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 9:12'), $nextOccurance);		
    }

    /**
     * @test
     */
    public function testPreviousOccuranceHourly()
    {
        $timeProvider = new MockTimeProvider(new DateTime('2014-05-14 8:11'));
        $dateRepetitionCalculator = new DateRepetitionCalculator($timeProvider);
        $dateRepetition = new HourlyDateRepetition(12);

        $prevOccurance = $dateRepetitionCalculator->getPreviousOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 7:12'), $prevOccurance);

        $timeProvider->wait(new DateInterval('PT1M'));
        $prevOccurance = $dateRepetitionCalculator->getPreviousOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 7:12'), $prevOccurance);
        
        $timeProvider->wait(new DateInterval('PT1M'));
        $prevOccurance = $dateRepetitionCalculator->getPreviousOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 8:12'), $prevOccurance);
    }

    /**
     * @test
     */
    public function testNearestOccuranceHourly()
    {
        $timeProvider = new MockTimeProvider(new DateTime('2014-05-14 8:46'));
        $dateRepetitionCalculator = new DateRepetitionCalculator($timeProvider);
        $dateRepetition = new HourlyDateRepetition(15);

        $nearestOccurence = $dateRepetitionCalculator->getNearestOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 9:15'), $nearestOccurence);

        $timeProvider->wait(new DateInterval('PT1H'));
        $nearestOccurence = $dateRepetitionCalculator->getNearestOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 10:15'), $nearestOccurence);
    }

	/**
	 * @test
	 */
	public function testNextOccuranceDaily()
	{
        $timeProvider = new MockTimeProvider(new DateTime('2014-05-14 8:11'));
        $dateRepetitionCalculator = new DateRepetitionCalculator($timeProvider);
        $dateRepetition = new DailyDateRepetition(8, 12);

        $nextOccurance = $dateRepetitionCalculator->getNextOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 8:12'), $nextOccurance);

        $timeProvider->wait(new DateInterval('PT1M'));
        $nextOccurance = $dateRepetitionCalculator->getNextOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 8:12'), $nextOccurance);
       
        $timeProvider->wait(new DateInterval('PT1M')); 
        $nextOccurance = $dateRepetitionCalculator->getNextOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-15 8:12'), $nextOccurance);		
    }

    /**
     * @test
     */
    public function testPreviousOccuranceDaily()
    {
        $timeProvider = new MockTimeProvider(new DateTime('2014-05-14 8:11'));
        $dateRepetitionCalculator = new DateRepetitionCalculator($timeProvider);
        $dateRepetition = new DailyDateRepetition(8, 12);

        $prevOccurance = $dateRepetitionCalculator->getPreviousOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-13 8:12'), $prevOccurance);

        $timeProvider->wait(new DateInterval('PT1M'));
        $prevOccurance = $dateRepetitionCalculator->getPreviousOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-13 8:12'), $prevOccurance);
        
        $timeProvider->wait(new DateInterval('PT1M'));
        $prevOccurance = $dateRepetitionCalculator->getPreviousOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 8:12'), $prevOccurance);
    }

    /**
     * @test
     */
    public function testNearestOccuranceDaily()
    {
        $timeProvider = new MockTimeProvider(new DateTime('2014-05-14 8:11'));
        $dateRepetitionCalculator = new DateRepetitionCalculator($timeProvider);
        $dateRepetition = new DailyDateRepetition(11, 15);

        $nearestOccurence = $dateRepetitionCalculator->getNearestOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 11:15'), $nearestOccurence);

        $timeProvider->wait(new DateInterval('PT4H'));
        $nearestOccurence = $dateRepetitionCalculator->getNearestOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 11:15'), $nearestOccurence);
    }

	/**
	 * @test
	 */
	public function testNextOccuranceWeekly()
	{
        $timeProvider = new MockTimeProvider(new DateTime('2014-05-13 8:11'));
        $dateRepetitionCalculator = new DateRepetitionCalculator($timeProvider);
        $dateRepetition = new WeeklyDateRepetition('tuesday', 8, 12);

        $nextOccurance = $dateRepetitionCalculator->getNextOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-13 8:12'), $nextOccurance);

        $timeProvider->wait(new DateInterval('PT1M')); 
        $nextOccurance = $dateRepetitionCalculator->getNextOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-13 8:12'), $nextOccurance);

        $timeProvider->wait(new DateInterval('PT1M')); 
        $nextOccurance = $dateRepetitionCalculator->getNextOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-20 8:12'), $nextOccurance);		
    }

    /**
     * @test
     */
    public function testPreviousOccuranceWeekly()
    {
        $timeProvider = new MockTimeProvider(new DateTime('2014-05-14 8:11'));
        $dateRepetitionCalculator = new DateRepetitionCalculator($timeProvider);
        $dateRepetition = new WeeklyDateRepetition('wednesday', 8, 12);

        $prevOccurance = $dateRepetitionCalculator->getPreviousOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-07 8:12'), $prevOccurance);

        $timeProvider->wait(new DateInterval('PT1M'));
        $prevOccurance = $dateRepetitionCalculator->getPreviousOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-07 8:12'), $prevOccurance);
        
        $timeProvider->wait(new DateInterval('PT1M'));
        $prevOccurance = $dateRepetitionCalculator->getPreviousOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 8:12'), $prevOccurance);
    }

    /**
     * @test
     */
    public function testNearestOccuranceWeekly()
    {
        $timeProvider = new MockTimeProvider(new DateTime('2014-05-17 8:11'));
        $dateRepetitionCalculator = new DateRepetitionCalculator($timeProvider);
        $dateRepetition = new WeeklyDateRepetition('wednesday', 11, 15);

        $nearestOccurence = $dateRepetitionCalculator->getNearestOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-14 11:15'), $nearestOccurence);

        $timeProvider->wait(new DateInterval('P1D'));
        $nearestOccurence = $dateRepetitionCalculator->getNearestOccurence($dateRepetition);
        $this->assertEquals(new DateTime('2014-05-21 11:15'), $nearestOccurence);
    }
}
