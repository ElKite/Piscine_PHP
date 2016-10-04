#!/usr/bin/php
<?PHP
	while (42)
	{
		echo "Entrez un nombre: ";
		$args = fgets(STDIN);
		if ($args == NULL)
		{
			echo "^D\n";
		   	exit(0);
		}		
		$args = trim($args);
		if (is_numeric($args))
		{
			if ($args % 2 == 0)
	   	 	 	echo "Le chiffre $args est Pair\n";
			else
				echo "Le chiffre $args est Impair\n";
		}
		else
			echo"'$args' n'est pas un chiffre\n";
	}
?>
