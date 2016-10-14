<?PHP
	class NightsWatch {
		private $recruit;
		public function recruit($arg)
		{
			if ($arg instanceof IFighter)
				$this->recruit[] = $arg;
		}
		public function fight()
	{
			foreach ($this->recruit as $elem)
			{
				$elem->Fight();
			}
		}
	}
?>