<?php

include("auth.php");

session_start();
if (!$_GET['login'] || !$_GET['passwd']) {
	echo ("ERROR"."\n");
	exit(0);
} else {
	$passwd = $_GET['passwd'];
	$login = $_GET['login'];
}
if (auth($login, $passwd)) {
	$_SESSION['loggued_on_user'] = $login;
	echo ("OK"."\n");
} else {
	$_SESSION['loggued_on_user'] = "";
	echo ("ERROR"."\n");
}
?>