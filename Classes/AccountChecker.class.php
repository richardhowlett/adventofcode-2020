<?php

class AccountChecker
{
    private $expenses = [];

    public function __construct($expenses)
    {
        $this->expenses = $expenses;
        $this->expenses_count = count($expenses);
    }

    public function findProductOfTwoExpensesThatSum($required_sum)
    {
        for ($i = 0; $i < $this->expenses_count; $i++) {
            for ($j = $i + 1; $j < $this->expenses_count; $j++) {
                $a = $this->expenses[$i];
                $b = $this->expenses[$j];

                if (($a + $b) == $required_sum) {
                    return ($a * $b);
                }
            }
        }

        throw new Exception('Invalid Input');
    }

    public function findProductOfThreeExpensesThatSum($required_sum)
    {
        for ($i = 0; $i < $this->expenses_count; $i++) {
            for ($j = $i + 1; $j < $this->expenses_count; $j++) {
                for ($k = $j + 1; $k < $this->expenses_count; $k++) {
                    $a = $this->expenses[$i];
                    $b = $this->expenses[$j];
                    $c = $this->expenses[$k];

                    if (($a + $b + $c) == $required_sum) {
                        return ($a * $b * $c);
                    }
                }
            }
        }

        throw new Exception('Invalid Input');
    }
}
