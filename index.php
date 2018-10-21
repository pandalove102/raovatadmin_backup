<?php 
include 'system/autoload.php';
load();
$controllername = isset($_GET['controller'] )&& !empty($_GET['controller'])?$_GET['controller'].'controller':'usercontroller';
if (class_exists($controllername)){
	$controller = new $controllername();
	if(!$controller->model->islogin())
	{
	    	$controller = new usercontroller();
		$controller->login();
	}else{
		$actionname = isset($_GET['action'])?$_GET['action']:'index';
		if($controller->permiss(str_replace('controller','',$controllername),$actionname))	{
			$controller->$actionname();
		}
		else
		{
			$controller->deny();
		}
	}
}else
{
	$controller = new systemcontroller();
	$controller->notfound();
}

?>