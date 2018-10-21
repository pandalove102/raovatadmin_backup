<?php defined('BASE') OR exit('Access Deny');?>
<div class="row">
   <div class="col-lg-12">
   <div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Chọn chức năng cấp quyền cho nhóm "<?=$group->fullname ?>"</h5>
			<div class="ibox-tools">	
				<a id="all" class="btn btn-default btn-xs" data-full='true'>
					<i class="fa fa-check-square-o"></i> Full quyền
				</a>
				<?php if($pages){ ?>
				<a id="save" class="btn btn-success btn-xs" data-id="<?=$group->id ?>" data-gid="<?=$group->group_id ?>">
					<i class="fa fa-save"></i> Cập nhật
				</a> 
				<?php } ?>
				<a href="<?=base_url('roles') ?>"  class="btn btn-danger btn-xs">
					Bỏ qua
				</a>
			</div>
		</div>
		<div class="ibox-content">

			<div id="treemenu">
			<?php 
			if($pages){
				//$this->model->varray($pages);
				echo '<ul>';
				foreach($pages as $k=>$controller){
			?>
            
                <li> <?=mb_strtoupper($controller['name'],'utf-8') ?>
                <ul>
					<?php
						foreach($controller as $c=>$action){
							if(!is_array($action))
								continue;
							//varray($controller[$c]);
					?>
                        <li > <?=mb_strtoupper($controller[$c]['name'],'utf-8')?>
							<ul>
								<?php
									foreach($action as $ka=>$ac){
										//echo $ac,'<br>';
										if($ka!=='name'){
								?>
									<li data-value="<?=$k.'/'.$c.'/'.$ac ?>"> <?=strtoupper($ac) ?></li>
										<?php }
									} 
									?>
							 </ul>
						</li>
						<?php } ?>
                 </ul>
                </li>                
				<?php }
				echo '</ul>';
				}else echo '<div class="alert alert-danger">Không tải được danh sách chức năng</div>'; 
				//$this->model->varray($roles);
				?>
        </div>
		</div>
	</div>
      
   </div>
</div>
 <script>
 $(function(){
	$('#treemenu').treeview({
		debug : true,
		<?php 
		if($roles)
		{
			echo 'data: [';
			foreach($roles as $role)
			{
				$val = $role->parent.'/'.$role->link;
				echo "'{$val}',";
			}
			echo ']';
		}
		?>
		//data : ['links', 'Do WHile loop']
	});	
	$('#save').click(function(){
		var _that = $(this),id=_that.data('id'),group = _that.data('gid'),pages =  $('#treemenu').treeview('selectedValues');
		if(id && group){
			_that.loading();			
			$.post('<?=base_url('roles/api_setpermiss_group') ?>',{groupid:group,id:id,pages:pages.length>0?pages:null}).done(function(d){
				d = JSON.parse(d);
				showMessage(d.msg,d.type);
			}).always(function(){
				_that.finish('<i class="fa fa-save"></i> Cập nhật');
			})
		}else
		{
			showMessage('Lỗi dữ liệu, vui lòng thoát khỏi trang tràng và thử lại','error');
		}
	});
	$('#all').click(function(){
		var _that = $(this),full = _that.data('full');
		if(full){
			$('input[type="checkbox"]').prop('checked',true);
			$('#treemenu ul ul').removeClass('out').addClass('in');
			_that.data('full',false);
		}
		else
		{
			$('input[type="checkbox"]').prop('checked',false);
			_that.data('full',true);
			$('#treemenu ul ul').removeClass('in').addClass('out');
		}
	});
 });
        </script>