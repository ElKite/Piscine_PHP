<?php
include("tools.php");
if ($_POST['retour'] == "Retour")
{
	header("Location: index.php");
}
if ($_POST['delete'] == "oui" && $_POST['login'] && $_POST['oldpw'])
{
	$_POST['oldpw'] = hash('whirlpool', $_POST['oldpw']);
	$newtab['login'] = $_POST['login'];
	$newtab['oldpw'] = $_POST['oldpw'];
	if (file_exists("../private/members"))
	{
		$tab = unserialize(file_get_contents("../private/members"));
		foreach($tab as $key => $elem)
		{
			if ($elem['login'] == $newtab['login'])
			{
				if ($elem['passwd'] == $newtab['oldpw'])
				{
					delete($newtab['login']);
					header("Location: index.php");
					exit(0);
				}
			}
		}
		echo ("ERROR"."\n");
	}
}
else
{
	if ($_POST['submit'] != "OK" || !$_POST['newpw'] || !$_POST['login'] || !$_POST['oldpw'])
		echo "ERROR missing values\n";
	else if ($_POST['login'] && $_POST['newpw'] && $_POST['oldpw'] && $_POST['submit'] == 'OK')
	{
		$_POST['oldpw'] = hash('whirlpool', $_POST['oldpw']);
		$newtab['login'] = $_POST['login'];
		$newtab['oldpw'] = $_POST['oldpw'];
		$newtab['newpw'] = $_POST['newpw'];
		if (file_exists("../private/members"))
		{
			$tab = unserialize(file_get_contents("../private/members"));
			foreach($tab as $key => $elem)
			{
				if ($elem['login'] == $newtab['login'])
				{
					if ($elem['passwd'] == $newtab['oldpw'])
					{
						$elem['passwd'] = hash('whirlpool', $_POST['newpw']);
						$tab[$key] = $elem;
						file_put_contents("../private/members", serialize($tab));
						header('Location: login.html');
						echo "OK\n";
						exit(0);
					}
				}
			}
			echo ("ERROR login not found"."\n");
		}
	}
}
?>