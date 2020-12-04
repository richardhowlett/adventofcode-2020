<?php

require_once('classes/Utility.class.php');
require_once('classes/Passport.class.php');

/**
 * Test input
 */
assert(Passport::validateField('byr', '2002') === true);
assert(Passport::validateField('byr', '2003') === false);

assert(Passport::validateField('hgt', '60in') === true);
assert(Passport::validateField('hgt', '190cm') === true);
assert(Passport::validateField('hgt', '190in') === false);
assert(Passport::validateField('hgt', '190') === false);

assert(Passport::validateField('hcl', '#123abc') === true);
assert(Passport::validateField('hcl', '#123abz') === false);
assert(Passport::validateField('hcl', '123abc') === false);

assert(Passport::validateField('ecl', 'brn') === true);
assert(Passport::validateField('ecl', 'wat') === false);

assert(Passport::validateField('pid', '000000001') === true);
assert(Passport::validateField('pid', '0123456789') === false);

$result = Passport::getValidPassportCount('eyr:1972 cid:100
hcl:#18171d ecl:amb hgt:170 pid:186cm iyr:2018 byr:1926

iyr:2019
hcl:#602927 eyr:1967 hgt:170cm
ecl:grn pid:012533040 byr:1946

hcl:dab227 iyr:2012
ecl:brn hgt:182cm pid:021572410 eyr:2020 byr:1992 cid:277

hgt:59cm ecl:zzz
eyr:2038 hcl:74454a iyr:2023
pid:3556412378 byr:2007', 'b');
assert($result === 0);

$result = Passport::getValidPassportCount('pid:087499704 hgt:74in ecl:grn iyr:2012 eyr:2030 byr:1980
hcl:#623a2f

eyr:2029 ecl:blu cid:129 byr:1989
iyr:2014 pid:896056539 hcl:#a97842 hgt:165cm

hcl:#888785
hgt:164cm byr:2001 iyr:2015 cid:88
pid:545766238 ecl:hzl
eyr:2022

iyr:2010 hgt:158cm hcl:#b6652a ecl:blu byr:1944 eyr:2021 pid:093154719', 'b');
assert($result === 4);

/**
 * Real Input
 */
$day4a_input = file_get_contents('puzzle_input/day4.txt');

$result = Passport::getValidPassportCount($day4a_input, 'b');
Utility::log('Answer: ' . $result);
