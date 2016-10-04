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

	$al = array();
	$num = array();
	$other = array();
	foreach($argv as $key=>$elem)
	{
		if ($key > 0)
		{
			$elem = ft_split($elem);
		  	foreach($elem as $tutu)
			{
				if (ctype_digit($tutu))
			   		$num[] = $tutu;
				else if (ctype_alpha($tutu))
			   		$al[] = $tutu;
				else
			   		$other[] = $tutu;
			}
		}
	}
	natcasesort($al);
	sort($num, SORT_STRING);
	sort($other, SORT_STRING);
	foreach($al as $elem)
				echo "$elem\n";
	foreach($num as $elem)
				echo "$elem\n";
	foreach($other as $elem)
				echo "$elem\n";
?>