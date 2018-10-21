<?php 
class configsmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'configs';
	}
    function listconfigs()
	{
     	$sql = "select * from {$this->table}";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function cfkey($key)
	{
     	$sql = "select * from {$this->table} where name=?";
		$this->setQuery($sql);
		return $this->loadRow(array($key));
	}
	function updateconfigs($key,$value)
	{
		$data = array('id'=>$key,'value'=>$value);
		return $this->update($data);
	}
}

?>