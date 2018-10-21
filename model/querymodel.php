<?php 
class querymodel extends model
{
	function __construct()
	{
		parent::__construct();
	}
	function query($var)
	{
		$this->setQuery($var);
		return $this->loadAllRow();
	}
}

?>