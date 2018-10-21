<?php 
class ordersmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'orders';
	}

	function listorders()
	{
		$sql = "select * from `orders` where hide=1 order by status, orderdate desc";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listorders_search($status)
	{
		$where ='';
		$param =array();
		if($status)
		{
			$where = ' and status=? ';
			$param[]=$status;
		}
		$sql = "select * from `orders` where hide=1 $where order by status, orderdate desc";
		$this->setQuery($sql);
		return $this->loadAllRow($param);
	}

	function store($store_id)
	{
		$sql = "select * from `stores` where store_id = ?";
		$this->setQuery($sql);
		return $this->loadAllRow(array($store_id));
	}
	
	function order($id)
	{
		$sql = "select * from `orders` where `orders`.`id` = ?";
		$this->setQuery($sql);
		return $this->loadRow(array($id));
	}
	function order_item($id)
	{
		$sql = "select * from `orders`, `order_details`, `catalogs` where `orders`.`id` = `order_details`.`order_id` and `catalogs`.`id` = `order_details`.`product_id` and `orders`.`id` = ?";
		$this->setQuery($sql);
		return $this->loadAllRow(array($id));
	}
}

?>