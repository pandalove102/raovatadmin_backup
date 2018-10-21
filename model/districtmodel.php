<?php 
class districtmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'district';
	}
	function listdis($id)
	{
		$sql = "select * from {$this->table} where cityid=? order by name";
		$this->setQuery($sql);
		return $this->loadAllRow(array($id));
	}
}

?>