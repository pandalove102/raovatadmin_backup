<?php 
class commentproductmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'comment_product';
	}
	function listcommentproduct()
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