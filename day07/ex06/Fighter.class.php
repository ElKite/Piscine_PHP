<?PHP
	abstract class Fighter
	{
		public $toto;
		function __construct($rag)
		{
			$this->toto = $rag;
		}
		abstract function fight($gar);
	}
?>