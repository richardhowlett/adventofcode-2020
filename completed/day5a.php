<?php

require_once('classes/Utility.class.php');
require_once('classes/Seat.class.php');

/**
 * Test input
 */
$result = Seat::getSeatId('FBFBBFFRLR');
Utility::log('result: ' . $result);
assert($result == 357);

$result = Seat::getSeatId('BFFFBBFRRR');
Utility::log('result: ' . $result);
assert($result == 567);

$result = Seat::getSeatId('FFFBBBFRRR');
Utility::log('result: ' . $result);
assert($result == 119);

$result = Seat::getSeatId('BBFFBBFRLL');
Utility::log('result: ' . $result);
assert($result == 820);

/**
 * Real Input
 */
$day5a_input = file_get_contents('puzzle_input/day5.txt');

$result = Seat::findHighestSeatId($day5a_input);
Utility::log('Answer: ' . $result);
