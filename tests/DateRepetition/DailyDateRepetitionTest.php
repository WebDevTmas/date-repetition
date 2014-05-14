<?php

namespace DateRepetition;

use PHPUnit_Framework_TestCase;

class DailyDateRepetitionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function testNewFromTimeString()
	{
        $dateRepetition = DailyDateRepetition::newFromTimeString('9:13');
        $this->assertEquals(9, $dateRepetition->getHour());
        $this->assertEquals(13, $dateRepetition->getMinute());
	}

    /**
     * @test
	 * @expectedException \InvalidArgumentException
     */
    public function testNewFromInvalidTimeString()
    {
        $dateRepetition = DailyDateRepetition::newFromTimeString('invalid');
    }

	/**
	 * @test
	 */
	public function testSetMinute()
	{
        $dateRepetition = DailyDateRepetition::newFromTimeString('9:13');
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

	/**
	 * @test
	 */
	public function testSetHour()
	{
        $dateRepetition = DailyDateRepetition::newFromTimeString('9:13');
        $dateRepetition->setHour(12);
        $this->assertEquals(12, $dateRepetition->getHour());
	}

	/**
	 * @test
	 * @expectedException \InvalidArgumentException     
	 */
	public function testSetInvalidHour()
	{
        $dateRepetition = DailyDateRepetition::newFromTimeString('9:13');
        $dateRepetition->setHour(24);
	}}
