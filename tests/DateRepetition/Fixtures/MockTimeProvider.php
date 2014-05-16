<?php

namespace DateRepetition\Fixtures;

use DateRepetition\TimeProvider;
use DateTime;

class MockTimeProvider extends TimeProvider 
{
	protected $now;

	public function __construct(DateTime $now = null)
	{
		$this->now = null === $now ? new DateTime() : $now;
	}

	public function wait(DateInterval $interval)
	{
		$this->now->add($interval);
	}

	public function now()
	{
		return clone $this->now;
	}

 	public function setNow(DateTime $now)
 	{
 		$this->now = $now;
 	}
}

