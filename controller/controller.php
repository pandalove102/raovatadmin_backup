<?php
class controller extends pager
{
	var $model;
	var $data;
	var $basepathview = 'view/';
	var $pathview = '';
	var $title = 'Control Panel';
	var $css = ''; 
	var $js = '';
	var $meta = '';
	var $msg = '';
	var $a = '';
	var $h = '';
	var $strong = '';
	var $html = '';
	var $pages = array(); 
	var $parent = ''; 
	var $numrow = 15;
	var $pos = 0;
	function __construct()
	{
		$this->pos = $this->tim_vi_tri_bat_dau($this->numrow);
	}
	function render($view,$baselayout = 'layout')
	{		
		if(file_exists($this->basepathview.$baselayout.'.php')){
			if(isset($this->data))extract($this->data);
			include  $this->basepathview.$baselayout .'.php';
		}
		return false;
	}
	function setcss($css = array())
	{
		if($css)
		{
			foreach($css as $cs)
				$this->css.= "  <link href='".base_url()."{$cs}' rel='stylesheet'>\n";
		}	
		
	}
	function setscript($script =array())
	{
		if($script)
		{
			foreach($script as $js)
				$this->js.= "<script src='".base_url()."{$js}'></script>\n";
		}	
		
	}
	function sethtml($html)
	{
		$this->html =  $html;
	}
	function loadhtml()
	{
		echo $this->html;
	}
	function setmeta($meta =array())
	{
		if($meta)
		{
			foreach($meta as $mta)
				$this->meta.= $mta."\n";
		}	
		
	}
	function setdata($data)
	{
		$this->data = $data;
	}
	function setmsg($msg,$type)
	{
		$this->msg = '<script>showMessage("'.$msg.'","'.$type.'");</script>';
	}
	function load($module)
	{
		if(file_exists($this->basepathview.$module.'.php'))
			include  $this->basepathview.$module.'.php';
	}
	function getcontrollername()
	{
    	return isset($_GET['controller']) && $_GET['controller']?$_GET['controller']:$_SESSION['controller_default'];
	}
	function getactionname()
	{
		return  isset($_GET['action'])?$_GET['action']:'';
	}
	function post($name='')
	{
		if($name)
			return  isset($_POST[$name])?$_POST[$name]:NULL;
		else 
			return isset($_POST)?$_POST:NULL;
	}
	function get($name='')
	{
		if($name)
			return  isset($_GET[$name])?$_GET[$name]:NULL;
		else 
			return isset($_GET)?$_GET:NULL;
	}
	function istoken($tokenid,$value = '')
	{
		$token = $this->model->session->get($tokenid);
		if($value){
			if($token && $token === $value)
			{
				return true;				
			}else
				return false;
		}
		else 
			return false;
	}
	function randtoken($tokenid)
	{
		$token = md5(time().rand(0,99999));
		$this->model->session->set($tokenid,$token);
		return '<input type="hidden" name="'.$tokenid.'" value="'.$token.'"/>';
	}
	function permiss($controller,$action)
	{
		//echo $allows;
		//echo '<pre>',print_r($GLOBALS),'</pre>';
		if(in_array($action,$GLOBALS['allows']) || strpos($action,'api_')!==false)
			return true;
		$rolemodel = new rolesmodel();
		$gid = $this->model->session->get('group_id');
		$uid = $this->model->session->get('admin_name');
		$check = $rolemodel->getpermiss($uid,$gid,$controller,$action);
		$this->pages = $rolemodel->getpages($uid,$gid);
		if( $uid=='admin') return true;
		$this->parent = $rolemodel->getparent($controller)->parent;
		if($check){			
			return true;
		}
		return false;
	}
	function getnamemenu($parent,$ctr='',$ac='')
	{
		$lan = $this->get('lang')?$this->get('lang'):LANGUAGE;
		$baseview = __DIR__.'/../view';
		if(!$ctr){
			if(file_exists($baseview.'/'.$parent.'/name.xml')){
				$names = simplexml_load_file($baseview.'/'.$parent.'/name.xml');
				//varray($names);
				return array('name'=>(string)$names->$lan,'icon'=>(string)$names->icon);
			}else
				return array('name'=>$parent,'icon'=>'fa fa-folder-o');
		}else
		{
			if(file_exists($baseview.'/'.$parent.'/'.$ctr.'/name.xml')){
				$names = simplexml_load_file($baseview.'/'.$parent.'/'.$ctr.'/name.xml');
				//varray($names);
				return array('name'=>(string)$names->$lan,'icon'=>(string)$names->icon);
			}else
				return array('name'=>$ctr,'icon'=>'fa fa-minus');
		}
	}
	function deny()
	{
		$this->title='Từ chối truy cập';
		$this->h = 'Từ chối truy cập';
		$this->strong = 'Bạn không thể sử dụng chức năng này';
		$this->pathview = 'view/systems/';
		$this->render('403');
	}
	function paging($totalrow=0,$align='right')
	{		
		$numpage = $this->tim_tong_so_trang($totalrow,$this->numrow);
		$this->in_bo_nut($numpage,$align);
	}
}
 
?>