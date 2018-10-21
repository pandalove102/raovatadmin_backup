<?php
defined('BASE') OR exit('Access Deny');
class footerlinkcontroller  extends controller
{	
	function __construct()
	{
		$this->model = new configsmodel();
		$this->pathview = 'view/menufooter/footerlink/';
	}
	function index()
	{
			$this->title='Danh sách menu';
		$this->h = 'Danh sách menu';
		$this->a = 'Menu';
		$this->strong = 'Danh sách';	
		$links = array(
			1=>array('name'=>'Về chúng tôi'),
			2=>array('name'=>'Chính sách khách hàng'),
			3=>array('name'=>'Chăm sóc khách hàng'),
			4=>array('name'=>'Điều khoản sử dụng')
		);
		$this->setdata(array('links'=>$links));
		$this->render('list_view');
	}
	function edit()
	{
		$this->title='Danh sách menu';
		$this->h = 'Danh sách menu';
		$this->a = 'Menu';
		$this->strong = 'Cập nhật';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & đóng';		
		$name='';
		$content='';
		$image='';
		$idl=  $this->get('id');
		if($idl==1)
		{
			$name = $this->model->cfkey('tieudegioithieu');
			$image = $this->model->cfkey('hinhgioithieu');
			$content = $this->model->cfkey('gioithieu');
			$this->size_image = '(843x408)px';
		}
		else
		if($idl==2)
		{
			$name = $this->model->cfkey('tieudechinhsach');
			$content = $this->model->cfkey('chinhsach');			
		}
		else
		if($idl==3)
		{
			$name = $this->model->cfkey('tieudechinhsach');
			$content = $this->model->cfkey('chinhsach');			
		}
		else
		if($idl==4)
		{
			$name = $this->model->cfkey('tieudedichvu');
			$content = $this->model->cfkey('dichvu');			
		}
		if($this->post() && $this->istoken('tokenconfigs',$this->model->clean($this->post('tokenconfigs'))))
		{
			//$this->model->varray($this->post(),true);
			$array = $this->post();
			foreach ($array as $k => $v)
			{
				$ar = explode('-', $k);
				if(count($ar)!=2) continue;
				$key=$ar[0];
				$id=$ar[1];
				//
				if($this->model->updateconfigs($id,$v))
				{
					//$this->model->logs('Cập nhật thành công cấu hình: ',$this->getcontrollername());					
				}
				else
				{
					//$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
				}
			}
			if($this->model->clean($this->post('save')) == 1)
			{
				$this->setmsg('Cập nhật thành công.','success');
				redirect('footerlink/edit/'.$idl,0);
			}
			else{
				redirect('footerlink',2);
			}
		}
		$this->setdata(array('name'=>$name,'content'=>$content,'image'=>$image));
		$this->render('edit_form');
	}	
}
 
?>