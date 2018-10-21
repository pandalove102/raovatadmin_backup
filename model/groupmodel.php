<?php 
class groupmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'groups';
	}

	function listgroup()
	{
		if($this->session->get('admin_name') == 'admin')
		{
			$sql = "select * from `groups` where hide = 1";
		}
		else
		{
			$sql = "select * from `groups` where hide = 1 and id != 1";
		}
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function detail($id)
	{
		return $this->getone($id);	
	}
}

?>