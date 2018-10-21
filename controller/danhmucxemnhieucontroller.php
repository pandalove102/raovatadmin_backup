<?php
defined('BASE') OR exit('Access Deny');
class danhmucxemnhieucontroller  extends controller
{	
	var $catcon ;
	var $pro ;
	function __construct()
	{
		$this->model = new configsmodel();
		$this->pro = new catalogmodel();
		$this->pathview = 'view/modules/danhmucxemnhieu/';
	}
	function index()
	{
		$this->title='Danh sách menu';
		$this->h = 'Danh sách menu';
		$this->a = 'Menu';
		$this->strong = 'Danh sách';	
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
		$name = $this->model->cfkey('tieudedanhmuc');
		$image = $this->model->cfkey('hinhdanhmuc');
		$content = $this->model->cfkey('noidungdanhmuc');
		$productland = $this->model->cfkey('prolandcat');
		$pros =  $this->pro->listitem();
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
				if($key=='prolandcat')
				{
					$v = implode(',',$v);
				}
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
				redirect('danhmucxemnhieu/edit',0);
			}
			else{
				redirect('danhmucxemnhieu',2);
			}
		}
		$this->setdata(array('name'=>$name,'content'=>$content,'image'=>$image,'pros'=>$pros,'productland'=>$productland ));
		$this->render('edit_form');
	}	
	function select()
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
		$cat = $this->model->cfkey('catshowhome');
		$cat1 = $this->model->cfkey('tenmuc1');
		$cat2 = $this->model->cfkey('tenmuc2');
		$hinh1 = $this->model->cfkey('hinhmuc1');
		$hinh2 = $this->model->cfkey('hinhmuc2');
		$this->catcon = new catagorycontroller();		
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
				if($key=='catshowhome')
				{
					$v = implode(',',$v);
				}
				
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
				redirect('danhmucxemnhieu/select',0);
			}
			else{
				redirect('danhmucxemnhieu',2);
			}
		}
		$this->setdata(array('cat'=>$cat,'catcontrl'=>$this->catcon,'cat1'=>$cat1,'cat2'=>$cat2,'hinh2'=>$hinh2,'hinh1'=>$hinh1));
		$this->render('selectcat');
	}	
}
 
?>