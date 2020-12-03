<?php

class Password
{
    public static function isValidPassword($password, $match_count_min, $match_count_max, $match_char) {
        $match_count = substr_count($password, $match_char);

        if ($match_count_min <= $match_count && $match_count <= $match_count_max) {
            return true;
        } else {
            return false;
        }
    }

    public static function isValidDay2bPassword($password, $match_position_1, $match_position_2, $match_char) {
        if ((($password[$match_position_1 - 1] == $match_char) + ($password[$match_position_2 - 1] == $match_char)) == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function getValidPasswordCount($password_with_policy_data, $policy_type = '') {
        $valid_password_count = 0;
        foreach ($password_with_policy_data as $password_with_policy) {
            $matches = [];
            if (!preg_match('/(\d+)-(\d+) (.)\: (.+)/', $password_with_policy, $matches)) {
                throw new Exception('Invalid input "' . $password_with_policy . '"');
            }

            switch ($policy_type) {
                case 'day2b':
                    $valid_password_count += self::isValidDay2bPassword($matches[4], $matches[1], $matches[2], $matches[3]);
                    break;

                default:
                    $valid_password_count += self::isValidPassword($matches[4], $matches[1], $matches[2], $matches[3]);
            }
        }

        return $valid_password_count;
    }
}
