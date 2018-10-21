<?php
defined('BASE') OR exit('Access Deny');
class querycontroller  extends controller
{	
	function __construct()
	{
		$this->model = new querymodel();
		$this->pathview = 'view/systems/query/';
	}
	public function index() {
		// Cấu hình tiêu đề giao diện mõi trang
    	$this->title=("Query");
        $this->h_title=("Query Database");
        $this->a_title=("Query");
        $this->strong_title=("List");
		$this->setcss(array(base_url().'assets/admin/css/plugins/dataTables/datatables.min.css'));
    	$this->setscript(array(base_url().'assets/admin/js/plugins/dataTables/datatables.min.js'));
		// Lấy nội dung của trang
		if($this->post()) {
			if(strpos(strtolower($_POST['sql']),'select ')!==false){
				$this->setdata(array('list'=>$this->model->query(trim($_POST['sql']))));
			}
        }
        $this->render('form');
    }
}
 
?>