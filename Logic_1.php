<?php

$count = 0;
$currentNum = 0;
$arrayNum = [10,20, 20, 10, 10, 30, 50, 10, 20];
foreach($arrayNum as $key => $num){
	$currentNum = $num;
	$walk = 0;
	foreach($arrayNum as $key2 => $num2){
		if($key2 != $key && $walk !=1){
			if($num2 == $currentNum){
				print_r($arrayNum);
				echo '<br>';
				$walk = 1;
				$count += 1;
				unset($arrayNum[$key]);
				unset($arrayNum[$key2]);
				break;
			}
		}
	}
}

echo $count;
