<?php

require_once('classes/Utility.class.php');
require_once('classes/Password.class.php');

/**
 * Test input
 */
$result = Password::getValidPasswordCount([
    '1-3 a: abcde',
    '1-3 b: cdefg',
    '2-9 c: ccccccccc',
]);
assert($result === 2);

/**
 * Real Input
 */
$day2a_input = file_get_contents('puzzle_input/day2.txt');
$day2a_input = explode("\n", $day2a_input);

$result = Password::getValidPasswordCount($day2a_input);
Utility::log('Answer: ' . $result);
