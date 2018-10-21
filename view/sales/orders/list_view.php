<div class="row">
   <div class="col-lg-12">
      <div class="ibox float-e-margins">
         <div class="ibox-title">
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
      <div class="ibox float-e-margins">
         <div class="ibox-content">
            <div class="table-responsive">
               <div >
                 
                 
                  <table class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr role="row">
                           <th  style="width: 100px;">
						   <select id="s_status" class="form-control">
						   <option selected value="0">Tất cả</option>
							<?php 
							foreach($sta as $k=>$st)
							{
								echo '<option  value="'.$k.'">'.$st.'</option>';
							}
							?>
							<select>
						   </th>
                           <th style="width: 218px;">Đơn hàng</th>
                           <th style="width: 50px;">Số lượng</th>
                           <th  style="width: 105px;">Nơi nhận</th>
                           <th style="width: 105px;">
                              <span class="order-notes_head tips">Yêu cầu</span>
                           </th>
                           <th style="width: 105px;">Ngày tạo</th>
                           <th style="width: 105px;">Tổng giá</th>
                           <th  style="width: 50px;">Action</th>
                        </tr>
                     </thead>
                     <tbody id="c_order">
                        <?php if($orders) {foreach ($orders as $v) { ?>
                           <tr class="gradeA odd" role="row">
                              <td class="center w100 a-hide">
                                <?=$sta[$v->status]?>
                              </td>
                              <td><a href="#">#<?php echo $v->code ?></a> by <a href="#"><?php echo $v->name_customer ?></a><br><a href="#"><?php echo $v->email ?></a></td>
                              <td><?php echo $v->purchased ?></td>
                              <td><a target="_blank" href="https://www.google.com/maps/dir/<?php foreach($store as $s){ ?> <?php echo $s->address ?>,<?php echo $s->district ?>,<?php echo $s->city ?><?php } ?>/<?php echo $v->address_ship ?>,<?php echo $v->district ?>,<?php echo $v->city ?>"><?php echo $v->address_ship ?> , <?php echo $v->district ?> , <?php echo $v->city ?></a></td>
                              <td><?php echo $v->notes ?></td>
                              <td><?php echo $v->orderdate ?></td>
                              <td><?php echo number_format($v->total_price) ?> VNĐ<br><?=$v->payment_method=='Cash on Delivery'?'Tiền mặt':'Online'?></td>
                              <td class="center">
                                 <a href="<?=base_url('orders/edit/'.$v->id); ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                                 <a class="delete-confirm" href="<?=base_url('orders/delete/'.$v->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
                              </td>
                           </tr>
                        <?php }} else echo '<tr><td colspan="10">Chưa có dữ liệu</td></tr>' ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
$(function(){
	$('#s_status').change(function(){
		var _that = $(this);
		if(_that.val())
		{
			$.get('<?=base_url('orders/api_search') ?>',{status:_that.val()})
			.done(function(d){
				$('#c_order').html(d);
			})
		}
	});
})
</script>