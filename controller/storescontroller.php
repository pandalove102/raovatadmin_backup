<?php
defined('BASE') OR exit('Access Deny');
class storescontroller  extends controller
{	
	function __construct()
	{
		$this->model = new storesmodel();
		$this->pathview = 'view/systems/stores/';
	}
	function index()
	{
		$this->title='Danh sách cửa hàng';
		$this->h = 'Danh sách cửa hàng';
		$this->a = 'Cửa hàng';
		$this->strong = 'Danh sách';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$this->setdata(array('stores'=>$this->model->liststores()));
		$this->render('list_view');
	}
	function api_check_storeid($return = false)
	{
		if($this->model->islogin()){
			$store_id = $this->model->clean($this->post('store_id'));
			$uri = $this->model->clean($this->post('uri'));
			$id = $this->model->clean($this->post('id_user'));
			if($uri == 'create' && empty($id))
			{
				$check = $this->model->getkey(array('store_id'=>$store_id));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->getkey(array('store_id'=>$store_id,'id'=>$id));
				if($check){
					if($return) return true; else echo "true";
				}
				else{
					if($return) return false; else  echo "false";
				}
			}
		}else
			return false;
	}
	function create()
	{
		$this->title ='Thêm cửa hàng';
		$this->h = 'Thêm cửa hàng';
		$this->a = 'Cửa hàng';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenstore',$this->model->clean($this->post('tokenstore'))))
		{			
			if($this->api_check_storeid(true))
			{ 
				$data = array(
					'store_id' => $this->model->clean($this->post('store_id')),
	                'name' => $this->model->clean($this->post('name')),
	                'address' => $this->model->clean($this->post('address')),
	                'district' => $this->model->clean($this->post('district')),
	                'city' => $this->model->clean($this->post('city')),
	                'cellularphone' => $this->model->clean($this->post('cellularphone')),
	                'fax' => $this->model->clean($this->post('fax')),
	                'status' => 1,
					'hide' => 1,
	                'create_at' => date('Y-m-d H:i:s')
				);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công cửa hàng: '.$this->model->clean($this->post('group_id')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('stores',2);
					}
				}
				else
				{
					$this->setmsg('Thêm thất bại.','error');
				}
			}else
			{
				$this->setmsg('Mã nhóm đã tồn tại!','error');
			}
		}
		$this->setdata(array('list_city'=>$this->model->listcity(),'list_district'=>$this->model->listdistrict()));
		$this->render('create_and_edit_form');
	}
	function edit()
	{
		$this->title ='Sửa cửa hàng';
		$this->h = 'Sửa cửa hàng';
		$this->a = 'Cửa hàng';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$id = $this->get('id');
		$stores = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$stores)
			redirect('stores/create',1);		
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenstore',$this->model->clean($this->post('tokenstore'))))
		{			
			$data = array(
				'id' => $stores->id,
	            'name' => $this->model->clean($this->post('name')),
	            'address' => $this->model->clean($this->post('address')),
	            'district' => $this->model->clean($this->post('district')),
	            'city' => $this->model->clean($this->post('city')),
	            'cellularphone' => $this->model->clean($this->post('cellularphone')),
	            'fax' => $this->model->clean($this->post('fax')),
                'update_at' => date('Y-m-d H:i:s')
			);
			if($this->model->update($data))
			{
				$stores = $this->model->getone($stores->id);
				$this->model->logs('Cập nhật thành công cửa hàng: '.$stores->id,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('stores',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$this->setdata(array('stores'=>$stores,'list_city'=>$this->model->listcity(),'list_district'=>$this->model->listdistrict($stores->city)));
		$this->render('create_and_edit_form');
	}
	function delete()
	{
		$id = $this->get('id');
		$stores = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		$data = array(
				'id' => $stores->id,
				'hide' => 2
		);
		if($this->model->update($data))
		{
			$this->model->logs('Xóa thành công cửa hàng: '.'stores/delete/'.$stores->id);
			redirect('stores',1);
		}
		else
		{
			$this->setmsg('Xóa không thành công!','success');
		}
		$this->render('list_view');
	}
}
 
?>