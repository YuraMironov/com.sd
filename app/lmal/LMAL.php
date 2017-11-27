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
    public static function getLocalMax($input)
    {
        $length = count($input);
        if ($length <= 2) {
            return false;
        }
        $out = array();
        for ($i = 1; $i < $length - 1; $i++) {
            if ($input[$i] > $input[$i - 1] && $input[$i] < $input[$i + 1]) {
                array_push($out, $input[$i]);
            }
        }
        return $out;
    }

}