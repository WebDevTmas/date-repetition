<?php

namespace DateRepetition;

use PHPUnit_Framework_TestCase;

class WeeklyDateRepetitionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function testNewFromTimeString()
	{
        $dateRepetition = WeeklyDateRepetition::newFromTimeString('this monday 9:13');
        $this->assertEquals(9, $dateRepetition->getHour());
        $this->assertEquals(13, $dateRepetition->getMinute());
        $this->assertEquals('monday', $dateRepetition->getDay());
	}

	/**
	 * @test
	 */
	public function testSetDay()
	{
        $dateRepetition = WeeklyDateRepetition::newFromTimeString('this monday 9:13');
        $dateRepetition->setDay(WeeklyDateRepetition::TUESDAY);
        $this->assertEquals(WeeklyDateRepetition::TUESDAY, $dateRepetition->getDay());
	}

	/**
	 * @test
	 * @expectedException \InvalidArgumentException     
	 */
	public function testSetInvalidDay()
	{
        $dateRepetition = WeeklyDateRepetition::newFromTimeString('this monday 9:13');
        $dateRepetition->setDay('moonday');
	}

    public function testGetCurrentDateTime()
    {
        $dateRepetition = DateRepetitionInterpeter::newDateRepetitionFromString('weekly on monday at 9:13');
        $dateTime = $dateRepetition->getCurrentDateTime();

        $this->assertEquals(date('Y'), $dateTime->format('Y'));
        $this->assertEquals(date('m'), $dateTime->format('m'));

        $this->assertEquals('Monday', $dateTime->format('l'));
        $this->assertEquals('9', $dateTime->format('G'));
        $this->assertEquals('13', $dateTime->format('i'));
    }
}
