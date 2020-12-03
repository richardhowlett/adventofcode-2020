<?php

require_once('classes/Utility.class.php');
require_once('classes/RoutePlanner.class.php');

/**
 * Test input
 */
$route_planner_test_1 = new RoutePlanner('..##.......
#...#...#..
.#....#..#.
..#.#...#.#
.#...##..#.
..#.##.....
.#.#.#....#
.#........#
#.##...#...
#...##....#
.#..#...#.#');
$result = $route_planner_test_1->testVector(3, 1);
assert($result === 7, 'Didn\'t return 7');

/**
 * Real Input
 */
$day3a_input = file_get_contents('puzzle_input/day3.txt');

$route_planner = new RoutePlanner($day3a_input);
$result = $route_planner->testVector(3, 1);
Utility::log('Answer: ' . $result);
