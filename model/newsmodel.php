<?php 
class newsmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'news';
	}

	function listnews()
	{
		$sql = "select * from {$this->table} where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function detail($id)
	{
		return $this->getone($id);	
	}
}

?>