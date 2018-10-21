<?php
defined('BASE') OR exit('Access Deny');
class customerscontroller  extends controller
{	
	function __construct()
	{
		$this->model = new customersmodel();
		$this->models = new groupmodel();
		$this->pathview = 'view/customers/customers/';
	}
	function index()
	{
		$this->title='Danh sách khách hàng';
		$this->h = 'Danh sách';
		$this->a = 'Khách hàng';
		$this->strong = 'danh sách';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$customers = $this->model->listcustomers();
		$list_group = $this->models->listgroup();
		/*if($this->get() && $this->istoken('tokensearch',$this->model->clean($this->get('tokensearch'))))
		{
			//$this->model>varray($this->get('skus'),true);
			$customers = $this->model->searchcustomer($this->get('users'),$this->get('emails'),$this->get('groups'),$this->get('status'));
		}*/
		$this->setdata(array('customers'=>$customers,'list_group'=>$list_group));
		$this->render('list_view');
	}
	function api_check_username($return = false)
	{
		if($this->model->islogin()){
			$username = $this->model->clean($this->post('username'));
			$uri = $this->model->clean($this->post('uri'));
			$id = $this->model->clean($this->post('id_user'));
			if($uri == 'create' && empty($id))
			{
				$check = $this->model->getkey(array('name'=>$username));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->getkey(array('name'=>$username,'id'=>$id));
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
	function api_check_email($return = false)
	{
		if($this->model->islogin()){
			$email = $this->model->clean($this->post('email'));
			$uri = $this->model->clean($this->post('uri'));
			$id = $this->model->clean($this->post('id_user'));
			if($uri == 'create' && empty($id))
			{
				$check = $this->model->getkey(array('email'=>$email));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->getkey(array('email'=>$email,'id'=>$id));
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
		$this->title ='Thêm tài khoản';
		$this->h = 'Thêm tài khoản';
		$this->a = 'Người dùng';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->size_image = '(300x300)px';
		$this->setdata(array('list_group'=>$this->models->listgroup()));
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokencustomers',$this->model->clean($this->post('tokencustomers'))))
		{			
			if($this->api_check_username(true) && $this->api_check_email(true))
			{ 
				$data = array(
					'fullname' => $this->model->clean($this->post('fullname')),
	                'name' => $this->model->clean($this->post('username')),
	                'password' => $this->model->hashmd5($this->model->clean($this->post('password'))),
	                'email' => $this->model->clean($this->post('email')),
	                'address' => $this->model->clean($this->post('address')),
	                'image' => $this->model->clean($this->post('image')),
	                'last_login_ip' => $_SERVER['REMOTE_ADDR'],
	                'status' => $this->model->clean($this->post('status')),
					'hide' => 1,
	                'group_id' => $this->model->clean($this->post('groupid')),    
	                'create_at' => date('Y-m-d H:i:s')
				);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công tài khoản: '.$this->model->clean($this->post('username')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('customers',2);
					}
				}
				else
				{
					$this->setmsg('Thêm thất bại.','error');
				}
			}else
			{
				$this->setmsg('Tài khoản hoặc email đã sử dụng!','error');
			}
		}
		$this->render('create_and_edit_form');
	}
	function edit()
	{
		$this->title ='Sửa tài khoản';
		$this->h = 'Sửa tài khoản';
		$this->a = 'Người dùng';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$this->size_image = '(300x300)px';
		$id = $this->get('id');
		$customers = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$customers)
			redirect('customers/create',1);		
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokencustomers',$this->model->clean($this->post('tokencustomers'))))
		{			
			$data = array(
				'id' => $customers->id,
				'fullname' => $this->model->clean($this->post('fullname')), 
                'status' => $this->model->clean($this->post('status')),
                'address' => $this->model->clean($this->post('address')),
	            'image' => $this->model->clean($this->post('image')),
                'group_id' => $this->model->clean($this->post('groupid')),
                'status' => $this->model->clean($this->post('status')),
                'last_login_time' => date('Y-m-d H:i:s')
			);
			if($this->model->clean($this->post('edpassword')))
			{
				$data['password'] = $this->model->hashmd5($this->model->clean($this->post('edpassword')));
			}
			if($this->model->update($data))
			{
				$customers = $this->model->getone($customers->id);
				$this->model->logs('Cập nhật thành công tài khoản: '.$customers->name,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('customers',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$this->setdata(array('customers'=>$customers,'list_group'=>$this->models->listgroup()));
		$this->render('create_and_edit_form');
	}
	function delete()
	{
		$id = $this->get('id');
		$customers = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$customers)
			redirect('customers',1);	
		$data = array(
				'id' => $customers->id,
				'hide' => 2
		);
		if($this->model->update($data))
		{
			$this->model->logs('Xóa thành công tài khoản: '.$customers->name,'customers/delete/'.$customers->id);
			redirect('customers',1);
		}
		else
		{
			$this->setmsg('Xóa không thành công!','success');
		}
		$this->render('list_view');
	}
}
 
?>