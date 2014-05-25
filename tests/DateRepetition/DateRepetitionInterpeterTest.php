<?php

namespace DateRepetition;

use PHPUnit_Framework_TestCase;

class DateRepetitionInterpeterTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @test
	 */
	public function testNewHourlyFromString()
	{
        $dateRepetition = DateRepetitionInterpeter::newDateRepetitionFromString('hourly at minute 48');
        $this->assertTrue($dateRepetition instanceof HourlyDateRepetition);
        $this->assertEquals(48, $dateRepetition->getMinute());
	}

	/**
	 * @test
	 */
	public function testNewDailyFromString()
	{
        $dateRepetition = DateRepetitionInterpeter::newDateRepetitionFromString('daily at 9:13');
        $this->assertTrue($dateRepetition instanceof DailyDateRepetition);
        $this->assertEquals(9, $dateRepetition->getHour());
        $this->assertEquals(13, $dateRepetition->getMinute());
	}

	/**
	 * @test
	 */
	public function testNewWeeklyFromString()
	{
        $dateRepetition = DateRepetitionInterpeter::newDateRepetitionFromString('weekly on monday');
        $this->assertTrue($dateRepetition instanceof WeeklyDateRepetition);
        $this->assertEquals('monday', $dateRepetition->getDay());
        $this->assertEquals(0, $dateRepetition->getHour());
        $this->assertEquals(0, $dateRepetition->getMinute());

        $dateRepetition = DateRepetitionInterpeter::newDateRepetitionFromString('weekly on monday at 9:13');
        $this->assertTrue($dateRepetition instanceof WeeklyDateRepetition);
        $this->assertEquals('monday', $dateRepetition->getDay());
        $this->assertEquals(9, $dateRepetition->getHour());
        $this->assertEquals(13, $dateRepetition->getMinute());
	}

    /**
     * @test
	 * @expectedException \InvalidArgumentException
     */
    public function testNewFromInvalidString()
    {
        $dateRepetition = DateRepetitionInterpeter::newDateRepetitionFromString('invalidly at unknown');
    }

    /**
     * @test
     */
    public function testConverDateRepetitionToString()
    {
        $hourly = new HourlyDateRepetition(28);
        $hourlyString = DateRepetitionInterpeter::convertDateRepetitionToString($hourly);
        $this->assertEquals('hourly at minute 28', $hourlyString);

        $daily = new DailyDateRepetition(14, 28);
        $dailyString = DateRepetitionInterpeter::convertDateRepetitionToString($daily);
        $this->assertEquals('daily at 14:28', $dailyString);

        $weekly = new WeeklyDateRepetition(WeeklyDateRepetition::WEDNESDAY, 14, 28);
        $weeklyString = DateRepetitionInterpeter::convertDateRepetitionToString($weekly);
        $this->assertEquals('weekly on wednesday at 14:28', $weeklyString);
    }
}
