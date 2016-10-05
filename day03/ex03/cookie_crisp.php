<?php
	$action = $_GET["action"];
	$name = $_GET["name"];
	$value = $_GET["value"];

	if ($action === "set")
	{
		setcookie($name, $value, time() + 3600);
	} else if ($action === "get") {
		if ($_COOKIE[$name])
		echo ($_COOKIE[$name]."\n");
	} else if ($action === "del") {
		setcookie($name, $value, -1);
	}
?>