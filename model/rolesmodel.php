<?php 
class rolesmodel extends model
{
	function __construct()
	{
		parent::__construct();		
	}
	function usergroup($group)
	{
		if($group)
		{
			$this->setQuery('select id,fullname,name,group_id from account where hide=1 and group_id=? and status = 1 and `lock` = 0');
			return $this->loadAllRow(array($group));
		}return NULL;
	}
	function getparent($controller)
	{
		if($controller)
		{
			$this->setQuery('select parent from roles where controller = ? limit 1');
			return $this->loadRow(array($controller));
		}return NULL;
	}
	function getgroup($id,$gid = '')
	{
		if($id)
		{			
			if($gid){
				$this->setQuery('select * from groups where hide=1 and  status = 1 and id=? and group_id=? limit 1');
				return $this->loadRow(array($id,$gid));
			}else{
				$this->setQuery('select * from groups where hide=1 and  status = 1 and id=? limit 1');
				return $this->loadRow(array($id));
			}
		}return NULL;
	}
	function getuser($id)
	{
		if($id)
		{			
			$this->setQuery('select *,(select id from groups where group_id=account.group_id) gid from account where hide=1 and  status = 1 and `lock`=0 and id=? limit 1');
			return $this->loadRow(array($id));		
		}return NULL;
	}
	function getdenyuser($uid)
	{
		if($uid)
		{			
			$this->setQuery('select * from userdeny where uname=? ');
			return $this->loadAllRow(array($uid));
		}return NULL;
	}
	function getrolegroup($gid)
	{
		if($gid)
		{			
			$this->setQuery('select * from roles where groupid=?  order by parent,controller,action');
			return $this->loadAllRow(array($gid));
		}return NULL;
	}
	function getpermiss($uid,$gid,$controller,$action)
	{
		if($uid && $gid && $controller && $action)
		{			
			$this->setQuery('select * from roles where groupid=? and controller = ? and action=?');
			$gper = $this->loadRow(array($gid,$controller,$action));
			if($gper)
			{
				$this->setQuery('select * from userdeny where uname=? and controller = ? and action=?');
				$uper = $this->loadRow(array($uid,$controller,$action));
				if(!$uper)
					return $gper;
				else
					return NULL;
			}
			return NULL;
		}
		return NULL;
	}
	function getdefault($uid,$gid)
	{
		if($uid && $gid)
		{			
			$this->setQuery('select * from roles r where groupid=? and `controller` !="user" and action="index" and not exists (select "x" from userdeny d where d.parent = r.parent and d.controller = r.controller and d.action=r.action and d.uname=?)');
			return $gper = $this->loadRow(array($gid,$uid));			
		}
		return NULL;
	}
	function getpages($uid,$gid)
	{
		if($uid && $gid)
		{			
			$this->setQuery('select * from roles where groupid=? and not EXISTS (select "x" from userdeny where controller=roles.controller and action=roles.action and parent=roles.parent and uname=?) order by parent,controller,action');
			$gper = $this->loadAllRow(array($gid,$uid));
			if($gper)
			{				
				return $gper;
			}
			return NULL;
		}
		return NULL;
	}
	function denygroup($gid)
	{
		if($gid)
		{		
			$this->setQuery('delete from roles where groupid=?');
			return $this->execute(array($gid));
		}return false;
	}
	function grantuser($uid)
	{
		if($uid)
		{		
			$this->setQuery('delete from userdeny where uname=?');
			return $this->execute(array($uid));
		}return false;
	}
	function grantgroup($gid,$pages)
	{
		if($gid && $pages)
		{		
			$sql = '';
			foreach($pages as $page){
				$ars = explode('/',$page);
				if(count($ars)==3){
					$link = $ars[1].'/'.$ars[2];
					$sql .="insert into roles(`controller`,`action`,`parent`,`link`,`groupid`) values('{$ars[1]}','{$ars[2]}','{$ars[0]}','{$link}','$gid');";
				}
			}
			if($sql){
				$this->denygroup($gid);
				$this->setQuery($sql);
				return $this->execute();
			}
			return false;
		}return false;
	}
	function denyuser($uid,$pages)
	{
		if($uid && $pages)
		{		
			$sql = '';
			foreach($pages as $page){
				$ars = explode('/',$page);
				if(count($ars)==3){
					$link = $ars[1].'/'.$ars[2];
					$sql .="insert into userdeny(`controller`,`action`,`parent`,`link`,`uname`) values('{$ars[1]}','{$ars[2]}','{$ars[0]}','{$link}','$uid');";
				}
			}
			if($sql){
				$this->grantuser($uid);
				$this->setQuery($sql);
				return $this->execute();
			}
			return false;
		}return false;
	}
	function listpage($gid=array())
	{
		$lan = isset($_GET['lang']) &&$_GET['lang']?$_GET['lang']:LANGUAGE;
		$list = array();
		$baseview = __DIR__.'/../view';
		$fd = opendir($baseview);
		if($fd)
		{
			$parentaction = get_class_methods('controller');
			while($f = readdir($fd))
			{
				if($f != '.' && $f!='layout'  && $f != '..' && is_dir($baseview.'/'.$f))
				{					
					//$list[$f] = $f;
					//echo $baseview.'/'.$f.'<bR>';
					$sfd = opendir($baseview.'/'.$f);
					if($sfd)
					{						
						if(file_exists($baseview.'/'.$f.'/name.xml')){
							$names = simplexml_load_file($baseview.'/'.$f.'/name.xml');
							//varray($names);
							$list[$f]['name'] = (string)$names->$lan;
						}
						while($controller = readdir($sfd))
						{
							if($controller != '.' && $controller != '..'  && is_dir($baseview.'/'.$f.'/'.$controller))
							{ 
								//echo $baseview.'/'.$f.'/'.$controller.'/name.xml';								
								$childaction  = get_class_methods($controller.'controller');								
								if($childaction){	
									if(file_exists($baseview.'/'.$f.'/'.$controller.'/name.xml')){
										$names = simplexml_load_file($baseview.'/'.$f.'/'.$controller.'/name.xml');
										//varray($names);
										$list[$f][$controller]['name'] = (string)$names->$lan;
									}
									$actions  = array_diff($childaction,$parentaction );
									foreach($actions as $action)
										if(strpos($action,'api_') ===false && $action !='__construct')
											$list[$f][$controller][] = $action;
								}								
							}
						}
					}
				}
			}
		}
		//varray($list);
		return $list;			
	}
	
}

?>