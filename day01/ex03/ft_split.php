<?PHP

//print_r(ft_split("toto tata titi TUTU ToTO 1234"));

function ft_split($str)
{
	$res = array();
	$tab = explode(" ",$str);
	$tab = array_filter($tab);
	sort($tab);
	foreach($tab as $elem)
	{
		$res[] = $elem;
	}	
	return ($res);
}
?>
