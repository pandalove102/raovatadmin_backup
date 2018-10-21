<?php
defined('BASE') OR exit('Access Deny');
class districtcontroller  extends controller
{	
	function __construct()
	{
		$this->model = new districtmodel();
	}
	function index($id_city)
	{
		$this->setdata(array('list_dis'=>$this->model->listdis($id_city)));
	}
	function api_district()
	{
		if($this->model->islogin())
		{
			$city = $this->model->clean($this->post('city'));
			$kq = '<option value="">Select District</option>';
			$result = $this->model->listdis($city);
			if($result){
				foreach($result as $dis)
				{
					$kq .='<option value="'.$dis->id.'">'.$dis->name.'</option>';
				}
			}
			echo $kq;
		}else
		{
			echo '<option value="">Chưa đăng nhập</option>';
		}
	}
}
?>