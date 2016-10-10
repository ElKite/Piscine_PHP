<?php
include("tools.php");
session_start();
if (empty($_SESSION['loggued_on_user']) || (!empty($_SESSION['loggued_on_user']) && getStatus($_SESSION['loggued_on_user']) == FALSE))
{
  header("Location: index.php");
  echo ("Vous n'etes pas connecte / admin"."\n");
}

if ($_POST['delete'] == 'oui' && $_POST['login'])
{
	$newtab['login'] = $_POST['login'];
	if (file_exists("../private/members"))
	{
		$tab = unserialize(file_get_contents("../private/members"));
		foreach($tab as $key => $elem)
		{
			if ($elem['login'] == $newtab['login'])
			{
				delete($newtab['login']);
				header('Location: admin.php');
				exit(0);
			}
		}
		echo ("ERROR"."\n");
	}
}
if ($_POST['login'] && $_POST['newpw'] && $_POST['submit'] == 'OK')
{
	$newtab['login'] = $_POST['login'];
	$newtab['newpw'] = $_POST['newpw'];
	if (file_exists("../private/members"))
	{
		$tab = unserialize(file_get_contents("../private/members"));
		foreach($tab as $key => $elem)
		{
			if ($elem['login'] == $newtab['login'])
			{
				$elem['passwd'] = hash('whirlpool', $_POST['newpw']);
				$tab[$key] = $elem;
				file_put_contents("../private/members", serialize($tab));
				header('Location: admin.php');
				echo "OK\n";
				exit(0);
			}
		}
		echo ("ERROR login not found"."\n");
	}
}
if ($_POST['login'] && $_POST['newlogin'] && $_POST['submit'] == 'ya')
{
	$newtab['login'] = $_POST['login'];
	$newtab['newlogin'] = $_POST['newlogin'];
	if (file_exists("../private/members"))
	{
		$tab = unserialize(file_get_contents("../private/members"));
		foreach($tab as $key => $elem)
		{
			if ($elem['login'] == $newtab['login'])
			{
					$elem['login'] = $_POST['newlogin'];
					$tab[$key] = $elem;
					file_put_contents("../private/members", serialize($tab));
					header('Location: admin.php');
					echo "OK\n";
					exit(0);
			}
		}
	echo ("ERROR login not found"."\n");
	}
}

?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="admin.css">
	</head>
	<body>
		<form action="index.php">
    		<input type="submit" value="Retour" />
		</form>
		<form method="POST" action="admin.php">
			<div class = "op">
			Identifiant User: <input type="text" name="login"/>
			<br />
			<br />
			Nouveau mot de passe: <input type="password" name="newpw"/>
			<input type="submit" name="submit" value="OK"/>
			<br />
			<br />
			Nouvelle Identifiant: <input type="text" name="newlogin"/>
			<button type="submit" name="submit" value="ya">OK</button>
			<br />
			<br />			
			Supprimer le compte ? 
			<button type="submit" name="delete" value="oui">OK</button>
			<br />
			<br />
			</div>
				<?php
				$tab = unserialize(file_get_contents("../private/members"));
				foreach($tab as $key => $elem)
				{
					?>
					<table>
					<tr>
					<td>
					<?php
						print_r($elem['login']."\n");
					?>
					</td>
					</tr>
					</table><?php
				}					
				?>
	</body>
</html>