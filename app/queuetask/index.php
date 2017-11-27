<?php
require_once('MyQueue.php');

$q = array(1,1);
$q1 = new MyQueue($q);
var_dump($q1->getQueue());

echo "<pre>";
var_dump($q1->getFirstAndLast());
echo "</pre>\n" . $q1->getBusy() . "\n";

$q1->deleteFirst();
$q1->deleteFirst();
$q1->deleteFirst();
var_dump($q1->getQueue());

echo "<pre>";
var_dump($q1->getFirstAndLast());
echo "</pre>\n" . $q1->getBusy() . "\n";

$q1->addToEnd(123);
var_dump($q1->getQueue());

echo "<pre>";
var_dump($q1->getFirstAndLast());
echo "</pre>\n" . $q1->getBusy() . "\n";
