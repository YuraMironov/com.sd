<?php 

require_once('CCDay.php');
require_once('CCenter.php');
require_once('Manager.php');

$center = new CCenter();
$managers_count = rand(2,5);
for ($i = 0; $i < $managers_count; $i++) {
	$newManager = new Manager('manager' . ($i + 1));
	$work_days = rand(1, 7);
	for ($j = 0; $j < $work_days; $j++) {
		$work_day = new CCDay();
		$calls = rand(4, 10);
		for ($k = 0; $k < $calls; $k++) {
			$work_day->addPrice(rand(2,5));
		}
		$newManager->addCCDay($work_day);
	}
	echo "<pre>";
	$center->addManager($newManager);
}
if (count($center->managersIsGreatest3()) == 0) {
	echo "please update";
} else {
	foreach ($center->managersIsGreatest3() as $manager) {
		echo $manager->getName() . "\n";
	}
}
