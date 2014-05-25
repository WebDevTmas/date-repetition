<?php

namespace DateRepetition;

use DateTime;

/**
 * TimeProvider so that time can be mocked for better testing
 */
class TimeProvider
{
	public function __construct()
	{
	}

    /**
     * @return DateTime
     */
	public function now()
	{
		return new DateTime('now');
	}

    /**
     * @param string date string accepted by DateTime
     */
	public function date($timeDescription)
	{
		return new DateTime($timeDescription);
	}

    /**
     * @return DateTime at midnight today
     */
	public function today()
	{
		return $this->now()->setTime(0, 0, 0);
	}
}


