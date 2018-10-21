<?php 
class storesmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'stores';
	}

	function liststores()
	{
		$sql = "select * from {$this->table} where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}

	function listcity()
	{
		$sql = "select * from city order by name";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listdistrict($id_city = "")
	{
		$sql = "select * from district where cityid=? order by name";
		$this->setQuery($sql);
		return $this->loadAllRow(array($id_city));
	}
}

?>