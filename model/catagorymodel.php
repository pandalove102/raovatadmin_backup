<?php 
class catagorymodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'catagories';
	}

	function listcatagories($id='')
	{
		$add = '';
		if($id)
			$add = ' and id != '.$id;
		$sql = "select *,(select pa.name from `catagories` pa where pa.id=`catagories`.parent_id) paname from `catagories` where hide = 1 $add";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listparent($id = 0)
	{
     	$sql = "select * from `" . $this->table . "` where parent_id=$id and hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
   	function listnice()
	{
     	$sql = "select id,name,parent_id from `" . $this->table . "` where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
   
	function detail($id)
	{
		return $this->getone($id);	
	}
	function checknameedit($name,$id)
	{
	    $sql = "select * from `" . $this->table . "` where name=? and hide=1 and id != ? ";
		$this->setQuery($sql);
		return $this->loadRow(array($name,$id));	
	}
	function checkaliasedit($name,$id)
	{
	    $sql = "select * from `" . $this->table . "` where  alias=? and hide=1 and id != ? ";
		$this->setQuery($sql);
		return $this->loadRow(array($name,$id));	
	}
	function searchcatagory($key = '')
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