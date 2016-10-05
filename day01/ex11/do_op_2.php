#!/usr/bin/php
<?PHP

function ft_split($str, $c)
{
    $res = array();
    $tab = explode($c, $str);
    $tab = array_filter($tab);
    foreach($tab as $elem)
    {
        $res[] = $elem;
    }
    return ($res);
}

function do_op($argv, $c) 
{
	if (is_numeric(trim($argv[0])))
	{
		$a = intval(trim($argv[0]));
		if (is_numeric(trim($argv[1]))) 
		{
			$b = intval(trim($argv[1]));
			if (trim($c) === '+')
			{
				echo ($a + $b);
			} else if ($c === '-') {
				echo ($a - $b);
			} else if ($c === '*') {
				echo ($a * $b);
			} else if ($c === '/') {
				echo ($a / $b);
			} else if ($c === '%') {
				echo ($a % $b);
			} else
			echo "Syntax error";
		}
		else
			echo "Syntax error";
	}
	else
		echo "Syntax error";
	echo "\n";
}

function check($res, $str, $c)
{
	if ($res[0] != $str)
		do_op($res, $c);
	else
		echo "Syntax error\n";
}

if (count($argv) == 2) 
{
	if (strpos($argv[1], '+') !== false) {
		$res = ft_split($argv[1], '+');
		check($res, $argv[1], '+');
	} else if (strpos($argv[1], '-') !== false) {
		$res = ft_split($argv[1], '-');
		check($res, $argv[1], '-');
	} else if (strpos($argv[1], '/') !== false) {
		$res = ft_split($argv[1], '/');
		check($res, $argv[1], '/');
	} else if (strpos($argv[1], '*') !== false) {
		$res = ft_split($argv[1], '*');
		check($res, $argv[1], '*');
	} else if (strpos($argv[1], '%') != false) {
		$res = ft_split($argv[1], '%');
		check($res, $argv[1], '%');
	} else 
		echo "Syntax error\n";
}
else
	echo ("Number of parameters incorrect \n");
?>