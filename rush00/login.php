<?php

include("auth.php");
include("tools.php");

session_start();
if ($_POST['retour'] == "Retour")
{
	header("Location: index.php");
}
else
{
if (!$_POST['login'] || !$_POST['passwd']) {
	header('Location: login.html');
	exit(0);
} else {
	$passwd = $_POST['passwd'];
	$login = $_POST['login'];
}
if (auth($login, $passwd)) {
	$_SESSION['loggued_on_user'] = $login;
	header('Location: index.php');
} else {
	$_SESSION['loggued_on_user'] = "";
	echo ("ERROR login doesn't exist or password if false"."\n");
}
}
?>