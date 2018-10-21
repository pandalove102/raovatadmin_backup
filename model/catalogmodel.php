<?php 
class catalogmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'catalogs';
	}
    function listcatnice()
	{
     	$sql = "select id,name,parent_id from `catagories` where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listcatalogs($pos,$numrow)
	{
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
		$sql = "select p.*,c.name as catname from `catalogs` p join `catagories` c on p.catagories_id=c.id where p.hide = 1 and c.hide=1 {$this->limit}";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function total()
	{
		$sql = "select count(p.id) as total from `catalogs` p join `catagories` c on p.catagories_id=c.id where p.hide = 1 and c.hide=1 ";
		$this->setQuery($sql);
		return $this->loadRow()->total;
	}
	function listitem()
	{
		$sql = "select sku,id,name from `catalogs` where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listdis($proid)
	{
		$sql = "select * from `discount` where catalog_id = ? order by id";
		$this->setQuery($sql);
		return $this->loadAllRow(array($proid));
	}
	function listkm($proid)
	{
		$sql = "select * from `promotion` where product_sku = ? order by id";
		$this->setQuery($sql);
		return $this->loadAllRow(array($proid));
	}
	function detail($id)
	{
		return $this->getone($id);	
	}
	function getsku($sku)
	{
		$sql = "select * from `catalogs` where hide = 1 and `sku` = ? ";
		$this->setQuery($sql);
		return $this->loadRow(array($sku));
	}
	function deldis($id)
	{
		$this->setQuery('delete from discount where catalog_id=?');
		$this->execute(array($id));
	}
	function delpro($id)
	{
		$this->setQuery('delete from `promotion` where product_sku=?');
		$this->execute(array($id));
	}
	function adddiscount($id,$name,$quanty,$pri,$s,$e)
	{		
		$sql = 'insert into discount(`catalog_id`,`name`,`quantity`,`price`,`datestart`,`dateend`) values(?,?,?,?,?,?)';
		$this->setQuery($sql);
		$this->execute(array($id,$name,$quanty,$pri,$s,$e));
	}
	function addkm($sku,$item,$quanty)
	{		
		$sql = 'insert into promotion(`product_sku`,`item_id`,`qty`) values(?,?,?)';
		$this->setQuery($sql);
		$this->execute(array($sku,$item,$quanty));
	}
	function searchproduct($skus = '', $products = '', $prices = '', $qty = '', $parent_id = '', $status = '')
	{
		$w = ' where p.hide = 1 and c.hide=1 ';
		if($skus != '')
		{
			$w .= " and p.sku LIKE '%$skus%'";
		}
		if($products != '')
		{
			$w .= " and p.name LIKE '%$products%'";
		}
		if($prices != '')
		{
			$w .= " and p.price = '$prices'";
		}
		if($qty != '')
		{
			$w .= " and p.quantity = '$qty'";
		}
		if($parent_id != '')
		{
			$w .= " and p.catagories_id = '$parent_id'";
		}
		if($status != '')
		{
			$w .= " and p.status = '$status'";
		}
		$sql = 'select p.*,c.name as catname from `catalogs` p join `catagories` c on p.catagories_id=c.id '.@$w;
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
}

?>