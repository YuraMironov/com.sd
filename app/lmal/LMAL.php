<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 26.11.2017
 * Time: 18:37
 */
//LMAL (LocalMaxAndLength)
class LMAL
{
    public static function getLocalMax($input) : ?array
    {
        $length = count($input);
        if ($length <= 2) {
            return null;
        }
        $out = array();
        for ($i = 1; $i < $length - 1; $i++) {
            if ($input[$i] > $input[$i - 1] && $input[$i] > $input[$i + 1]) {
                $out[] =  $input[$i];
            }
        }
        return count($out) == 0 ? null : $out;
    }
    public static function getMaxLength($input) : int
    {
        $maxLength = 0;
        $length = 0;
        for ($i = 1; $i < count($input); $i++) {
            if ($input[$i] < $input[$i - 1]) {
                $length++;
                if ($i != count($input) - 1) {
                    continue;
                }
            }
            $maxLength = $length > 0 && $length > $maxLength ? $length + 1 : $maxLength;
            $length = 0;
        }
        return $maxLength;
    }

}