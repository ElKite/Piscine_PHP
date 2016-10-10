<?PHP
session_start();
if ($_POST['retour'] == "Retour")
{
	header("Location: login.html");
}
else
{
if ($_POST['submit'] != "OK" || !$_POST['passwd'] || !$_POST['login'])
	header('Location: create.html');
else if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] == 'OK')
{
	if (file_exists("../private") == FALSE)
		mkdir("../private");
	$_POST['passwd'] = hash('whirlpool', $_POST['passwd']);
	$newtab['login'] = $_POST['login'];
	$newtab['passwd'] = $_POST['passwd'];
	$newtab['status'] = "member";
	if (file_exists("../private/members"))
	{
		$tab = unserialize(file_get_contents("../private/members"));
		foreach($tab as $elem)
		{
			if ($elem['login'] == $newtab['login'])
			{
				echo "ERROR login already exist\n";
				exit(0);
			}
		}
	}
	$tab[] = $newtab;
	file_put_contents("../private/members", serialize($tab));
	header('Location: login.html');
	echo "OK\n";
}
}
?>