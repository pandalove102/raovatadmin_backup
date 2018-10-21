<?php
defined('BASE') OR exit('Access Deny');
class vouchercontroller  extends controller
{	
	function __construct()
	{
		$this->model = new vouchermodel();
		$this->pathview = 'view/promotion/voucher/';
	}
	function api_check_phone($return = false)
	{
		if($this->model->islogin()){
			$cellularphone = $this->model->clean($_POST['username']);
			$uri = $this->model->clean($_POST['uri']);
			$id = $this->model->clean($_POST['id_user']);
			if($uri == 'index' && empty($id))
			{
				$check = $this->model->getkey(array('cellularphone'=>$cellularphone));
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
	function index()
	{
		$this->title ='Check Code';
		$this->h = 'Check Code';
		$this->a = 'Code';
		$this->strong = 'Check';
		$this->save = 'Update';
		$this->uri = $this->getactionname();
		if($this->post())
		{	
			$cellularphone = $this->model->clean($this->post('username'));
			$voucher = $this->model->getonekey(array('cellularphone'=>$cellularphone));
			$this->setdata(array('list'=>$voucher));
			if($this->post('save') == 1)
			{
				if($this->post() && $this->istoken('tokenlanding',$this->model->clean($this->post('tokenlanding'))))
				{
					$data = array(
						'id' => $voucher->id,
						'store' => $this->model->session->get('store_id'),
						'username' => $this->model->session->get('admin_name'),
		                'status' => $this->model->clean($this->post('status')),
		                'update_at' => date('Y-m-d H:i:s')
					);
					if($this->model->update($data))
					{
						$this->model->logs('Cập nhật thành công voucher: '.$voucher->cusname,$this->getcontrollername().'/'.$this->uri);
						$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
						if($this->model->clean($this->post('save')) == 1)
						{
							$this->setmsg('Cập nhật thành công.','success');
							redirect('voucher',2);
						}
					}
					else
					{
						$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
					}
				}
			}
		}
		$this->render('check_voucher');
	}
}
?>