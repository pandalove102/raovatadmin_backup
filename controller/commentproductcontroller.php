<?php
defined('BASE') OR exit('Access Deny');
class commentproductcontroller  extends controller
{	
	function __construct()
	{
		$this->model = new commentproductmodel();
		$this->pathview = 'viewu/commentproduct/listcommentproduct/';
	}
	function index()
	{
		$this->title='Danh sách bình luận';
		$this->h = 'Danh sách';
		$this->a = 'Bình Luận';
		$this->strong = 'DS Bình Luận';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$comment = $this->model->listcommentproduct();
		/*if($this->get() && $this->istoken('tokensearch',$this->model->clean($this->get('tokensearch'))))
		{
			//$this->model>varray($this->get('skus'),true);
			$customers = $this->model->searchcustomer($this->get('users'),$this->get('emails'),$this->get('groups'),$this->get('status'));
		}*/
		$this->setdata(array('commentproduct'=>$commentproduct));
		$this->render('list_view');
    }
    
	function edit()
	{
		$this->title ='Sửa bình luận';
		$this->h = 'Sửa bình luận';
		$this->a = 'Người dùng';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$this->size_image = '(300x300)px';
		$id = $this->get('id');
		$comment = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$comment)
			redirect('commentproduct/edit',1);		
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokencustomers',$this->model->clean($this->post('tokencustomers'))))
		{			
			$data = array(
				'id' => $comment->id,
				'content' => $this->model->clean($this->post('content')), 
                'idpost' => $this->model->clean($this->post('idpost')),
                'iduser' => $this->model->clean($this->post('iduser')),
	            'idcomment' => $this->model->clean($this->post('idcomment')),
                'state' => $this->model->clean($this->post('state')),
                'created' => date('Y-m-d H:i:s')
			);
			if($this->model->update($data))
			{
				$comment = $this->model->getone($comment->id);
				$this->model->logs('Cập nhật thành công tài khoản: '.$comment->id,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('commentproduct',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$this->setdata(array('commentproduct'=>$comment));
		$this->render('create_and_edit_form');
	}
	function delete()
	{
		$id = $this->get('id');
		$comment = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$comment)
			redirect('commentproduct',1);	
		$data = array(
				'id' => $comment->id,
				'hide' => 2
		);
		if($this->model->update($data))
		{
			$this->model->logs('Xóa thành công tài khoản: '.$comment->id,'customers/delete/'.$comment->id);
			redirect('commentproduct',1);
		}
		else
		{
			$this->setmsg('Xóa không thành công!','success');
		}
		$this->render('list_view');
	}


}
?>