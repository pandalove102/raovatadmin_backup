<?php
defined('BASE') OR exit('Access Deny');
class rolescontroller  extends controller
{	
	function __construct()
	{
		$this->pathview = 'view/systems/roles/';
		$this->model = new rolesmodel();
	}
	function index()
	{
		$this->title='Phân quyền';
		$this->h = 'Phân quyền';
		$this->a = 'Phân quyền';
		$this->strong = 'Phân quyền';
		$group = new groupmodel();
		$this->setdata(array('group'=>$group->listgroup()));
		$this->render('list_admin');
	}
	function group()
	{
		if($this->get('id')){
			$group = $this->model->getgroup($this->get('id'));
			if($group){
				$this->title='Phân quyền';
				$this->h = 'Phân quyền';
				$this->a = 'Phân quyền';
				$this->strong = 'Cấp quyền theo nhóm';
				$this->setdata(array('pages'=>$this->model->listpage(),'group'=>$group,'roles'=>$this->model->getrolegroup($group->group_id)));
				$this->setscript(array('layout/js/treeview.js'));
				$this->render('group');
			}else
				redirect('roles');
		}else{
			redirect('roles');
		}
	}
	function user()
	{
		if($this->get('id')){
			$user = $this->model->getuser($this->get('id'));
			if($user){
				$this->title='Phân quyền';
				$this->h = 'Phân quyền';
				$this->a = 'Phân quyền';
				$this->strong = 'Cấp quyền theo quản trị viên';
				$roleg = $this->model->getrolegroup($user->group_id);
				$this->setdata(array('user'=>$user,'roleg'=>$roleg,'denys'=>$this->model->getdenyuser($user->name)));
				$this->setscript(array('layout/js/treeview.js'));
				$this->render('user');
			}else
				redirect('roles');
		}else{
			redirect('roles');
		}
	}
	function api_qtv()
	{
		if($this->post()){
			$qtv = $this->model->usergroup($this->post('group'));
			echo json_encode($qtv);
		}else
			echo '[]';
	}
	function api_setpermiss_group()
	{
		if($this->post() && $this->post('groupid')  && $this->post('id')){
			$group = $this->model->getgroup($this->post('id'),$this->post('groupid'));
			if($group)
			{
				if($this->post('pages'))
				{
					$this->model->grantgroup($this->post('groupid'),$this->post('pages'));
				}else{
					$this->model->denygroup($this->post('groupid'));
				}
				echo json_encode(array('type'=>'success','msg'=>'Cấp quyền thành công'));
			}else
			{
				echo json_encode(array('type'=>'error','msg'=>'Nhóm này không hợp lệ','data'=>''));
			}
		}else
			echo json_encode(array('type'=>'error','msg'=>'Bạn vui lòng chọn chức năng','data'=>''));
	}
	function api_setpermiss_user()
	{
		if($this->post()  && $this->post('id')&& $this->post('uid')){			
			$user = $this->model->getuser($this->post('id'));
			if($user)
			{
				$group = $this->model->getgroup($user->gid,$user->group_id);
				if($group){
					if($this->post('pages'))
					{
						$this->model->denyuser($user->name,$this->post('pages'));
					}else{
						$this->model->grantuser($user->name);
					}
					echo json_encode(array('type'=>'success','msg'=>'Cấp quyền thành công','data'=>$this->post()));
				}else
					echo json_encode(array('type'=>'error','msg'=>'Người này không thuộc nhóm quản trị','data'=>''));
			}else
			{
				echo json_encode(array('type'=>'error','msg'=>'Quản trị viên này không hợp lệ','data'=>''));
			}
		}else
			echo json_encode(array('type'=>'error','msg'=>'Bạn vui lòng chọn chức năng','data'=>''));
	}

}
 
?>