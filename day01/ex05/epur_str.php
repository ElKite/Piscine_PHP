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
	if (count($argv) == 2) 
	{
		$tab = ft_split($argv[1]);
		$res = implode(" ", $tab);
		echo "$res\n";
	}
?>
