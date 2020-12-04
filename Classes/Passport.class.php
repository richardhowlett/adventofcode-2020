<?php

class Passport
{
    private static $required_data_fields = [
        'byr',
        'iyr',
        'eyr',
        'hgt',
        'hcl',
        'ecl',
        'pid',
    ];

    public static function isValidPassport($passport_details) {
        foreach (self::$required_data_fields as $required_data_field) {
            //Utility::log('required field: ' . $required_data_field);
            if (!array_key_exists($required_data_field, $passport_details)) {
                //Utility::log('  missing');
                return false;
            }

            //Utility::log('  OK');
        }

        return true;
    }

    public static function validateField($field, $value) {
        //Utility::log($field);
        //Utility::log($value);

        switch ($field) {
            case 'byr':
                if (!preg_match('/^[\d]{4}$/', $value)) {
                    //Utility::log('  invalid');
                    return false;
                }
                if ($value < 1920 || $value > 2002) {
                    //Utility::log('  invalid');
                    return false;
                }
                break;

            case 'iyr':
                if (!preg_match('/^[\d]{4}$/', $value)) {
                    //Utility::log('  invalid');
                    return false;
                }
                if ($value < 2010 || $value > 2020) {
                    //Utility::log('  invalid');
                    return false;
                }
                break;

            case 'eyr':
                if (!preg_match('/^[\d]{4}$/', $value)) {
                    //Utility::log('  invalid');
                    return false;
                }
                if ($value < 2020 || $value > 2030) {
                    //Utility::log('  invalid');
                    return false;
                }
                break;

            case 'hgt':
                $matches = [];
                if (!preg_match('/^([\d]+)(cm|in)$/', $value, $matches)) {
                    //Utility::log('  invalid');
                    return false;
                }
                if ($matches[2] == 'cm') {
                    if ($value < 150 || $value > 193) {
                        //Utility::log('  invalid');
                        return false;
                    }
                } elseif ($matches[2] == 'in') {
                    if ($value < 59 || $value > 76) {
                        //Utility::log('  invalid');
                        return false;
                    }
                } else {
                    //Utility::log('  invalid');
                    return false;
                }
                break;

            case 'hcl':
                if (!preg_match('/^#[0-9a-f]{6}$/', $value)) {
                    //Utility::log('  invalid');
                    return false;
                }
                break;

            case 'ecl':
                if (!in_array($value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'])) {
                    //Utility::log('  invalid');
                    return false;
                }
                break;

            case 'pid':
                $matches = [];
                if (!preg_match('/^[0-9]{9}$/', $value)) {
                    //Utility::log('  invalid');
                    return false;
                }
                break;

            case 'cid':
            default:
        }

        //Utility::log('  valid');

        return true;
    }

    public static function isValidBPassport($passport_details) {
        foreach ($passport_details as $passport_detail_key => $passport_detail) {
            $result = self::validateField($passport_detail_key, $passport_detail);
            if (!$result) {
                return false;
            }
        }

        return self::isValidPassport($passport_details);
    }

    public static function getValidPassportCount($passport_data, $policy_type = '') {
        $passport_data = explode("\n\n", $passport_data);

        $valid_passport_count = 0;
        foreach ($passport_data as $passport) {
            $passport_details = [];

            $matches = [];
            preg_match_all('/([^ :\n]+):([^ :\n]+)/', $passport, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                $passport_details[$match[1]] = $match[2];
            }

            //Utility::log($passport_details);

            switch ($policy_type) {
                case 'b':
                    $result = self::isValidBPassport($passport_details);
                    //Utility::log('Result: ' . $result);
                    $valid_passport_count += $result;
                    break;

                default:
                    $result = self::isValidPassport($passport_details);
                    //Utility::log('Result: ' . $result);
                    $valid_passport_count += $result;
            }

            //Utility::log('');
        }

        return $valid_passport_count;
    }
}
