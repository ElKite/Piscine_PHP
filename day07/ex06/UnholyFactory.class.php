<?PHP
	class unHolyFactory {
		public $recruit = array();
		public function absorb($rag)
		{
			if ($rag instanceof Fighter && !in_array($rag, $this->recruit))
			{
				$this->recruit[] = $rag;
				print("(Factory absorbed a fighter of type ".$rag->toto. ")".PHP_EOL);
			}
			else if (in_array($rag, $this->recruit))
				print("(Factory already absorbed a fighter of type ".$rag->toto. ")".PHP_EOL);
			else
				print("(Factory can't absorb this, it's not a fighter)".PHP_EOL);
		}
		public function fabricate($toto)
		{
			foreach ($this->recruit as $elem) 
			{
				if ($elem->toto == $toto)
				{
					print("(Factory fabricates a fighter of type ".$elem->toto.")". PHP_EOL);
					return clone($elem);
				}
			}
			print("(Factory hasn't absorbed a fighter of type ".$toto.")". PHP_EOL);
		}
	}
?>