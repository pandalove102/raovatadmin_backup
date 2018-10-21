<?php 
error_reporting(E_ALL);
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
define('BASEURL',$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].($_SERVER['SERVER_PORT']!=80?':'.$_SERVER['SERVER_PORT']:'').str_replace('index.php','',$_SERVER['PHP_SELF']));
define('BASE',str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
define('SALT','abghnytjgfhfnyjr45645');
define('LANGUAGE','vi');
$GLOBALS['allows']  = array('logout','login');
//echo '<pre>',print_r($_SERVER),'</pre>';
$_SESSION['arraystatus'] = array(1=>'Hiện',2=>'Ẩn',3=>'Hết hàng',4=>'Đặt hàng',5=>'Ngừng kinh doanh',6=>'Hàng sắp về',7=>'Còn hàng',8=>'Giao hàng từ 3 đến 5 ngày',9=>'Giao hàng từ 30 đến 45 ngày');
$_SESSION['configgroup'] = array(
	1=>'Cấu hình chung',
	2=>'Gửi mail',
	3=>'SEO',
	4=>'Liên hệ',
	5=>'Footer',
	6=>'Khác'
);
?>