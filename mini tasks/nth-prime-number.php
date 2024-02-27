<?php
echo "\nFind the Prime at the given index\n---------------------------------------\n";
$targetIndex = readline("Enter a index: ");
$length = 0;

echo "Target index: {$targetIndex}\n";

for ($i = 2; $length < $targetIndex; $i++) {
	$isPrime = true;
	for ($j = 2; $j * $j <= $i; $j++) {
		if ($i % $j == 0) {
			$isPrime = false;
			break;
		}
	}
	if ($isPrime) {
		$length++;
		if ($length == $targetIndex) {
			echo "Result: {$i}";
			break;
		}
	}
}
