<?php
defined('BASE') OR exit('Access Deny');
class slidercontroller  extends controller
{	
	function __construct()
	{
		$this->model = new slidermodel();
		$this->pathview = 'view/media/slider/';
	}
	function index()
	{
		$this->title='Danh sách slider';
		$this->h = 'Danh sách slider';
		$this->a = 'Slider';
		$this->strong = 'Danh sách';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$this->setdata(array('sliders'=>$this->model->listslider()));
		$this->render('list_view');
	}
	
	function create()
	{
		$this->title ='Thêm slider';
		$this->h = 'Thêm slider';
		$this->a = 'slider';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->size_image = '(1400x500)px';
		$this->size_imgshare = '(1400x500)px';
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenslider',$this->model->clean($this->post('tokenslider'))))
		{			
			if($this->post('image'))
			{
				$data = array(
					'name' => $this->model->clean($this->post('name')),
					'link' => $this->post('link'),
					'content' => $this->model->clean($this->post('content')),
					'image' => $this->model->clean($this->post('image')),
					'status' => $this->model->clean($this->post('status')),					
					'username' => $this->model->clean($this->model->session->get('admin_name'))
				);
				//var_dump($data);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công slider: '.$this->model->clean($this->post('name')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('slider',2);
					}
				}
				else
				{
					$this->setmsg('Thêm thất bại.','error');
				}				
			}
			else
			{
				$this->setmsg('Vui lòng nhập đầy đủ thông tin!','error');
			}
		}
		$this->render('create_and_edit_form');
	}
	function edit()
	{
		$this->title ='Sửa slider';
		$this->h = 'Sửa slider';
		$this->a = 'slider';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$this->size_image = '(1400x500)px';
		$this->size_imgshare = '(1400x500)px';
		$id = $this->get('id');
		$news = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$news)
			redirect('slider/create',1);
		else
		{
			$this->uri = $this->getactionname();
			if($this->post() && $this->istoken('tokenslider',$this->model->clean($this->post('tokenslider'))))
			{
				if($this->post('image'))
				{					
					$data = array(
						'id' => $news->id,
		                'name' => $this->model->clean($this->post('name')),
		                'link' => $this->post('link'),
		                'content' => $this->model->clean($this->post('content')),		               
		                'image' => $this->model->clean($this->post('image')),
						'status' => $this->model->clean($this->post('status'))
					);
					if($this->model->update($data))
					{
						$news = $this->model->getone($news->id);
						$this->model->logs('Cập nhật thành công slider: '.$news->name,$this->getcontrollername().'/'.$this->uri);
						$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
						if($this->model->clean($this->post('save')) == 1)
						{
							$this->setmsg('Cập nhật thành công.','success');
						}
						else{
							redirect('slider',2);
						}
					}
					else
					{
						$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
					}
				}
				else
				{
					$this->setmsg('Vui lòng nhập đầy đủ thông tin!','error');
				}

			}
			$this->setdata(array('slider'=>$news));
			$this->render('create_and_edit_form');
		}
	}
	function delete()
	{
		$id = $this->get('id');
		$news = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$news)
			redirect('slider',1);	
		$data = array(
				'id' => $news->id,
				'hide' => 2
		);
		if($this->model->update($data))
		{
			$this->model->logs('Xóa thành công slider: '.$news->name,'slider/delete/'.$news->id);
			redirect('news',2);
		}
		else
		{
			$this->setmsg('Xóa không thành công!','success');
		}
		$this->render('list_view');
	}
}
 
?>