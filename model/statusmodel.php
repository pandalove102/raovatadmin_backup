<?php 
class statusmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'status_product';
	}

	function liststatus()
	{
		$sql = "select * from ". $this->table;
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function detail($id)
	{
		return $this->getone($id);	
	}
	function searchstatus($key = '')
	{
		$w = ' where 1 = 1 ';
		if($key != '')
		{
			$w .= " and name LIKE '%$key%'";
		}
		$sql = 'select * from '.$this->table.@$w;
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
}

?>