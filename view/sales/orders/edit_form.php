<div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4>Thông tin giao nhận:</h4>
                                    <address>
                                        <strong><?=$order->name_customer?></strong><br>
										<?php if($order->receiptmethod=='Delivery'){ ?>
                                        <abbr title="Địa chỉ nhận hàng">Địa chỉ nhận hàng:</abbr> <?=$order->address_ship?><br>
										<?php }else{ ?>
										Nhận hàng tại cửa hàng<br>
										<?php } ?>
                                        <abbr title="Điện thoại">Điện thoại:</abbr> <?=$order->cellularphone?>
                                    </address>
									<address>
                                        <strong>Phương thức thanh toán: </strong><br><?=$order->payment_method=='Cash on Delivery'?'Thanh toán tiền mặt khi nhận hàng':'Thanh toán online'?>                                       
                                    </address>
									<?php if($order->compname){ ?>
									 <address>
                                        <strong>Xuất hóa đơn</strong><br>
										Tên công ty: <?=$order->compname?><br>
										Địa chỉ: <?=$order->addcomp?><br>
										MST: <?=$order->mst?><br>
                                    </address>
									<?php } ?>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h4>Thông tin đơn hàng</h4>
                                    <h4 class="text-navy"><?=$order->code?></h4>
                                    <address>
                                        <strong><?=$order->name_customer?></strong><br>
                                        <?=$order->address_ship?><br>
                                        <abbr title="Điện thoại">Điện thoại:</abbr> <?=$order->cellularphone?>
                                    </address>
                                    <p>
                                        <span><strong>Ngày đặt:</strong> <?=date('d/m/Y H:i:s',strtotime($order->orderdate))?></span><br/>
                                        <span><strong>Ngày giao hàng:</strong> <?=date('d/m/Y H:i:s',strtotime($order->ship_date))?></span>
                                    </p>
                                </div>
                            </div>

                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                    <tr>
                                        <th>Sản phẩm mua</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá(VNĐ)</th>
                                        <th>Thành tiền(VNĐ)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
								<?php 
								$total = 0;
								foreach($orders_item as $item){
									$tt = $item->qty*$item->price;
									$total+=$tt;
								?>
                                    <tr>
                                        <td><div><strong><img src="<?=$item->image?>" width="50"/> <?=$item->name?></strong></div>
                                        </td>
                                        <td><?=$item->qty?></td>
                                        <td><?=number_format($item->price)?></td>
                                        <td><?=number_format($tt)?></td>
                                    </tr>
								<?php } ?>  
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>Tổng :</strong></td>
                                    <td><?=number_format($total*(1-0.1))?></td>
                                </tr>
                                <tr>
                                    <td><strong>Thuế :</strong></td>
                                    <td><?=number_format($total*0.1)?></td>
                                </tr>
                                <tr>
                                    <td><strong>Tổng thanh toán :</strong></td>
                                    <td><?=number_format($total)?></td>
                                </tr>
								<tr>
                                    <td><strong>Trạng thái :</strong></td>
                                    <td>
										<select id="status" class="form-control">
										<?php 
										foreach($sta as $k=>$st)
										{
											echo '<option '.($order->status==$k?'selected':'').' value="'.$k.'">'.$st.'</option>';
										}
										?>
										<select>
									</td>
                                </tr>
								<tr id="scmt" class="<?=$order->status!=7?'hidden':''?>">
                                    <td><strong>Lý do :</strong></td>
                                    <td>
										<textarea id="cmt" class="form-control"><?=$order->comment?></textarea>
									</td>
                                </tr>
                                </tbody>
                            </table>
							<?php if($order->status!=5){ ?>
                            <div class="text-right">								
                                <button class="btn btn-primary change" data-id="<?=$order->id?>"><i class="fa fa-dollar"></i> Cập nhật đơn hàng</button>
                            </div>
							<?php } ?>
                            <div class="well m-t"><strong>Ghi chú khác: </strong>
                                <?=$order->notes?>
                            </div>
                        </div>
                </div>
            </div>
        </div>
<script>
$(function(){
	$('.change').click(function(){
		var _that = $(this),_sta=$('#status').val(),_cmt=$('#cmt').val(),id=_that.data('id');
		if(id && _sta){
			if(_sta==7)
			{
				if(_cmt.trim())
				{
					_that.loading();
					$.post('<?=base_url('orders/api_change') ?>',{id:id,status:_sta,cmt:_cmt})
					.done(function(d){
						if(d==1)
						{
							showMessage('Cập nhật đơn hàng thành công','success');
						}else
						{
							showMessage('Cập nhật đơn hàng thất bại','danger');
						}
						_that.finish('<i class="fa fa-dollar"></i> Cập nhật đơn hàng');
					})
				}
				else{
					showMessage('Vui lòng nhập lý do hủy đơn hàng','warning');
				}
			}else if(_sta==5)
			{
				_that.loading();
				$.post('<?=base_url('orders/api_change') ?>',{id:id,status:_sta,cmt:_cmt})
				.done(function(d){
					if(d==1)
					{
						showMessage('Cập nhật đơn hàng thành công','success');
						_that.remove();
					}else
					{
						showMessage('Cập nhật đơn hàng thất bại','danger');						
						_that.finish('<i class="fa fa-dollar"></i> Cập nhật đơn hàng');
					}
				})				
			}else{
				_that.loading();
				$.post('<?=base_url('orders/api_change') ?>',{id:id,status:_sta,cmt:_cmt})
				.done(function(d){
					if(d==1)
					{
						showMessage('Cập nhật đơn hàng thành công','success');
					}else
					{
						showMessage('Cập nhật đơn hàng thất bại','danger');
					}
					_that.finish('<i class="fa fa-dollar"></i> Cập nhật đơn hàng');
				})
			}
		}
	});
	$('#status').change(function(){
		var _that = $(this);
		if(_that.val()==7)
		{
			$('#scmt').removeClass('hidden');
		}else
		{
			$('#scmt').addClass('hidden');
		}
	});
})
</script>