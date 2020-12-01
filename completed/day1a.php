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
assert($account_checker_test_1->findProductOfTwoExpensesThatSum(2020) === 514579);

/**
 * Real Input
 */
$day1a_input = file_get_contents('puzzle_input/day1.txt');
$day1a_input = explode("\n", $day1a_input);

$account_checker = new AccountChecker($day1a_input);
$result = $account_checker->findProductOfTwoExpensesThatSum(2020);
Utility::log('Answer: ' . $result);
