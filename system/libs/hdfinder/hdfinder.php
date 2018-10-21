<?php 
@set_time_limit(ini_get('max_execution_time'));
$thumuc = isset($_GET['thumuc'])?$_GET['thumuc']:'';
define('DOMAIN','https://www.13thknight.com/'); //ten mien website, phai co dau / ở cuối
//echo '<pre>',print_r( $_SERVER),'<pre>';
 $baseDir ='/var/www/html/13thknight.com/';// str_replace($_SERVER['SERVER_NAME'],'',$_SERVER['DOCUMENT_ROOT']).'/public_html/';
function dochinh($ten,$baseDir)
{
	$exclude='/.jpg|.png|.gif|.jpeg|.bmp/';
	$kq = '';
    if (is_dir($ten)){		
		$i = 0;	
		if ($dh = opendir($ten)){
			while (($file = readdir($dh)) !== false){
				if ($file != '.' && $file != '..' && preg_match($exclude, $file))
				{
				  $image=str_replace($baseDir,DOMAIN,$ten.'/'.$file);
				  $kq .='<div class="item">
							<label title="'.$file.'"><img src="'.$image.'"/>
							<input value="'.$image.'" type="checkbox"/><br>'.substr($file,0,20).'...</label>
						</div>';
				}
			}
		}
	}
	echo $kq;
}
if(!empty($thumuc))
{
	dochinh($thumuc,$baseDir);
}else{	$folder = $baseDir.'data/';//thu muc cố dinh de luu tru hinh anh
?>
<meta charset="utf-8"/>
<style>
ul{
	list-style:none;
}
.khung-cha{
	overflow: hidden;
    width: 100%;
    display: flex;
}
.thu-muc{
	margin-right: 15px;
    border: 1px solid #ddd;
    padding: 10px;
	width:20%;
    border-radius: 10px;
}
.khung-chua-hinh{
	border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
	width:80%;
}
.khung-chua-hinh img{
	width:150px;
	height:70px;
	cursor:pointer;
}
.bo-nut{
	border: 1px solid #ddd;
    border-radius: 5px;
    padding: 5px;
    margin: 10px 0;
    text-align: right;
}
.thu-muc-cha ul{
	padding-left:15px;
}
.thu-muc-cha  li{
	cursor:pointer;
}
.item{float:left;margin-bottom:20px}
</style>
<div class="Khung-cha">
	<!-- left -->
	<div class="thu-muc">
	
		<ul class="thu-muc-cha" style="padding:0">
		<li onclick="chonthumuc('<?php echo $folder ?>')"><img class='icon' src='fd.gif'/> Hình </li>
		<?php 
		$exclude='/.jpg|.png|.gif|.jpeg|.bmp/';		
	//	echo is_dir($folder)?$folder:$folder,'no';
		if (is_dir($folder)){		
			$i = 0;	
	//	echo 123,	print_r( opendir($folder));
			if ($dh = opendir($folder)){
				while (($file = readdir($dh)) !== false){
					$sub =$folder.$file;
				if ($file != '.' && $file != '..' && is_dir($sub) && $file!='_thumbs')
				{
		?>
			<li style="margin-left:10px;" onclick="chonthumuc('<?php echo $sub ?>')"><img class='icon' src='fd.gif'/> <?php echo $file  ?></li>
		<?php 
		if ($dh1 = opendir($sub)){
				while (($file = readdir($dh1)) !== false){
					$sub2 =$sub.'/'.$file;
				if ($file != '.' && $file != '..' && is_dir($sub2))
		{ ?>
			<li style="margin-left:25px;" onclick="chonthumuc('<?php echo $sub2 ?>')"><img class='icon' src='fd.gif'/> <?php echo $file  ?></li>
		<?php 	
			if ($dh2 = opendir($sub2)){
				while (($file = readdir($dh2)) !== false){
					$sub3 =$sub2.'/'.$file;
				if ($file != '.' && $file != '..' && is_dir($sub3))
		{ 
		?>
			<li style="margin-left:45px;" onclick="chonthumuc('<?php echo $sub3 ?>')"><img class='icon' src='fd.gif'/> <?php echo $file  ?></li>
		<?php 	
		}}}
		}}}	
		} }}}?>
		</ul>		
	</div>
	<!-- right-->
	<div class="khung-chua-hinh" id="danhsachhinh">
	<?php if (is_dir($folder)){		
			$i = 0;	
			if ($dh = opendir($folder)){
				while (($file = readdir($dh)) !== false){
					$sub =str_replace($baseDir,DOMAIN,$folder.$file);
				if ($file != '.' && $file != '..' && preg_match($exclude, $file))
				{
		?>
		<div class="item">
			<label title="<?php echo $file ?>"><img src='<?php echo $sub ?>' /><input value="<?php echo $sub ?>" type="checkbox"/><br><?php echo substr($file,0,20) ?>
			</label>
		</div>		
	<?php }}}} ?>
	</div>
</div>
<div class="bo-nut">
	<input id="giatri" style="width:80%;margin-right:10px" value="" type="hidden" readonly /><input onclick="chonhinh()" id="btnChon" value="Chọn" type="button"/><input id="btnHuy" onclick="huy()" value="Hủy" type="button"/>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script>
	function chonhinh()
	{
		var value = '';
		$('#giatri').val('');
		sessionStorage.setItem("list_hinh",'');
		$('input:checked').each(function(){
			value += $(this).val()+',';
		});
		value = value.substring(0,value.length-1);
		$('#giatri').val(value);
		
		
		 //window.onunload = function (e) {
		       opener.setHD('<?php echo isset($_GET['id']) && $_GET['id']?$_GET['id']:$folder ?>',value);
		        //or you can do
		        //var para = opener.document.getElementById('samplePara');
		        //if (para != "undefied") {
		        //    para.style.backgroundColor = '#6CDBF5';
		        //}
		        window.close();
	 // };
	}
	function huy()
	{
		window.close();
	}
	function chonthumuc(ten)
	{
		var url = '?thumuc='+ten;
		$('#danhsachhinh').val('');
		$.post(url,function(data){
			$('#danhsachhinh').html(data);
		});
	}

</script>
<?php } ?>