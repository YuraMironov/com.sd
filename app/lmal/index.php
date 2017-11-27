<?php
require_once ("LMAL.php");
$input1 = array(1,2,3,4,3,6,7,8,9,356,4,3,2,1,0);
$input2 = array(9,8,7,9,5,4,3,2,1,0);

function test($input)
{
    print_r($input);
    echo "<br> get local max <br>";
    print_r(LMAL::getLocalMax($input));
    echo "<br> get max length <br>";
    print_r(LMAL::getMaxLength($input));
    echo "<br>";
    echo "<br>";
}

test($input1);
test($input2);

