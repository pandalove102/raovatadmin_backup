<?php 
class vouchermodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'landing_code';
	}
}

?>