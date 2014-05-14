<?php

namespace DateRepetition;

use PHPUnit_Framework_TestCase;

class DailyDateRepetitionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function testCreationFromTimeString()
	{
        $dateRepetition = DailyDateRepetition::createFromTimeString('9:13');
        $this->assertEquals(9, $dateRepetition->getHour());
        $this->assertEquals(13, $dateRepetition->getMinutes());
	}
}
