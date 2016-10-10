<?php

function auth($login, $passwd)
{
	if (file_exists("../private/members"))
	{
		$tab = unserialize(file_get_contents("../private/members"));
		$checkpw = hash('whirlpool', $passwd);
		foreach($tab as $elem)
		{
			if ($elem['login'] == $login)
			{
				if ($elem['passwd'] == $checkpw)
					return (TRUE);
			}
		}
	}
	return (FALSE);
}

?>