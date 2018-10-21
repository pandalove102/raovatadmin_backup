<?php
defined('BASE') OR exit('Access Deny');
class muoibaknightcontroller  extends controller
{	
	var $catcon ;
	var $pro ;
	function __construct()
	{
		$this->model = new configsmodel();
		$this->pro = new catalogmodel();
		$this->pathview = 'view/modules/muoibaknight/';
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
		$name = $this->model->cfkey('tieudedaisu');
		$image = $this->model->cfkey('hinhnendaisu');
		$content = $this->model->cfkey('noidungdaisu');
		$mota = $this->model->cfkey('motadaisu');
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
				redirect('muoibaknight/edit',0);
			}
			else{
				redirect('muoibaknight',2);
			}
		}
		$this->setdata(array('name'=>$name,'content'=>$content,'image'=>$image,'mota'=>$mota ));
		$this->render('edit_form');
	}	
	function kcn()
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
		$name = $this->model->cfkey('titleland');
		$image = $this->model->cfkey('landproductimg');
		$content = $this->model->cfkey('noidungland');
		$listproland = $this->model->cfkey('listproland');
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
				if($key=='listproland')
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
				redirect('muoibaknight/kcn',0);
			}
			else{
				redirect('muoibaknight',2);
			}
		}
		$this->setdata(array('name'=>$name,'content'=>$content,'image'=>$image,'pros'=>$pros,'listproland'=>$listproland ));
		$this->render('edit_kcn');
	}	
	function sk()
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
		$name = $this->model->cfkey('tieudesukien');
		$image = $this->model->cfkey('hinhsukien');
		$content = $this->model->cfkey('noidungsukien');
		$link = $this->model->cfkey('linksukien');
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
				redirect('muoibaknight/sk',0);
			}
			else{
				redirect('muoibaknight',2);
			}
		}
		$this->setdata(array('name'=>$name,'content'=>$content,'image'=>$image,'link'=>$link));
		$this->render('edit_form2');
	}	
	
}
 
?>