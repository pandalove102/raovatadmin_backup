<?php
defined('BASE') OR exit('Access Deny');
class groupcontroller  extends controller
{	
	function __construct()
	{
		$this->model = new groupmodel();
		$this->pathview = 'view/systems/group/';
	}
	function index()
	{
		$this->title='Danh sách nhóm';
		$this->h = 'Danh sách nhóm';
		$this->a = 'Nhóm';
		$this->strong = 'Danh sách';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$this->setdata(array('group'=>$this->model->listgroup()));
		$this->render('list_view');
	}
	function api_check_groupid($return = false)
	{
		if($this->model->islogin()){
			$group_id = $this->model->clean($this->post('group_id'));
			$uri = $this->model->clean($this->post('uri'));
			$id = $this->model->clean($this->post('id_user'));
			if($uri == 'create' && empty($id))
			{
				$check = $this->model->getkey(array('group_id'=>$group_id));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->getkey(array('group_id'=>$group_id,'id'=>$id));
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
		$this->title ='Thêm nhóm';
		$this->h = 'Thêm nhóm';
		$this->a = 'Nhóm hệ thống';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokengroup',$this->model->clean($this->post('tokengroup'))))
		{			
			if($this->api_check_groupid(true))
			{ 
				$data = array(
					'group_id' => $this->model->clean($this->post('group_id')),
	                'fullname' => $this->model->clean($this->post('fullname')),
	                'type' => $this->model->clean($this->post('type')),
	                'status' => 1,
					'hide' => 1,
	                'create_at' => date('Y-m-d H:i:s')
				);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công nhóm: '.$this->model->clean($this->post('group_id')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('group',2);
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
		
		$this->render('create_and_edit_form');
	}
	function edit()
	{
		$this->title ='Sửa nhóm';
		$this->h = 'Sửa nhóm';
		$this->a = 'Nhóm hệ thống';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$id = $this->get('id');
		$group = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$group)
			redirect('group/create',1);		
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokengroup',$this->model->clean($this->post('tokengroup'))))
		{			
			$data = array(
				'id' => $group->id,
                'fullname' => $this->model->clean($this->post('fullname')),
                'type' => $this->model->clean($this->post('type')),
                'update_at' => date('Y-m-d H:i:s'),
			);
			if($this->model->update($data))
			{
				$group = $this->model->getone($group->id);
				$this->model->logs('Cập nhật thành công nhóm: '.$group->group_id,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('group',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$this->setdata(array('group'=>$group));
		$this->render('create_and_edit_form');
	}
	function delete()
	{
		$id = $this->get('id');
		$group = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		$data = array(
				'id' => $group->id,
				'hide' => 2
		);
		if($this->model->update($data))
		{
			$this->model->logs('Xóa thành công tài khoản: '.'group/delete/'.$group->id);
			redirect('group',1);
		}
		else
		{
			$this->setmsg('Xóa không thành công!','success');
		}
		$this->render('list_view');
	}
}
 
?>