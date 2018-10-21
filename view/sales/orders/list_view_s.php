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