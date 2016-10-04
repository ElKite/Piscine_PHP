#!/usr/bin/php
<?PHP

function ft_split($str)
{
    	$res = array();
    	$tab = explode(" ",$str);
    	$tab = array_filter($tab);
    	foreach($tab as $elem)
    	{
        	$res[] = $elem;
    	}
    	return ($res);
}

if (count($argv) > 1) 
{
	$res = array();
	foreach($argv as $key=>$elem)
	{
		if ($key != 0 && $key != 1)
		{
			$tab = ft_split($elem);
			$res = array_merge($res, $tab);
		}
		if ($key == 1)
		   $res = ft_split($elem);
	}
	sort($res);
	foreach($res as $elem)
		echo "$elem\n";
}
?>
