<?php
defined('BASE') OR exit('Access Deny');
class orderscontroller  extends controller
{	
	function __construct()
	{
		$this->model = new ordersmodel();
		$this->models = new usermodel();
		$this->pathview = 'view/sales/orders/';
	}
	function index()
	{
		$this->title='Danh sách đơn hàng';
		$this->h = 'Danh sách đơn hàng';
		$this->a = 'Danh mục';
		$this->strong = 'Đơn hàng';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$users = $this->models->getonekey(array('name' => $this->model->clean( $this->model->session->get('admin_user'))));
		$sta = array(
			1=>'Mới đặt',
			2=>'Nhân viên xác nhận',
			3=>'Đóng gói',
			4=>'Đang giao',
			5=>'Hoàn tất',
			6=>'Thay đổi',
			7=>'Hủy'			
		);
		$this->setdata(array('orders'=>$this->model->listorders(),'store' => $this->model->store($users->store_id),'sta'=>$sta));
		$this->render('list_view');
	}
	function api_search()
	{
		$sta = array(
			1=>'Mới đặt',
			2=>'Nhân viên xác nhận',
			3=>'Đóng gói',
			4=>'Đang giao',
			5=>'Hoàn tất',
			6=>'Thay đổi',
			7=>'Hủy'			
		);
		$users = $this->models->getonekey(array('name' => $this->model->clean( $this->model->session->get('admin_user'))));
		$this->setdata(array('orders'=>$this->model->listorders_search($this->get('status')),'store' => $this->model->store($users->store_id),'sta'=>$sta));
		$this->render('list_view_s','emptylayout');
	}
	function edit()
	{
		$sta = array(
			1=>'Mới đặt',
			2=>'Nhân viên xác nhận',
			3=>'Đóng gói',
			4=>'Đang giao',
			5=>'Hoàn tất',
			6=>'Thay đổi',
			7=>'Hủy'			
		);
		$this->title ='Sửa đơn hàng';
		$this->h = 'Sửa đơn hàng';
		$this->a = 'Đơn hàng';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->setcss(array('layout/css/notes.css'));
		$id = $this->get('id');
		$order = $this->model->order($id);
		$orders_item = $this->model->order_item($id);
		if(!$order)
			redirect('orders',1);
		else
		{
			$this->uri = $this->getactionname();
			if($this->post() && $this->istoken('tokenorder',$this->model->clean($this->post('tokenorder'))))
			{			
				$data = array(
					'id' => $orders->id,
	                'title' => $this->model->clean($this->post('title')),
	                'description' => $this->model->clean($this->post('description')),
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
					$orders = $this->model->getone($orders->id);
					$this->model->logs('Cập nhật thành công nhóm: '.$orders->name,$this->getcontrollername().'/'.$this->uri);
					$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Cập nhật thành công.','success');
					}
					else{
						redirect('orders',2);
					}
				}
				else
				{
					$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
				}
			}
			$this->setdata(array('order'=>$order,'orders_item'=>$orders_item,'sta'=>$sta));
			$this->render('edit_form');
		}
	}
	function delete()
	{
		$id = $this->get('id');
		$order = $this->model->order($id);
		if(!$order)
			redirect('orders',1);	
		$data = array(
				'id' => $order->id,
				'hide' => 2
		);
		if($this->model->update($data))
		{
			$this->model->logs('Xóa thành công đơn hàng: '.$order->code,'orders/delete/'.$order->id);
			redirect('orders',2);
		}
		else
		{
			$this->setmsg('Xóa không thành công!','success');
		}
		$this->render('list_view');
	}
	function api_change()
	{
		$id = $this->post('id');
		$sta = $this->post('status');
		$cmt = $this->post('cmt');
		$order = $this->model->order($id);
		if(!$order)
			exit( 'empty');	
		$data = array(
				'id' => $order->id,
				'status' => $sta,
				'comment'=>$cmt
		);
		if($this->model->update($data))
		{
			$this->model->logs('Cập nhật thành công đơn hàng: '.$order->code,'orders/api_change');
			exit( '1');
		}
		else
		{
			exit( '2');
		}
	}
}
 
?>