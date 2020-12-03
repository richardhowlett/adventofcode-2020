<?php

require_once('classes/Utility.class.php');
require_once('classes/RoutePlanner.class.php');

/**
 * Test input
 */
$test_input = '..##.......
#...#...#..
.#....#..#.
..#.#...#.#
.#...##..#.
..#.##.....
.#.#.#....#
.#........#
#.##...#...
#...##....#
.#..#...#.#';

$tree_total = 1;

$route_planner = new RoutePlanner($test_input);
$result = $route_planner->testVector(1, 1);
assert($result === 2);
$tree_total *= $result;

$result = $route_planner->testVector(3, 1);
assert($result === 7);
$tree_total *= $result;

$result = $route_planner->testVector(5, 1);
assert($result === 3);
$tree_total *= $result;

$result = $route_planner->testVector(7, 1);
assert($result === 4);
$tree_total *= $result;

$result = $route_planner->testVector(1, 2);
assert($result === 2);
$tree_total *= $result;

assert($tree_total === 336);

/**
 * Real Input
 */
$day3a_input = file_get_contents('puzzle_input/day3.txt');

$tree_total = 1;

$route_planner = new RoutePlanner($day3a_input);
$result = $route_planner->testVector(1, 1);
Utility::log('count: ' . $result);
$tree_total *= $result;

$result = $route_planner->testVector(3, 1);
Utility::log('count: ' . $result);
$tree_total *= $result;

$result = $route_planner->testVector(5, 1);
Utility::log('count: ' . $result);
$tree_total *= $result;

$result = $route_planner->testVector(7, 1);
Utility::log('count: ' . $result);
$tree_total *= $result;

$result = $route_planner->testVector(1, 2);
Utility::log('count: ' . $result);
$tree_total *= $result;

Utility::log('Answer: ' . $tree_total);
