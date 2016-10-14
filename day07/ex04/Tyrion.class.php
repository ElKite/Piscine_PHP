<?PHP
include_once('Lannister.class.php');
 class Tyrion extends Lannister
 {
 	public $nom = 'tyrion';
 	public function sleepWith($arg)
 	{
 		 if ($arg instanceof Stark)
			return print("Let's do this.".PHP_EOL);
		else
			return print("Not even if I'm drunk".PHP_EOL);
 	}
 }
?>