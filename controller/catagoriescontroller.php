<?php
defined('BASE') OR exit('Access Deny');
class catagoriescontroller  extends controller
{	
	function __construct()
	{
		$this->model = new catagoriesmodel();
		$this->pathview = 'view/newpagers/catagories/';
	}
	function index()
	{
		$this->title='Danh sách danh mục';
		$this->h = 'Danh sách danh mục';
		$this->a = 'Danh mục';
		$this->strong = 'Danh sách';
		$this->setdata(array('catagories'=>$this->model->listparent()));
		$this->render('list_view_catagories');
	}
	function api_check_alias($return = false)
	{
		if($this->model->islogin()){
			$alias = $this->model->clean($this->post('alias'));	
			$uri = $this->model->clean($this->post('uri'));
			$id = $this->model->clean($this->post('id_user'));
			if($uri == 'create')
			{
				$check = $this->model->getkey(array('alias'=>$alias));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->getkey(array('alias'=>$alias));
				$check_again = $this->model->getkey(array('id'=>$id));
				$checking = $check ? $check[0]->alias:'null';
				if($checking == $check_again[0]->alias)
				{
					if($return) return true; else echo "true";
				}
				else if($checking != 'null' && $checking != $check_again[0]->alias)
				{
					if($return) return false; else echo "false";
				}
				else
				{
					if($return) return true; else echo "true";
				}

			}
		}else
			return false;
	}
	function api_check_catagories($return = false)
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
				$check = $this->model->checknameedit($name,$id);
				if(!$check){
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
		$this->title ='Thêm danh mục';
		$this->h = 'Thêm danh mục';
		$this->a = 'Danh mục';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->size_image = '(300x300)px';
		$this->size_imgshare = '(300x300)px';
		$this->uri = $this->getactionname();
		$this->setdata(array('list_catagories'=>$this->model->listcatagories()));
		if($this->post() && $this->istoken('tokencatagories',$this->model->clean($this->post('tokencatagories'))))
		{			
			if($this->api_check_catagories(true))
			{ 
				$data = array(
					'title' => $this->model->clean($this->post('title')),
	                'name' => $this->model->clean($this->post('username')),
	                'alias' => $this->post('alias'),
	                'description' => $this->model->clean($this->post('description')),
	                'metakey' => $this->model->clean($this->post('metakey')),
	                'metadesc' => $this->model->clean($this->post('metadesc')),
	                'image' => $this->model->clean($this->post('image')),
	                'imgshare' => $this->model->clean($this->post('imgshare')),
					'status' => 1,
	                'parent_id' => $this->model->clean($this->post('parent_id')),
	                'username' => $this->model->clean($this->model->session->get('admin_user')),    
					'create_at' => date('Y-m-d H:i:s'),
					'hide' => 1
				);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công danh mục: '.$this->model->clean($this->post('username')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('catagories',2);
					}
				}
				else
				{
					$this->setmsg('Thêm thất bại.','error');
				}
			}else
			{
				$this->setmsg('Tên danh mục đã tồn tại!','error');
			}
		}
		$this->render('create_and_edit_form_catagories');
	}
	function edit()
	{
		$this->title ='Sửa nhóm';
		$this->h = 'Sửa nhóm';
		$this->a = 'Nhóm hệ thống';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$this->size_image = '(300x300)px';
		$this->size_imgshare = '(300x300)px';
		$id = $this->get('id');
		$catagories = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$catagories)
			redirect('catagories/create',1);
		else
		{
			$this->uri = $this->getactionname();
			if($this->post() && $this->istoken('tokencatagories',$this->model->clean($this->post('tokencatagories'))))
			{			
				$data = array(
					'id' => $catagories->id,
	                'title' => $this->model->clean($this->post('title')),
	                'description' => $this->model->clean($this->post('description')),
	                'alias' => $this->post('alias'),
	                'metakey' => $this->model->clean($this->post('metakey')),
	                'metadesc' => $this->model->clean($this->post('metadesc')),
	                'image' => $this->model->clean($this->post('image')),
	                'imgshare' => $this->model->clean($this->post('imgshare')),
	                'parent_id' => $this->model->clean($this->post('parent_id')),
	                'username' => $this->model->clean($this->model->session->get('admin_user')),    
					'update_at' => date('Y-m-d H:i:s'),
				);
				if($this->model->update($data))
				{
					$catagories = $this->model->getone($catagories->id);
					$this->model->logs('Cập nhật thành công nhóm: '.$catagories->name,$this->getcontrollername().'/'.$this->uri);
					$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Cập nhật thành công.','success');
					}
					else{
						redirect('catagories',2);
					}
				}
				else
				{
					$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
				}
			}
			$this->setdata(array('catagories'=>$catagories));
			$this->render('create_and_edit_form_catagories');
		}
	}
	function delete()
	{
		$id = $this->get('id');
		$catagories = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$catagories)
			redirect('catagories',1);	
		$data = array(
				'id' => $catagories->id,
				'hide' => 2
		);
		if($this->model->update($data))
		{
			$this->model->logs('Xóa thành công danh mục: '.$catagories->name,'catagories/delete/'.$catagories->id);
			redirect('catagories',2);
		}
		else
		{
			$this->setmsg('Xóa không thành công!','success');
		}
		$this->render('list_view_catagories');
	}
}
 
?>