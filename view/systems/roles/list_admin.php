<?php defined('BASE') OR exit('Access Deny');?>
<div class="row">
   <div class="col-lg-12">
   <div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Nhóm người dùng</h5>
			<div class="ibox-tools">
				<a class="collapse-link">
					<i class="fa fa-chevron-up"></i>
				</a>
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-wrench"></i>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li><a href="#">Config option 1</a>
					</li>
					<li><a href="#">Config option 2</a>
					</li>
				</ul>
				<a class="close-link">
					<i class="fa fa-times"></i>
				</a>
			</div>
		</div>
		<div class="ibox-content">

			<table class="table table-bordered  table-hover">
				<thead>
				<tr>
					<th width="5%">#</th>
					<th>Nhóm</th>
					<th>Quản trị viên</th>
					<th align="right">Hành động</th>
				</tr>
				</thead>
				<tbody>
				 <?php if($group ) {foreach ($group as $v) { ?>
                           <tr >
                              <td class="sorting_1"><?php echo $v->id ?></td>                             
                              <td><?php echo $v->fullname ?></td>
                              <td>
								<a><span class="fa fa-plus-circle btnopenuser" data-id="<?php echo $v->id ?>" data-group="<?php echo $v->group_id ?>"></span></a>                                
							  </td>                            
                              <td align="right">
                                 <a href="<?=base_url('roles/group/'.$v->id); ?>" ><span class="glyphicon glyphicon-cog"></span> Cấp quyền</a>                                
                              </td>
                           </tr>
						   <tr id="user_<?php echo $v->group_id ?>" class="hidden">								
						   </tr>
                        <?php }} else echo '<tr><td colspan="4">Chưa có dữ liệu</td></tr>' ?>
			   
				</tbody>
			</table>
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
$('.btnopenuser').click(function(){
	var _that = $(this),id=_that.data('id'),group = _that.data('group'),c_user = $('#user_'+group);
	if(c_user.hasClass('hidden')){
		_that.removeClass('fa-plus-circle').addClass('fa fa-minus-circle');
		c_user.removeClass('hidden').html('<td colspan="10"><i class="fa fa-spin fa-spinner"></i> Đang tải dữ liệu</td>');
		$.post('<?=base_url('roles/api_qtv') ?>',{group:group}).done(function(d){
			if(d && d!='[]')
			{
				c_user.empty();
				d = JSON.parse(d);
				var str = '<td colspan="4" style="padding:0"><table class="table  sub-table">';
				$.each(d,function(i,u){
					 str += '<tr>'+
                              '<td width="5%">'+u.id+'</td> '+                            
                              '<td >'+u.fullname+'</td>'+ 												  
                              '<td align="right">'+
                                 '<a href="<?=base_url('roles/user/') ?>'+u.id+'" ><span class="glyphicon glyphicon-cog"></span> Cấp quyền</a>'+                                
                              '</td>'+
                           '</tr>';					
				});
				str += '</table></td>';
				c_user.html(str);
			}else{
				c_user.html('<td colspan="4">Không tìm thấy dữ liệu</td>');
			}
		})
	}else
	{
		_that.removeClass('fa-minus-circle').addClass('fa fa-plus-circle');
		c_user.addClass('hidden').html('');
	}
})
</script>