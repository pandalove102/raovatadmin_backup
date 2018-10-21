<?php 
class usermodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'account';
	}

	//=== Function admin login and logout ===//
    function admin_login($user,$pass) {
		$username=$this->createname($this->clean($user));
		$password=$pass;
		$query= "select * from {$this->table} where name=? and password=? and permiss = 1";
		$this->setQuery($query);
		$item = $this->loadRow(array($user,$pass));
		//$this->varray($item,true);
		if($item && $username==$item->name && $password==$item->password && $item->permiss==1 && $item->lock==0){
			$data = array(
				'last_login_time' => date('Y-m-d H:i:s'),
				'id' => $item->id
			);
			$result = $this->update($data);
			$lgkey = 'login'.SALT;			
			$this->session->setdata(array(
				$lgkey=> true,
				'admin_name'=> $item->name,
				'admin_user'=> $item->fullname,
				'admin_id' => $item->id,
				'group_id' => $item->group_id,
				'store_id' => $item->store_id
				));
			return $item;//tra ve true flase
		}
		else
		{
			return false;
		}
	}
	function listuser()
	{
		$sql = "select * from {$this->table} where permiss = 1 and hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function liststore()
	{
		$sql = "select * from `stores` where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listgroup()
	{
		$sql = "select * from `groups` where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function detail($id)
	{
		return $this->getone($id);	
	}
}

?>