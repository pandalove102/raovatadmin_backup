<?php 
class customersmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'customers';
	}
	function listcustomers()
	{
		$sql = "select * from {$this->table} where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function detail($id)
	{
		return $this->getone($id);	
	}
	function searchcustomer($users = '', $emails = '', $groups = '', $status = '')
	{
		$w = ' where hide = 1 ';
		if($users != '')
		{
			$w .= " and name LIKE '%$users%'";
		}
		if($emails != '')
		{
			$w .= " and email LIKE '%$emails%'";
		}
		if($groups != '')
		{
			$w .= " and group_id = '$groups'";
		}
		if($status != '')
		{
			$w .= " and status = '$status'";
		}
		$sql = 'select * from '.$this->table.@$w;
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
}

?>