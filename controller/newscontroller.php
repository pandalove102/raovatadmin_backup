<?php
defined('BASE') OR exit('Access Deny');
class newscontroller  extends controller
{	
	var $catmodel ;
	var $catcon ;
	function __construct()
	{
		$this->model = new newsmodel();
		$this->models = new catagoriesmodel(); 
		$this->catmodel = new catagorymodel(); 
		$this->pathview = 'view/newpagers/news/';
	}
	function index()
	{
		$this->title='Danh sách bài viết';
		$this->h = 'Danh sách bài viết';
		$this->a = 'Bài viết';
		$this->strong = 'Danh sách';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$this->setdata(array('news'=>$this->model->listnews(),'catagories'=>$this->models->listcatagories()));
		$this->render('list_view');
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
	function api_check_news($return = false)
	{
		if($this->model->islogin()){
			$name = $this->model->clean($this->post('username'));
			$uri = $this->model->clean($this->post('uri'));
			$id = $this->model->clean($this->post('id_user'));
			if($uri == 'create')
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
				$check = $this->model->getkey(array('name'=>$name));
				$check_again = $this->model->getkey(array('id'=>$id));
				$checking = $check ? $check[0]->name:'null';
				if($checking == $check_again[0]->name)
				{
					if($return) return true; else echo "true";
				}
				else if($checking != 'null' && $checking != $check_again[0]->name)
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
	function create()
	{
		$this->title ='Thêm bài viết';
		$this->h = 'Thêm bài viết';
		$this->a = 'Bài viết';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->size_image = '(300x300)px';
		$this->size_imgshare = '(300x300)px';
		$this->uri = $this->getactionname();
		$this->catcon = new catagorycontroller();
		$this->setdata(array('list_catagory'=>$this->models->listcatagories(),'catcontrl'=>$this->catcon));
		if($this->post() && $this->istoken('tokennews',$this->model->clean($this->post('tokennews'))))
		{		
			$jsonarray = array();	
			if($this->post('imgs'))
			{				
				if($this->post('imgs')){
					foreach($this->post('imgs') as $i=>$img)
					{
						$jsonarray[] = array('img'=>$img,'pos'=>$this->post('pos')[$i],'link'=>$this->post('links')[$i]);
					}
				}
			}
			$json = $jsonarray? json_encode($jsonarray):'';
			if($this->api_check_news(true) && $this->api_check_alias(true))
			{
				$catshow = implode(',',$this->post('catshow'));
				$data = array(
					'catshow' => $catshow,
					'name' => $this->model->clean($this->post('username')),
					'alias' => $this->post('alias'),
					'shortdescription' => $this->model->clean($this->post('shortdescription')),
					'description' => $this->model->clean($this->post('description')),
					'h1' => $this->model->clean($this->post('h1')),
					'metakey' => $this->model->clean($this->post('metakey')),
					'metadesc' => $this->model->clean($this->post('metadesc')),
					'metatitle' => $this->model->clean($this->post('metatitle')),
					'image' => $this->model->clean($this->post('image')),
					'imgshare' => $this->model->clean($this->post('imgshare')),
					'images' => $json,
					'status' => $this->model->clean($this->post('status')),
					'catagories_id' => $this->model->clean($this->post('catagorie_id')),
					'username' => $this->model->clean($this->model->session->get('admin_name')),
					'create_at' => date('Y-m-d H:i:s'),
					'hide' => 1
				);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công bài viết: '.$this->model->clean($this->post('username')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('news',2);
					}
				}
				else
				{
					$this->setmsg('Thêm thất bại.','error');
				}
			}
			else
			{
				$this->setmsg('Tên bài viết đã tồn tại!','error');
			}
		
		//else
		//{
		//	$this->setmsg('Vui lòng nhập đầy đủ thông tin!','error');
		//}
		}
		$this->render('create_and_edit_form');
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
		$news = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$news)
			redirect('news/create',1);
		else
		{
			$this->uri = $this->getactionname();
			if($this->post() && $this->istoken('tokennews',$this->model->clean($this->post('tokennews'))))
			{
				$jsonarray = array();
				if($this->post('imgs'))
				{					
					if($this->post('imgs')){
						foreach($this->post('imgs') as $i=>$img)
						{
							$jsonarray[] = array('img'=>$img,'pos'=>$this->post('pos')[$i],'link'=>$this->post('links')[$i]);
						}
					}
				}
					$json = $jsonarray? json_encode($jsonarray):'';		
					$catshow = implode(',',$this->post('catshow'));
					$data = array(
						'id' => $news->id,
						'catshow' => $catshow,
		                'name' => $this->model->clean($this->post('username')),
		                'alias' => $this->post('alias'),
		                'shortdescription' => $this->model->clean($this->post('shortdescription')),
		                'description' => $this->model->clean($this->post('description')),
		                'h1' => $this->model->clean($this->post('h1')),
		                'metakey' => $this->model->clean($this->post('metakey')),
		                'metadesc' => $this->model->clean($this->post('metadesc')),
		                'metatitle' => $this->model->clean($this->post('metatitle')),
		                'image' => $this->model->clean($this->post('image')),
		                'imgshare' => $this->model->clean($this->post('imgshare')),
		                'images' => $json,
						'status' => $this->model->clean($this->post('status')),
		                'catagories_id' => $this->model->clean($this->post('catagorie_id')),
		                'username' => $this->model->clean($this->model->session->get('admin_name')),
						'update_at' => date('Y-m-d H:i:s'),
					);
					if($this->model->update($data))
					{
						$news = $this->model->getone($news->id);
						$this->model->logs('Cập nhật thành công nhóm: '.$news->name,$this->getcontrollername().'/'.$this->uri);
						$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
						if($this->model->clean($this->post('save')) == 1)
						{
							$this->setmsg('Cập nhật thành công.','success');
						}
						else{
							redirect('news',2);
						}
					}
					else
					{
						$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
					}
				
				//else
				//{
					//$this->setmsg('Vui lòng nhập đầy đủ thông tin!','error');
				//}

			}
			$this->catcon = new catagorycontroller();
			$this->setdata(array('news'=>$news,'list_catagory'=>$this->models->listcatagories(),'catcontrl'=>$this->catcon));
			$this->render('create_and_edit_form');
		}
	}
	function delete()
	{
		$id = $this->get('id');
		$news = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$news)
			redirect('news',1);	
		$data = array(
				'id' => $news->id,
				'hide' => 2
		);
		if($this->model->update($data))
		{
			$this->model->logs('Xóa thành công bài viết: '.$news->name,'news/delete/'.$news->id);
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