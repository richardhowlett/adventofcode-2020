<?php

class Seat
{
    public static function getSeatId($code)
    {
        $row_min = 0;
        $row_max = 127;
        $col_min = 0;
        $col_max = 7;

        $path = str_split($code);

        foreach ($path as $p) {
            $row_range = intval($row_max - $row_min);
            $col_range = intval($col_max - $col_min);
            switch ($p) {
                case 'F':
                    $row_max -= intval(ceil($row_range / 2));
                    break;

                case 'B':
                    $row_min += intval(ceil($row_range / 2));
                    break;

                case 'L':
                    $col_max -= intval(ceil($col_range / 2));
                    break;

                case 'R':
                    $col_min += intval(ceil($col_range / 2));
                    break;

                default:
                    throw new Exception('Invalid Input "' . $p . '"');
            }

            /*Utility::log('char: ' . $p);
            Utility::log('row_min: ' . $row_min);
            Utility::log('row_max: ' . $row_max);
            Utility::log('col_min: ' . $col_min);
            Utility::log('col_max: ' . $col_max);*/
        }

        if ($row_min != $row_max || $col_min != $col_max) {
            throw new Exception('Invalid Input');
        }

        return ($row_min * 8) + $col_min;
    }

    public static function findHighestSeatId($boarding_passes)
    {
        $boarding_passes = explode("\n", $boarding_passes);

        $max_seat_id = null;
        foreach ($boarding_passes as $boarding_pass) {
            $seat_id = self::getSeatId($boarding_pass);
            if ($seat_id > $max_seat_id) {
                $max_seat_id = $seat_id;
            }
        }

        return $max_seat_id;
    }

    public static function findMissingSeatId($boarding_passes)
    {
        $boarding_passes = explode("\n", $boarding_passes);

        $found_passes = [];
        foreach ($boarding_passes as $boarding_pass) {
            $seat_id = self::getSeatId($boarding_pass);
            $found_passes[$seat_id] = $seat_id;
        }

        //asort($found_passes);

        $start = min($found_passes);
        $end = max($found_passes);

        for ($i = $start + 1; $i + 2 < $end; $i++) {
            if (!isset($found_passes[$i]) && isset($found_passes[$i - 1]) && isset($found_passes[$i + 1])) {
                return $i;
            }
        }

        throw new Exception('Invalid Input, unable to find missing seat');
    }
}
