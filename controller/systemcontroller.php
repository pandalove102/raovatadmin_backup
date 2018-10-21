<?php
defined('BASE') OR exit('Access Deny');
class systemcontroller  extends controller
{	
	function __construct()
	{
		$this->pathview = 'view/systems/';
	}
	function notfound()
	{
		$this->render('404','loginlayout');
	}
}
 
?>