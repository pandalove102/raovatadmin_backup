<?php 
class model extends database
{
	var $table   = '';
	var $session = '';
	var $limt = '';
	function __construct()
	{
		parent::__construct();
		$this->session = new session();
	}
	//======= Hàm lọc dấu tiếng việt ===========//
    //==== Thông số đầu ra: echo $this->mcode->stripUnicode('Cách sử dụng hàm'); ====//
    public function stripUnicode($str) {
        if(!$str) return false;
        $str=strip_tags($str);
        $unicode=array('a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ','d' => 'đ','e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ','i' => 'í|ì|ỉ|ĩ|ị','o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ','u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự','y' => 'ý|ỳ|ỷ|ỹ|ỵ','A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ','D' => 'Đ','E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ','I' => 'Í|Ì|Ỉ|Ĩ|Ị','O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ','U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự','Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',);
        foreach($unicode as $nonUnicode => $uni) {
            $str=preg_replace("/($uni)/i",$nonUnicode,$str);
        }
        return $str;
	}

	//======= Hàm tạo tên username từ text ===========//
	public function generate_username_from_text($strText) {
        $strText=preg_replace('/[^A-Za-z0-9-]/',' ',$strText);
        $strText=preg_replace('/ +/',' ',$strText);
        $strText=trim($strText);
        $strText=str_replace(' ','',$strText);
        $strText=preg_replace('/-+/','',$strText);
        $strText=preg_replace("/-$/","",$strText);
        return $strText;
	}

	//==== Kết hợp: Hàm lọc dấu tiếng việt and tạo tên username từ text ====//
	public function createname($strText) {
        return  strtolower($this->generate_username_from_text($this->stripUnicode($strText)));
	}

	//======= Hàm lọc Script trong text ===========//
	public function clean($strText,$type='string') {
        $str=isset($strText)?preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', "", $strText):'';
        $str = trim($str);        
		switch($type)
		{
			case 'string':
				return $str;
				break;
			case 'number':
				return is_numeric($str)?$str:0;
				break;
			case 'datetime':
				return $str?date('Y-m-d H:i:s',strtotime($str)):date('Y-m-d H:i:s');
				break;
		}
	}

	//======= Mã hóa 3 lớp ===========//
	public function hash($text) {
        $str=sha1(md5(sha1($text)));
        return $str;
    }

    //======= Mã hóa 1 lớp ===========//
    public function hashmd5($text) {
        $str=md5($text);
        return $str;
    }
	function varray($ar,$exit = false)
	{
		echo '<pre>',print_r($ar),'</pre>';if($exit) exit;
	}
	function insert($data,$condition=array(),$table = '')
	{
		$table = $table ?$table:$this->table;
		$columns = '';
		$values=null;
		$error = 0;
		$strvalues = '';
		foreach($data as $k=>$v)
		{
			$columns.='`'.$k.'`,';
			$strvalues.='?,';
			$values[]=trim($v);
			/*if(trim($v)!='') 				
			else
				$error++;*/
		}
		if(!$error && $columns && $values && $strvalues){
			$columns = rtrim($columns,',');
			$strvalues = rtrim($strvalues,',');
			$lenh_sql = 'insert into '.$table.'('.$columns.') values('.$strvalues.')';
			$check =$condition?$this->getkey($condition):false;
			if(!$check){
				$this->setQuery($lenh_sql);
				$result = $this->execute($values);
				if($result)
					return 1;//ok
				else
					return 0;//lỗi server
			}else 
				return 3;//trùng mã khach hang
		}else
			return 2;//thông tin rỗng
	}
	function update($data,$condition=array(),$table = '')
	{
		$table = $table ?$table:$this->table;
		$columns = '';
		$values=null;
		$error = 0;
		foreach($data as $k=>$v)
		{
			if($k != 'id'){
				$columns.='`'.$k.'`=?,';
				$values[]=trim($v);
				/*if(trim($v)!='')
					$values[]=trim($v);
				else
					$error++;*/
			}
		}
		//varray($data);
		if(!$error && $columns && $values){
			$columns = rtrim($columns,',');
			$lenh_sql = 'update '.$table.' set '.$columns.' where id='.$data['id'];
			$check =$condition?$this->getone($condition):false;
			if(!$check){
				$this->setQuery($lenh_sql);
				$result = $this->execute($values);
				if($result)
					return 1;//ok
				else
					return 0;//lỗi server
			}else 
				return 3;//trùng email sdt
		}else
			return 2;//thông tin rỗng
	}
	function delete($id,$table='')
	{
		$table = $table ?$table:$this->table;
		if($id)
        {
            $lenh_sql = 'delete  FROM '.$table.' WHERE id = ? ';
			$this->setQuery($lenh_sql);
			return $this->execute(array($id));
		}else
			return false;
	}
	function deletequery($query,$param=array())
	{
		if($query)
        {
            $lenh_sql = $query;
			$this->setQuery($lenh_sql);
			return $this->execute($param);
		}else
			return false;
	}
	function getkey($data)
	{
		if(!empty($data))
        {
			$where='';
			$values = null;
			foreach($data as $k=>$v){
				$where .='`'.$k.'`=? and ';
				$values[]=$v;
			}
			if($where && $values)
			{
				$where = rtrim($where,'and ');
				$lenh_sql = 'SELECT * FROM '.$this->table.' WHERE '.$where;
				$this->setQuery($lenh_sql);
				$result = $this->loadAllRow($values);
				return $result;
			}else
				return false;
        }
        else
        {
           return false;
        }
	}
	function getone($id)
	{
		if($id)
        {
            $lenh_sql = 'SELECT * FROM '.$this->table.' WHERE id = ? limit 0,1';
			$this->setQuery($lenh_sql);
			$result = $this->loadRow(array($id));
			return $result;
        }
        else
        {
            return false;
        }
	}
	function getonekey($data)
	{
		if($data)
        {
            $rs = $this->getkey($data);
            return $rs?$rs[0]:false;
        }
        else
        {
            return false;
        }
	}
	function islogin()
	{
		$loginstate = $this->session->get('login'.SALT);
		$user = $this->session->get('admin_user');
		if(isset($loginstate,$user) && $loginstate && !empty($user))
		{
			return true;
		}else
			return false;
	}
	function logs($content = '',$type = '')
	{
		$data = array(
			'content' => $content,
			'type' => $type,
			'uid' => $this->session->get('admin_id'),
			'created' => date('Y-m-d H:i:s')
		);
		$this->insert($data,'','logs');
	}
}

?>