<?php 
class catagoriesmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'new_catagories';
	}

	function listcatagories()
	{
		$sql = "select * from `" . $this->table . "` where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listparent($id = 0)
	{
     	$sql = "select * from `" . $this->table . "` where parent_id=$id and hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	
	function detail($id)
	{
		return $this->getone($id);	
	}
	function checknameedit($name,$id)
	{
	   echo  $sql = "select * from `" . $this->table . "` where name=? and id != ? ";
		$this->setQuery($sql);
		return $this->loadRow(array($name,$id));	
	}
}

?>