<?PHP
if ($_POST['submit'] != "OK" || !$_POST['passwd'] || !$_POST['login'])
	echo "ERROR\n";
else if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] == 'OK')
{
	if (file_exists("../private") == FALSE)
		mkdir("../private");
	$_POST['passwd'] = hash('whirlpool', $_POST['passwd']);
	$newtab['login'] = $_POST['login'];
	$newtab['passwd'] = $_POST['passwd'];
	if (file_exists("../private/passwd"))
	{
		$tab = unserialize(file_get_contents("../private/passwd"));
		foreach($tab as $elem)
		{
			if ($elem['login'] == $newtab['login'])
			{
				echo "ERROR\n";
				exit(0);
			}
		}
	}
	$tab[] = $newtab;
	file_put_contents("../private/passwd", serialize($tab));
	echo "OK\n";
}
?>