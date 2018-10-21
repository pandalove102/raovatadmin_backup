<?php
defined('BASE') OR exit('Access Deny');
class attributecontroller  extends controller
{	
	function __construct()
	{
		$this->model = new attributemodel();
		$this->pathview = 'view/products/attribute/';
	}
	function index()
	{
		$this->title='Danh sách thuộc tính';
		$this->h = 'Danh sách thuộc tính';
		$this->a = 'Thuộc tính';
		$this->strong = 'Danh sách thuộc tính';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$this->setdata(array('attribute'=>$this->model->listattribute()));
		$this->render('list_view');
	}
	function api_check_label($return = false)
	{
		if($this->model->islogin()){
			$label = $this->model->clean($_POST['username']);
			$uri = $this->model->clean($_POST['uri']);
			$id = $this->model->clean($_POST['id_user']);
			if($uri == 'create' && empty($id))
			{
				$check = $this->model->getkey(array('label'=>$label));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->getkey(array('label'=>$label,'id'=>$id));
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
		$this->title ='Thêm thuộc tính';
		$this->h = 'Thêm thuộc tính';
		$this->a = 'Nhóm thuộc tính';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenattribute',$this->model->clean($_POST['tokenattribute'])))
		{			
			if($this->api_check_label(true))
			{ 
				$data = array(
					'label' => $this->model->clean($this->post('username')),
	                'defaultvalue' => $this->model->clean($this->post('defaultvalue')),
	                'requrire' => $this->model->clean($this->post('requrire')),
					'unique' => $this->model->clean($this->post('unique')),
	                'code' => $this->model->clean($this->post('code')),
	                'type' => $this->model->clean($this->post('type'))
				);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công thuộc tính: '.$this->model->clean($this->post('lable')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('attribute',2);
					}
				}
				else
				{
					$this->setmsg('Thêm thất bại.','error');
				}
			}else
			{
				$this->setmsg('Thuộc tính đã tồn tại!','error');
			}
		}
		$this->render('create_and_edit_form');
	}
	function edit()
	{
		$this->title ='Sửa thuộc tính';
		$this->h = 'Sửa thuộc tính';
		$this->a = 'Nhóm thuộc tính';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$id = $this->get('id');
		$attribute = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$attribute)
			redirect('attribute/edit',1);		
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenattribute',$this->model->clean($this->post('tokenattribute'))))
		{			
			$data = array(
				'id' => $attribute->id,
                'defaultvalue' => $this->model->clean($this->post('defaultvalue')),
                'requrire' => $this->model->clean($this->post('requrire')),
				'unique' => $this->model->clean($this->post('unique')),
                'code' => $this->model->clean($this->post('code')),
                'type' => $this->model->clean($this->post('type'))
			);
			if($this->model->update($data))
			{

				$attribute = $this->model->getone($attribute->id);
				$this->model->logs('Cập nhật thành công thuộc tính: '.$attribute->label ,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('attribute',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$this->setdata(array('attribute'=>$attribute));
		$this->render('create_and_edit_form');
	}
	// code cũ 
		// function delete()
		// {
		// 	$id = $this->get('id');
		// 	$attribute = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		// 	if($this->model->delete($attribute->id))
		// 	{
		// 		$this->model->logs('Xóa thành công tài khoản: '.'attribute/delete/'.$attribute->id);
		// 		redirect('attribute',1);
		// 	}
		// 	else
		// 	{
		// 		$this->setmsg('Xóa không thành công!','success');
		// 	}
		// 	$this->render('list_view');
		// }
		
	// Delete : chỉ ẩn không hiển thị
	function delete()
	{
		//get id:
		$id=$this->get('id');
		$attribute= $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if($attribute){
			$data = array(
				'id' => $attribute->id,
				'hide' => 2
			);
			if($this->model->update($data))
			{
				$attribute = $this->model->getone($attribute->id);
				$this->model->logs('Xóa thành công thuộc tính : '.'attribute/delete/'.$attribute->id);
				// $this->setmsg('Xoá thành công. Đang chuyển hướng...','success');
				// redirect('attribute',1);
				// $this->setmsg('Xóa không thành công!','success');
				$this->setmsg('Xoá thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Xoá thành công.','success');
				}
				else{
					redirect('attribute',2);
				}
			}
			else{
				$this->setmsg('Xóa không thành công!','error');
				redirect('attribute',1);
			}
			
		}else{
			$this->setmsg('Xóa không thành công!','error');
			redirect('attribute',1);
		}
		
		
	}


}
 
?>