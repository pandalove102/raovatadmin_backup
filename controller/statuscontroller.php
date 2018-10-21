<?php
defined('BASE') OR exit('Access Deny');
class statuscontroller  extends controller
{	
	function __construct()
	{
		$this->model = new statusmodel();
		$this->pathview = 'view/products/status/';
	}
	function index()
	{
		$this->title='Danh sách trạng thái sản phẩm';
		$this->h = 'Danh sách trạng thái sản phẩm';
		$this->a = 'Trạng thái sản phẩm';
		$this->strong = 'Danh sách';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$status = $this->model->liststatus();
		if($this->get() && $this->istoken('tokensearch',$this->model->clean($this->get('tokensearch'))))
		{
			$status = $this->model->searchstatus($this->get('key'));
		}
		$this->setdata(array('status'=>$status));
		$this->render('list_view');
	}
	function api_check_name($return = false)
	{
		if($this->model->islogin()){
			$name = $this->model->clean($this->post('username'));
			$uri = $this->model->clean($this->post('uri'));
			$id = $this->model->clean($this->post('id_user'));
			if($uri == 'create' && empty($id))
			{
				$check = $this->model->getkey(array('name'=>$name));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->getkey(array('name'=>$name,'id'=>$id));
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
		$this->title ='Thêm trạng thái';
		$this->h = 'Thêm trạng thái';
		$this->a = 'Nhóm sản phẩm';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenstatus',$this->model->clean($this->post('tokenstatus'))))
		{//$this->model->varray($this->post(),true);
			if($this->api_check_name(true))
			{ 
				$data = array(
	                'name' => $this->model->clean($this->post('username')),
	                'status' => $this->model->clean($this->post('status')),
	                'create_at' => date('Y-m-d H:i:s'),
	                'update_at' => date('Y-m-d H:i:s')
				);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công trạng thái: '.$this->model->clean($this->post('username')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('status',2);
					}
				}
				else
				{
					$this->setmsg('Thêm thất bại.','error');
				}
			}else
			{
				$this->setmsg('Tên trạng thái đã tồn tại!','error');
			}
		}
		
		$this->render('create_and_edit_form');
	}
	function edit()
	{
		$this->title ='Sửa tên trạng thái';
		$this->h = 'Sửa tên trạng thái';
		$this->a = 'Nhóm sản phẩm';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$id = $this->get('id');
		$status = $this->model->getonekey(array('id'=>$id));
		if(!$status)
			redirect('status/create',1);		
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenstatus',$this->model->clean($this->post('tokenstatus'))))
		{			
			$data = array(
				'id' => $status->id,
                'status' => $this->model->clean($this->post('status')),
                'update_at' => date('Y-m-d H:i:s')
			);
			if($this->model->update($data))
			{
				$status = $this->model->getone($status->id);
				$this->model->logs('Cập nhật thành công tên trạng thái: '.$status->name,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('status',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$this->setdata(array('status'=>$status));
		$this->render('create_and_edit_form');
	}
	function delete()
	{
		$id = $this->get('id');
		$status = $this->model->getonekey(array('id'=>$id));
		if($this->model->delete($status))
		{
			$this->model->logs('Xóa thành công tài khoản: '.'status/delete/'.$status->id);
			redirect('status',1);
		}
		else
		{
			$this->setmsg('Xóa không thành công!','success');
		}
		$this->render('list_view');
	}
}
 
?>