<div class="row">
   <div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <form class="m-t" role="form" action="" method="get" id="form-users">
      <div class="ibox-content m-b-sm border-bottom">
          <div class="row">
            <div class="col-sm-4">
                  <div class="form-group">
                      <label class="control-label" for="sku">SKU</label>
                      <input type="text" id="skus" name="skus" value="<?=$this->get('skus') ?>" placeholder="SKU" class="form-control">
                  </div>
              </div>
              <div class="col-sm-4">
                  <div class="form-group">
                      <label class="control-label" for="product_name">Tên sản phẩm</label>
                      <input type="text" id="products" name="products" value="<?=$this->get('products') ?>" placeholder="Product Name" class="form-control">
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                      <label class="control-label" for="price">Giá</label>
                      <input type="number" id="prices" name="prices" value="<?=$this->get('prices') ?>" placeholder="Price" class="form-control">
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                      <label class="control-label" for="quantity">Số lượng</label>
                      <input type="number" id="qty" name="qty" value="<?=$this->get('qty') ?>" placeholder="Quantity" class="form-control">
                  </div>
              </div>
              <div class="col-sm-4">
                  <div class="form-group">
                      <label class="control-label" for="status">Danh mục sản phẩm</label>
                      <?=$this->api_listcatnice('parent_id',$this->get('parent_id'))?>
                  </div>
              </div>
              <div class="col-sm-4">
                  <div class="form-group">
                      <label class="control-label" for="status">Trạng thái</label>
                      <select name="status" id="status" class="form-control">
                          <option value="" >Trạng Thái</option>
                          <?php if($status) {foreach ($status as $v) { ?>
                            <option <?php echo $this->get('status') ==$v->id? 'selected':'' ?> value="<?php echo $v->id?>"><?php echo $v->name?></option>
                          <?php }} ?>
                      </select>
                  </div>
              </div>
              <?=$this->randtoken('tokensearch'); ?>
              <div class="col-sm-1" style="margin-top: 2%;margin-left: 24%;">
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Search</button>
                </div>
              </div>
          </div>
      </div>
    </form>
      <div class="row">
          <div class="col-lg-12">
              <div class="ibox">
                  <div class="ibox-content">
                    <div style="text-align: right;">
                      <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('catalog/create'); ?>">Thêm sản phẩm mới</a>
					  <?php $this->paging($totalpage,'left'); ?>
                    </div>
					
                      <table class="footable table table-stripped toggle-arrow-tiny" data-paging="false">
                        <thead>
                           <tr>
                              <th data-toggle="true">ID</th>
                              <th data-toggle="true">SKU</th>
                              <th data-toggle="true">H/Ảnh</th>
                              <th data-toggle="true">Tên sản phẩm</th>
                              <th data-hide="phone">Danh mục</th>
                              <th data-hide="all">Mô tả</th>
                              <th data-hide="phone">Giá</th>
                              <th data-hide="all" >Số lượng</th>
                              <th data-hide="phone">Trạng thái</th>
                              <th class="text-right" data-sort-ignore="true">H/Động</th>
                           </tr>
                        </thead>
                          <tbody>
                           <?php if($catalogs) {foreach ($catalogs as $v) { ?>
                              <tr class="footable-even" style="">
                                 <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    <?php echo $v->id ?>
                                 </td>
                                 <td class="footable-visible">
                                    <?php echo $v->sku ?>
                                 </td>
                                 <td class="footable-visible">
                                    <img src="<?=($v->image) ? $v->image : base_url('layout/images/no-image.png')?>" height="50px" width="50px">
                                 </td>
                                 <td class="footable-visible">
                                    <?php echo $v->name ?>
                                 </td>
                                 <td class="footable-visible">
                                    <?php echo $v->catname ?>
                                 </td>
                                 <td style="display: none;">
                                    <?php echo $v->description ?>
                                 </td>
                                 <td class="footable-visible">
                                    $ <?php echo number_format($v->price) ?> VNĐ
                                 </td>
                                 <td class="footable-visible">
                                    <?php echo $v->quantity ?>
                                 </td>
                                 <td>
                                  <?php if($status) {foreach ($status as $s) { ?>
                                    <span class="label label-primary"><?=(isset($v->status) && $v->status==$s->id) ? $s->name : '' ?></span>
                                  <?php }} ?>
                                 </td>
                                 <td class="text-right">
                                    <div class="btn-group">
                                       <a href="<?=base_url('catalog/edit/'.$v->id); ?>" class="btn-white btn btn-xs">Sửa</a>
                                       <a href="<?=base_url('catalog/delete/'.$v->id); ?>" class="btn-white btn btn-xs">Xóa</a>
                                    </div>
                                 </td>
                              </tr>
                           <?php }}else echo '<tr><td colspan="10">Chưa có dữ liệu</td></tr>' ?>
                          </tbody>
                      </table>
					  <?php $this->paging($totalpage); ?>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>