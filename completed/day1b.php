<?php

require_once('classes/Utility.class.php');
require_once('classes/AccountChecker.class.php');

/**
 * Test input
 */
$account_checker_test_1 = new AccountChecker([
    1721,
    979,
    366,
    299,
    675,
    1456,
]);
assert($account_checker_test_1->findProductOfThreeExpensesThatSum(2020) === 241861950);

/**
 * Real Input
 */
$day1b_input = file_get_contents('puzzle_input/day1.txt');
$day1b_input = explode("\n", $day1b_input);

$account_checker = new AccountChecker($day1b_input);
$result = $account_checker->findProductOfThreeExpensesThatSum(2020);
Utility::log('Answer: ' . $result);
