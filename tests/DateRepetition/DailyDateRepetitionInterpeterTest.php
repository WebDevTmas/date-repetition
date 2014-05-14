<?php

namespace DateRepetition;

use PHPUnit_Framework_TestCase;

class DailyDateRepetitionInterpeterTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function testNewFromString()
	{
        $dateRepetition = DateRepetitionInterpeter::newDateRepetitionFromString('daily at 9:13');
        $this->assertTrue($dateRepetition instanceof DailyDateRepetition);
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
