<?PHP
 class Targaryen
 {
 	function resistsFire()
 	{
 		return FALSE;
 	}
 	public function getBurned()
 	{
 		 if ($this->resistsFire())
	 		return 'emerges nakes but unharmed';
 		else
 			return 'burns alive';
 	}
 }
?>