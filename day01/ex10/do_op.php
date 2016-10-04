#!/usr/bin/php
<?PHP

if (count($argv) == 4) 
{

	$a = intval(trim($argv[1]));
	$b = intval(trim($argv[3]));

	if (trim($argv[2]) === '+')
	{
		echo ($a + $b);
	} else if (trim($argv[2]) === '-') {
		echo ($a - $b);
	} else if (trim($argv[2]) === '*') {
		echo ($a * $b);
	} else if (trim($argv[2]) === '/') {
		echo ($a / $b);
	} else if (trim($argv[2]) === '%') {
		echo ($a % $b);
	}
	echo "\n";
}
?>