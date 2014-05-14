<?php

spl_autoload_register(function ($class) {
	$availableClasses = array(
		'DateRepetition\DailyDateRepetition',
		'DateRepetition\DateRepetitionInterpeter',
        'DateRepetition\DateRepetition',
	);
	if(in_array($class, $availableClasses)) {
		require(__DIR__ . '/../' . strtr($class, '\\', '/') . '.php');
	}
});


