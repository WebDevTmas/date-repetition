<?php

spl_autoload_register(function ($class) {
	$availableClasses = array(
        'DateRepetition\HourlyDateRepetition',
		'DateRepetition\DailyDateRepetition',
        'DateRepetition\WeeklyDateRepetition',
		'DateRepetition\DateRepetitionInterpeter',
        'DateRepetition\DateRepetitionCalculator',
        'DateRepetition\DateRepetition',
        'DateRepetition\TimeProvider',
	);
	if(in_array($class, $availableClasses)) {
		require(__DIR__ . '/../' . strtr($class, '\\', '/') . '.php');
	}
});


