<div class="row">
   <div class="wrapper wrapper-content animated fadeInRight ecommerce">
      <div class="ibox-content m-b-sm border-bottom hidden">
          <div class="row">
              <div class="col-sm-4">
                  <div class="form-group">
                      <label class="control-label" for="product_name">Product Name</label>
                      <input type="text" id="product_name" name="product_name" value="" placeholder="Product Name" class="form-control">
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                      <label class="control-label" for="price">Price</label>
                      <input type="text" id="price" name="price" value="" placeholder="Price" class="form-control">
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                      <label class="control-label" for="quantity">Quantity</label>
                      <input type="text" id="quantity" name="quantity" value="" placeholder="Quantity" class="form-control">
                  </div>
              </div>
              <div class="col-sm-4">
                  <div class="form-group">
                      <label class="control-label" for="status">Status</label>
                      <select name="status" id="status" class="form-control">
                          <option value="1" selected="">Enabled</option>
                          <option value="0">Disabled</option>
                      </select>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-lg-12">
              <div class="ibox">
                  <div class="ibox-content">
                    <div style="text-align: right;">
                      <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('slider/create'); ?>">Add New</a>
                    </div>
                      <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                        <thead>
                           <tr>
                              <th data-toggle="true">ID</th>
                              <th data-toggle="true">Hình</th>
                              <th data-toggle="true">Tên</th>                              
                              <th data-hide="all">Link</th>
							  <th data-hide="all">Mô tả</th>
                              <th data-hide="phone">Trạng thái</th>
                              <th class="text-right" data-sort-ignore="true">Action</th>
                           </tr>
                        </thead>
                          <tbody>
                           <?php if($sliders) {foreach ($sliders as $v) { ?>
                              <tr class="footable-even" style="">
                                 <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    <?php echo $v->id ?>
                                 </td>
                                 <td class="footable-visible">
                                    <img src="<?=($v->image) ? $v->image : base_url('layout/images/no-image.png')?>" height="50px" width="50px">
                                 </td>
                                 <td class="footable-visible">
                                    <?php echo $v->name ?>
                                 </td>
                                 <td class="footable-visible">
                                    <?php 
                                          echo $v->link?>
                                 </td> 
								 <td class="footable-visible">
                                    <?php 
                                          echo $v->content?>
                                 </td> 
                                 <td>
                                    <span class="label label-primary <?php if($v->status!=1) echo 'hide'; ?>">Hiện</span>
                                    <span class="label label-danger <?php if($v->status!=2) echo 'hide'; ?>">Ẩn</span>
                                 </td>
                                 <td class="text-right">
                                    <div class="btn-group">
                                       <a href="<?=base_url('slider/edit/'.$v->id); ?>" class="btn-white btn btn-xs">Sửa</a>
                                       <a href="<?=base_url('slider/delete/'.$v->id); ?>" class="btn-white btn btn-xs">Xóa</a>
                                    </div>
                                 </td>
                              </tr>
                           <?php }}else echo '<tr><td colspan="10">Chưa có dữ liệu</td></tr>' ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>