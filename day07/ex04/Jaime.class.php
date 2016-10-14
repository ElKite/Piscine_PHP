<?PHP
include_once('Lannister.class.php');
	class Jaime extends Lannister
	{
		public function sleepWith($arg)
		{
			if ($arg instanceof Tyrion)
				return print("Not even if I'm drunk".PHP_EOL);
			else if ($arg instanceof Stark)
				return print("Let's do this.".PHP_EOL);
			else
				return print("With pleasure, but only in a tower in Winterfell, then.".PHP_EOL);
		}
	}
?>