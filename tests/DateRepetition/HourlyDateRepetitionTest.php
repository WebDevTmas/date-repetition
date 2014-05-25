<?php

namespace DateRepetition;

use PHPUnit_Framework_TestCase;

class HourlyDateRepetitionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function testNewFromTimeString()
	{
        $dateRepetition = HourlyDateRepetition::newFromTimeString('9:13');
        $this->assertEquals(13, $dateRepetition->getMinute());
	}

    /**
     * @test
	 * @expectedException \InvalidArgumentException
     */
    public function testNewFromInvalidTimeString()
    {
        $dateRepetition = HourlyDateRepetition::newFromTimeString('invalid');
    }

	/**
	 * @test
	 */
	public function testSetMinute()
	{
        $dateRepetition = HourlyDateRepetition::newFromTimeString('9:13');
        $dateRepetition->setMinute(18);
        $this->assertEquals(18, $dateRepetition->getMinute());
	}

	/**
	 * @test
	 * @expectedException \InvalidArgumentException     
	 */
	public function testSetInvalidMinute()
	{
        $dateRepetition = DailyDateRepetition::newFromTimeString('9:13');
        $dateRepetition->setMinute(60);
	}
}
