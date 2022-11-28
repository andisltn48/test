<?php

$count = 0;
$text = 'Berapa u(mur minimal[ untuk !mengurus ktp?';
$illegalChar = "#$%^&*()+=-[]'!;./{}|:<>~";

$arrayText = explode(" ",$text);

foreach($arrayText as $text){
	if(false === strpbrk($text, $illegalChar)){
		$count += 1;
	};
}
echo $count;
