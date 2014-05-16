<?php

namespace DateRepetition;

use DateTime;

class TimeProvider
{
	public function __construct()
	{
	}

	public function now()
	{
		return new DateTime('now');
	}

	public function date($timeDescription)
	{
		return new DateTime($timeDescription);
	}

	public function today()
	{
		return $this->now()->setTime(0, 0, 0);
	}
}


