<?php 
function load()
{
	spl_autoload_register(function($classname){
		$pathconfigdb = "system/config/$classname.php";
		$pathdb = "system/db/$classname.php";
		$pathcontroller = "controller/$classname.php";
		$pathmodel = "model/$classname.php";
		$pathfunc = "system/libs/$classname.php";
		include_once('system/define/define.php');
		if(file_exists($pathconfigdb))
			include_once($pathconfigdb);
		if(file_exists($pathdb))
			include_once($pathdb);
		if(file_exists($pathfunc))
			include_once($pathfunc);
		include_once('system/libs/funcs.php');
		if(file_exists($pathmodel))
			include_once($pathmodel);
		if(file_exists($pathcontroller))
			include_once($pathcontroller);
	});
}
?>