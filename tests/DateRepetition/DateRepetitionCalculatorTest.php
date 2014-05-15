<?php

namespace DateRepetition;

use PHPUnit_Framework_TestCase;
use DateTime;

class DateRepetitionCalculatorTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function testNextOccuranceDaily()
	{
        $dateTime = new DateTime('2014-05-14 8:13');
        $dateRepetitionCalculator = new DateRepetitionCalculator();

        $dateRepetition = new DailyDateRepetition(8, 12);
        $nextOccurance = $dateRepetitionCalculator->getNextOccurence($dateRepetition, $dateTime);
        $this->assertEquals(new DateTime('2014-05-15 8:12'), $nextOccurance);

        $dateRepetition = new DailyDateRepetition(8, 14);
        $nextOccurance = $dateRepetitionCalculator->getNextOccurence($dateRepetition, $dateTime);
        $this->assertEquals(new DateTime('2014-05-14 8:14'), $nextOccurance);
        
        $dateRepetition = new DailyDateRepetition(8, 13);
        $nextOccurance = $dateRepetitionCalculator->getNextOccurence($dateRepetition, $dateTime);
        $this->assertEquals(new DateTime('2014-05-14 8:13'), $nextOccurance);		
    }

    /**
     * @test
     */
    public function testPreviousOccuranceDaily()
    {
        $dateTime = new DateTime('2014-05-14 8:13');
        $dateRepetitionCalculator = new DateRepetitionCalculator();

        $dateRepetition = new DailyDateRepetition(8, 12);
        $nextOccurance = $dateRepetitionCalculator->getPreviousOccurence($dateRepetition, $dateTime);
        $this->assertEquals(new DateTime('2014-05-14 8:12'), $nextOccurance);

        $dateRepetition = new DailyDateRepetition(8, 14);
        $nextOccurance = $dateRepetitionCalculator->getPreviousOccurence($dateRepetition, $dateTime);
        $this->assertEquals(new DateTime('2014-05-13 8:14'), $nextOccurance);
        
        $dateRepetition = new DailyDateRepetition(8, 13);
        $nextOccurance = $dateRepetitionCalculator->getPreviousOccurence($dateRepetition, $dateTime);
        $this->assertEquals(new DateTime('2014-05-13 8:13'), $nextOccurance);
    }

    /**
     * @test
     */
    public function testNearestOccuranceDaily()
    {

        $dateRepetition = new DailyDateRepetition(11, 15);
        $dateRepetitionCalculator = new DateRepetitionCalculator();

        $dateTime = new DateTime('2014-05-14 23:14');
        $nearestOccurence = $dateRepetitionCalculator->getNearestOccurence($dateRepetition, $dateTime);
        $this->assertEquals(new DateTime('2014-05-14 11:15'), $nearestOccurence);

        $dateTime = new DateTime('2014-05-13 23:16');
        $nearestOccurence = $dateRepetitionCalculator->getNearestOccurence($dateRepetition, $dateTime);
        $this->assertEquals(new DateTime('2014-05-14 11:15'), $nearestOccurence);
    }
}
