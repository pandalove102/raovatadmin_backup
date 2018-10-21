<?php defined('BASE') OR exit('Access Deny');?>
<div class="row">
   <div class="col-lg-12">
   <div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Chọn chức năng cấp quyền cho quản trị "<?=$user->fullname ?>"</h5>
			<div class="ibox-tools">	
				<a id="all" class="btn btn-default btn-xs" data-full='<?php echo $denys?'true':'false' ?>'>
					<i class="fa fa-check-square-o"></i> Full quyền
				</a>
				<?php if($roleg){ ?>
				<a id="save" class="btn btn-success btn-xs" data-id="<?=$user->id ?>" data-uid="<?=$user->name ?>" data-gid="<?=$user->group_id ?>">
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
			if($roleg){
				//$this->model->varray($pages);
				$check = $roleg[0]->parent; 
				echo '<ul>';
				foreach($roleg as  $i=>$p){
					if($i !=0 && $p->parent == $check)
						continue;
					else{
						$check = $p->parent;
					}
			?>
            
                <li> <?=$this->getnamemenu($p->parent)['name'] ?>
                <ul>
					<?php
						$check2 = ''; 
						foreach($roleg as $i2=>$c){
							if($c->parent == $p->parent && ($check2=='' || $check2 != $c->controller)){						
					?>
                        <li > <?=$this->getnamemenu($p->parent,$c->controller)['name'] ?>
							<ul>
								<?php								
									foreach($roleg as $i3=>$ac){
										if($c->parent == $p->parent && $ac->controller==$c->controller ){																		
								?>
									<li data-value="<?=$ac->parent.'/'.$ac->controller.'/'.$ac->action ?>"> <?=strtoupper($ac->action) ?></li>
										<?php }
										} ?>
							 </ul>
						</li>
						<?php 
							$check2=$c->controller;
						}
					} ?>
                 </ul>
                </li>                
				<?php }
				echo '</ul>';
				}else echo '<div class="alert alert-danger">Không tải được danh sách chức năng</div>';
				//$this->model->varray($roleg);				
				//$this->model->varray($denys);
				//$this->model->varray($pages);
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
		if($roleg)
		{
			echo 'data: [';
			foreach($roleg as $role)
			{
				if($denys)
				{
					$s = true;
					foreach($denys as $d)
					{						
						if($role->parent == $d->parent && $role->controller == $d->controller && $role->action == $d->action  )
						{
							$s = false;
							break;	
						}						
					}	
					if($s)
					{
						$val = $role->parent.'/'.$role->link;
						echo "'{$val}',";
					}	
				}else{
					$val = $role->parent.'/'.$role->link;
					echo "'{$val}',";
				}
			}
			echo ']';
		}
		?>
		//data : ['links', 'Do WHile loop']
	});	
	$('#save').click(function(){
		var _that = $(this),id=_that.data('id'),uid = _that.data('uid'),pages = [];
		$('input[type="checkbox"]').each(function(i,c){
			if($(c).val() && $(c).is(':checked')==false)
			{
				pages.push($(c).val());
			}
		});
		if(id && uid){
			_that.loading();			
			$.post('<?=base_url('roles/api_setpermiss_user') ?>',{id:id,uid:uid,pages:pages.length>0?pages:null}).done(function(d){
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