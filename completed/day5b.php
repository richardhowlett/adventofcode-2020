<?php

require_once('classes/Utility.class.php');
require_once('classes/Seat.class.php');

/**
 * Real Input
 */
$day5b_input = file_get_contents('puzzle_input/day5.txt');

$result = Seat::findMissingSeatId($day5b_input);
Utility::log('Answer: ' . $result);
