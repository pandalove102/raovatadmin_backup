<?php
defined('BASE') OR exit('Access Deny');
class usercontroller  extends controller
{	
	function __construct()
	{
		$this->model = new usermodel();
		$this->pathview = 'view/systems/user/';
	}
	function index()
	{
		$this->title='Danh sách người dùng';
		$this->h = 'Danh sách';
		$this->a = 'Người dùng';
		$this->strong = 'danh sách';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$this->setdata(array('user'=>$this->model->listuser(),'list_group'=>$this->model->listgroup()));
		$this->render('list_view');
	}
	function login()
	{
		// Lấy thông tin cơ bản của trang
		$this->title='Đăng nhập hệ thống';
		$this->setscript(array('layout/js/jquery-2.1.1.js','layout/js/toastr.min.js','layout/js/script.js'));
		// Kiểm tra thông tin user & password
		if(isset($_POST,$_POST['username'],$_POST['password']) && $_POST['password'] && $_POST['username'])
	   	{
		    $user = $this->model->admin_login(
		    			$_POST['username'],
		    			$this->model->hashmd5(trim($_POST['password'])));
		    if($user)
		    {			      
				$this->setmsg('Đăng nhập thành công. Đang chuyển hướng...','success');
				redirect('catalog/index',1);
		    }
		    else
		    {
		      $this->setmsg('Thông tin đăng nhập không đúng, vui lòng liên hệ admin','error');
		    }
	   	}
		$this->render('login','loginlayout');
		
	}
	function register()
	{
		//$item = $this->model->getitem($id);
		//$this->setdata(array('item'=>$item));
		//$this->title  = 'ct san pham';
		//goi view tuong ung de hien thi du lieu
		$this->render('register');
	}
	function api_check_username($return = false)
	{
		if($this->model->islogin()){
			$username = $this->model->clean($_POST['username']);
			$uri = $this->model->clean($_POST['uri']);
			$id = $this->model->clean($_POST['id_user']);
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
			$email = $this->model->clean($_POST['email']);
			$uri = $this->model->clean($_POST['uri']);
			$id = $this->model->clean($_POST['id_user']);
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
		$this->setdata(array('list_store'=>$this->model->liststore(),'list_group'=>$this->model->listgroup()));
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenuser',$this->model->clean($_POST['tokenuser'])))
		{			
			if($this->api_check_username(true) && $this->api_check_email(true))
			{ 
				$data = array(
					'fullname' => $this->model->clean($_POST['fullname']),
	                'name' => $this->model->clean($_POST['username']),
	                'password' => $this->model->hashmd5($this->model->clean($_POST['password'])),
	                'email' => $this->model->clean($_POST['email']),
	                'last_login_ip' => $_SERVER['REMOTE_ADDR'],
	                'lock' => $this->model->clean($_POST['lock'],'number'),
	                'permiss' => 1,
	                'status' => $this->model->clean($_POST['status']),
					'hide' => 1,
	                'store_id' => $this->model->clean($_POST['store_id']),
	                'group_id' => $this->model->clean($_POST['groupid']),    
	                'create_at' => date('Y-m-d H:i:s')
				);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công tài khoản: '.$this->model->clean($_POST['username']),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($_POST['save']) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('user',2);
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
		$id = $this->get('id');
		$user = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$user)
			redirect('user/create',1);		
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenuser',$this->model->clean($_POST['tokenuser'])))
		{			
			$data = array(
				'id' => $user->id,
				'fullname' => $this->model->clean($_POST['fullname']), 
                'status' => $this->model->clean($_POST['status']),
                'store_id' => $this->model->clean($_POST['store_id']),
                'group_id' => $this->model->clean($_POST['groupid']), 
				 'lock' => $this->model->clean($_POST['lock'],'number'),
                'last_login_time' => date('Y-m-d H:i:s')
			);
			if($this->model->clean($_POST['edpassword']))
			{
				$data['password'] = $this->model->hashmd5($this->model->clean($_POST['edpassword']));
			}
			if($this->model->update($data))
			{
				$user = $this->model->getone($user->id);
				$this->model->logs('Cập nhật thành công tài khoản: '.$user->name,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($_POST['save']) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('user',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$this->setdata(array('user'=>$user,'list_store'=>$this->model->liststore(),'list_group'=>$this->model->listgroup()));
		$this->render('create_and_edit_form');
	}
	function delete()
	{
		$id = $this->get('id');
		$user = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$user)
			redirect('user',1);	
		$data = array(
				'id' => $user->id,
				'hide' => 2
		);
		if($this->model->update($data))
		{
			$this->model->logs('Xóa thành công tài khoản: '.$user->name,'user/delete/'.$user->id);
			redirect('user',1);
		}
		else
		{
			$this->setmsg('Xóa không thành công!','success');
		}
		$this->render('list_view');
	}
	function logout()
	{
		$this->model->session->destroy();
		redirect('user/login');
	}
}
 
?>