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
}
