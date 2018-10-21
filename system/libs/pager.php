<?php
class pager
{
/***********************************************************************************
* Ham int findStart (int limit)
* Tra ve dong bat dau cua trang duoc chon dua tren trang lay duoc va bien limit
***********************************************************************************/
	function tim_vi_tri_bat_dau($so_mau_tin_tren_mot_trang)
	{
		if ((!isset($_GET['page'])) || ($_GET['page'] == "1"))
		{
			$start = 0;
			$_GET['page'] = 1;
		}
		else
		{
			$start = ($_GET['page']-1) * $so_mau_tin_tren_mot_trang;
		}
		
		return $start;
	}
/***********************************************************************************
* Ham int findPages (int count, int limit)
* Tra ve so luong trang can thiet dua tren tong so dong co trong table va limit
***********************************************************************************/
	function tim_tong_so_trang($tong_so_mau_tin, $so_mau_tin_tren_mot_trang)
	{
		return ceil($tong_so_mau_tin / $so_mau_tin_tren_mot_trang);
	}

	function in_bo_nut($tong_so_trang,$align = 'right')
	{
		if (empty($_GET['page'])) $curpage = 1;
		else $curpage = $_GET['page'];
		echo '<div style="clear:both">';
		echo '<ul class="pagination pull-'.$align.'">';
		
		$query_string = $this->deleteParam($_SERVER['QUERY_STRING'], 'page');
				
		/* In trang dau tien va nhung link toi trang truoc neu can */
		if (($curpage != 1) && ($curpage))
		{
			echo  "<li><a class=\"number\"  href=\"".$_SERVER['PHP_SELF']."?".$query_string."page=1\" title=\"Trang đầu\"><i class='fa fa-step-backward' aria-hidden='true'></i></a> </li>";
		} else {
			echo  "<li><a class=\"number \"  disable title=\"Trang đầu\"><i class='fa fa-step-backward' aria-hidden='true'></i></a></li>";
		}
	
		if (($curpage-1) > 0)
		{
			echo  "<li><a class=\"number\"  href=\"".$_SERVER['PHP_SELF']."?".$query_string."page=".($curpage-1)."\" title=\"Về trang trước\"><i class='fa fa-backward' aria-hidden='true'></i></a></li>";
		} else {
			echo  "<li><a class=\"number \" disable title=\"Về trang trước\"><i class='fa fa-backward' aria-hidden='true'></i></a></li>";
		}
			
		/* In ra danh sach cac trang va lam cho trang hien tai dam hon va mat link o chan*/
		$vt_dau = max($curpage - 3, 1);
		$vt_sau = min($curpage + 3, $tong_so_trang);
		
		if ($vt_dau > 1) echo '<li><a>...</a></li>';
		for ($i=$vt_dau; $i<=$vt_sau; $i++)
		{
			if ($i == $curpage)
			{
				echo  "<li><a class=\"number current\" disable><b>".$i."</b></a></li>";
			}
			else
			{
				echo  "<li><a class=\"number\" href=\"".$_SERVER['PHP_SELF']."?".$query_string."page=".$i."\" title=\"Trang ".$i."\">".$i."</a></li>";
			}
		}
		if ($vt_sau < $tong_so_trang) echo '<li><a>...</a></li>';

		/* In linh cua trang tiep theo va trang cuoi cung neu can*/
		if (($curpage+1) <= $tong_so_trang)
		{
			echo  "<li><a class=\"number\"  href=\"".$_SERVER['PHP_SELF']."?".$query_string."page=".($curpage+1)."\" title=\"Đến trang sau\"><i class='fa fa-forward' aria-hidden='true'></i></a></li>";
		} else {
			echo  "<li><a class=\"number\" disable title=\"Dến trang sau\"><i class='fa fa-forward' aria-hidden='true'></i></a> ";
		}
		
		if (($curpage != $tong_so_trang) && ($tong_so_trang != 0))
		{
			echo  "<li><a  class=\"number\" href=\"".$_SERVER['PHP_SELF']."?".$query_string."page=".$tong_so_trang."\" title=\"Trang cuối\"><i class='fa fa-step-forward' aria-hidden='true'></i></a></li>";
		} else {
			echo  "<li><a  class=\"number\" disable title=\"Trang cuối\"><i class='fa fa-step-forward' aria-hidden='true'></i></a></li>";
		}
		echo '<ul></div>';
	}
	
/***********************************************************************************
* Ham: string pageList (int curpage, int pages)
* Tra ve danh sach trang theo dinh dang "Trang dau tien  < [cac trang] > Trang cuoi cung"
***********************************************************************************/
	private function deleteParam($query_string, $param)
	{
		//////xử lý giữ tham số trên url
		
		if($query_string!='')
		{
			$query_string = preg_replace('/(^'.$param.'=[\da-zA-Z]*&)|(&?'.$param.'=[\da-zA-Z]*)|/', '', $query_string);

			if($query_string)
				$query_string = "$query_string&";

		}
		//////xử lý giữ tham số trên url
		return $query_string;
	}	
}
?>