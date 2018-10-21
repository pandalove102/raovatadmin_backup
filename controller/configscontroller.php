<?php
defined('BASE') OR exit('Access Deny');
class configscontroller  extends controller
{	
	function __construct()
	{
		$this->model = new configsmodel();
		$this->pathview = 'view/systems/configs/';
	}
	function index()
	{
		$this->title='Danh sách cấu hình';
		$this->h = 'Danh sách cấu hình';
		$this->a = 'Cấu hình';
		$this->strong = 'Danh sách';
		$this->save = 'Cập nhật';
		$this->size_image = '(300x300)px';
		$this->size_imgshare = '(300x300)px';
		$configs = $this->model->listconfigs();
		if($this->post() && $this->istoken('tokenconfigs',$this->model->clean($this->post('tokenconfigs'))))
		{
			//$this->model->varray($this->post(),true);
			$array = $this->post();
			foreach ($array as $k => $v)
			{
				$ar = explode('-', $k);
				if(count($ar)!=2) continue;
				$key=$ar[0];
				$id=$ar[1];
				//
				if($this->model->updateconfigs($id,$v))
				{
					$this->model->logs('Cập nhật thành công cấu hình: ',$this->getcontrollername());
					$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				}
				else
				{
					$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
				}
			}
		}
		$this->setdata(array('configs'=>$configs));
		$this->render('edit_form_configs');
	}
	function api_config($id ='',$name='',$value = '',$description = '',$types = '',$option = '',$small='')
	{
		if($types == 1) // Input cho này á
		{	
			$op = $option=='number'?'onkeyup="validateInp(this)"':'';
		   	echo '<div class="form-group"> <label class="col-sm-2 control-label">';
		   		echo $description.':</label>';
		   			echo '<div class="col-sm-10">';
		   			echo '<input type="text"'.$op.'required="required" placeholder="'.$description.'" class="form-control area-input" name="'.$name.'-'.$id.'" id="'.$name.'-'.$id.'" value="'.$value.'">';
		   	echo '</div>';
				echo '</div>';
		}
		elseif($types == 2) // Image
		{
			$src = (isset($value) && $value) ? $value : base_url('layout/images/no-image.png');
			$val = (isset($value)) ? $value : '';
			$onclicks = "openPopup('".$name.'-'.$id."'".")";
			echo '<div class="form-group"> <label class="col-sm-2 control-label">';
				echo $description.':</label>';
              echo '<div class="col-sm-9">';
                echo '<img src="'.$src.'" height="100px" width="100px">';
                echo '<input type="hidden" name="'.$name.'-'.$id.'" value="'.$val.'"  id="'.$name.'-'.$id.'" />';
                  echo '<button class="btn btn-info" type="button" onclick="'.$onclicks.'">Thêm</button>';
                  echo $small?$small:$this->size_image;
              echo '</div>';
           echo '</div>';
		}
		elseif($types == 3) // CKEDITOR
		{
			$des =  (isset($value)) ? $value : '';
			echo '<div class="form-group"> <label class="col-sm-2 control-label">';
				echo $description.':</label>';
              echo '<div class="col-sm-10">';
                echo '<textarea type="text" required="required" class="form-control area-input" name="'.$name.'-'.$id.'" id="'.$name.'-'.$id.'">'.$des.'</textarea>';
            echo '</div>';
           	echo '</div>';
		}
		elseif($types == 4) // Select status
		{
			$sletOn = (isset($value) && $value==1) ? 'selected="selected"' : '';
			$sletOff = (isset($value) && $value==2) ? 'selected="selected"' : '';
			echo '<div class="form-group"><label class="col-sm-4 control-label">';
				echo $description.':</label>';
                        echo '<div class="col-sm-4">';
                           	echo '<select class="form-control m-b" name="'.$name.'-'.$id.'">';
                              echo '<option value="1" '.$sletOn.'>Hiện</option>';
                              echo '<option value="2" '.$sletOn.'>Ẩn</option>';
                           echo '</select>';
                        echo '</div>';
            echo '</div>';
		}
	}
	function api_script()
	{
		$configs = $this->model->listconfigs();
		echo '<script type="text/javascript" src="'.BASEURL.'system/libs/ckeditor/ckeditor.js"></script>';
		echo '<script type="text/javascript">';
		foreach ($configs as $v) {
			if($v->types == 3)
			{
				echo 'CKEDITOR.replace("'.$v->name.'-'.$v->id.'");';
			}
		}
		echo '</script>';
	}
}
 
?>