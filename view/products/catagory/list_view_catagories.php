<?php defined('BASE') OR exit('Access Deny');?>
<div class="row">
	<div class="col-lg-12">
	   <div class="ibox float-e-margins">
			<div class="ibox-content">
				<div class="table-responsive">
               		<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
						<div id="DataTables_Table_0_filter" class="dataTables_filter">
		                  <div id="DataTables_Table_0_filter" class="dataTables_filter">
		                     <form method="get" action="<?=base_url('catagory'); ?>" id="form-search">
		                        <div class="form-group">
		                           <?=$this->randtoken('tokensearch'); ?>
		                           <input name="key" type="text" class="form-control" value="<?=$this->get('key') ?>" placeholder="Tên trạng thái">
		                           <button class="btn btn-primary" style="margin-bottom: 0px;" type="submit">Tìm Kiếm</button>
		                           <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('catagory/create'); ?>">Thêm mới</a>
		                        </div>            
		                     </form>
		                  </div>
		             	</div><br>
						<table class="table table-bordered  table-hover">
							<thead>
							<tr>
							 <th  style="width: 75px;">Mã</th>
							 <th  style="width: 60px;">Hình</th>
			                   <th style="width: 218px;">Tên</th>
			                   <th  style="width: 218px;">Alias</th>
			                   <th  style="width: 218px;">Danh mục con</th>
			                   <th style="width: 50px;">Trạng thái</th>
			                   <th  style="width: 50px;">Hành động</th>
							</tr>
							</thead>
							<tbody>
							 <?php if($catagories ) {foreach ($catagories as $v) { ?>
			                           <tr >
			                              <td ><?php echo $v->id ?></td>                             
			                              <td><img src="<?=(isset($v->image) && $v->image) ? $v->image : base_url('layout/images/no-image.png')?>" height="50px" width="50px"></td>
			                              <td ><?php echo $v->name ?></td>  
			                              <td ><?php echo $v->alias ?></td>  
			                              <td>
											<a><span class="fa fa-plus-circle btnopenuser" data-lv="1" data-id="<?php echo $v->id ?>"></span></a>                                
										  </td> 
										   <td class="text-center">
			                                 <?=$v->status==1?'<i class="fa fa-check"></i>':'<i class="fa fa-minus-circle"></i>'?>
			                              </td>
			                              <td class="center">
			                                 <a href="<?=base_url('catagory/edit/'.$v->id); ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
			                                 <a class="delete-confirm" href="<?=base_url('catagory/delete/'.$v->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
			                              </td>
			                           </tr>
									   <tr id="user_<?php echo $v->id ?>" class="hidden">								
									   </tr>
			                        <?php }} else echo '<tr><td colspan="7">Chưa có dữ liệu</td></tr>' ?>
						   
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.sub-table{
	margin: 0;
}
.sub-table td{
	
}
</style>
<script>
$(document).on('click','.btnopenuser',function(){
	var _that = $(this),id=_that.data('id'),lv=_that.data('lv'),c_user = $('#user_'+id);
	if(c_user.hasClass('hidden')){
		_that.removeClass('fa-plus-circle').addClass('fa fa-minus-circle');
		c_user.removeClass('hidden').html('<td colspan="10"><i class="fa fa-spin fa-spinner"></i> Đang tải dữ liệu</td>');
		$.post('<?=base_url('catagory/api_getsub') ?>',{parent:id,lv:lv}).done(function(d){
			if(d && d!='[]')
			{
				c_user.empty();
				d = JSON.parse(d);
				var str = '<td colspan="7" style="padding:0"><table class="table  sub-table">';
				$.each(d.data,function(i,u){
					 str += '<tr '+(d.lv==1?'class="success"':'class="info"')+'>'+
                              '<td width="75px">'+u.id+'</td> '+                            
                              '<td width="60px"><img src="'+(u.image?u.image:'<?=base_url()?>layout/images/no-image.png')+'" height="50px" width="50px"></td>'+
                              ' <td style="width: 218px;">'+(d.lv==1?'|-- ':'    |---- ')+u.name+'</td>'+  
                              '<td style="width: 218px;">'+u.alias+'</td>'+
                              ' <td style="width: 218px;">'+
								'<a><span class="fa fa-plus-circle btnopenuser" data-lv="'+(d.lv+1)+'" data-id="'+u.id+'"></span></a>'+                                
							  '</td>'+
							   '<td class="text-center" style="width: 50px;">'+
                               ( u.status==1?'<i class="fa fa-check"></i>':'<i class="fa fa-minus-circle"></i>')+
                              '</td>'+
                              '<td style="width: 50px;"><a href="<?=base_url('catagory/edit/'); ?>'+u.id+'" ><span class="glyphicon glyphicon-pencil"></span></a> '+
                                 '<a class="delete-confirm" href="<?=base_url('catagory/delete/'); ?>'+u.id+'"><span class="glyphicon glyphicon-trash"></span></a>'+
                              '</td>'+
                           '</tr>'+
                            '<tr id="user_'+u.id+'" class="hidden"></tr>';					
				});
				str += '</table></td>';
				c_user.html(str);
			}else{
				c_user.html('<td colspan="7">Không tìm thấy dữ liệu</td>');
			}
		})
	}else
	{
		_that.removeClass('fa-minus-circle').addClass('fa fa-plus-circle');
		c_user.addClass('hidden').html('');
	}
})
</script>