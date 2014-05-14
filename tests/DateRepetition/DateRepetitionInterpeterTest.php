<?php

namespace DateRepetition;

use PHPUnit_Framework_TestCase;

class DateRepetitionInterpeterTest extends PHPUnit_Framework_TestCase
{
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
}
