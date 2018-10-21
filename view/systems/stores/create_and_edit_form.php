<?php defined('BASE') OR exit('Access Deny');?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All form elements <small>With custom checbox and radion elements.</small></h5>
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
               <div class="form-horizontal">
                <form class="m-t" role="form" action="" method="post" id="form-users">
                    <input type="hidden" name="uri" id="uri" value="<?php echo $this->uri ?>">
                    <input type="hidden" name="id_user" id="id_user" value="<?=(isset($stores)) ? $stores->id : ''?>">
                     <div class="form-group"><label class="col-sm-2 control-label">Mã cửa hàng</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" <?=$this->uri == 'edit'?'disabled':'' ?> rows="1" required="" placeholder="Mã cửa hàng"  name="store_id" id="store_id" data-error="Nhập mã cửa hàng" data-error-1="Mã cửa hàng đã tồn tại!" data-url="<?=base_url('stores/api_check_storeid')?>" value="<?=(isset($stores)) ? $stores->store_id : ''?>">
                           </div>
                           <div class="block red mt5 font12"><b>Lưu ý:</b> Tên cửa hàng phải không có dấu và khoảng trống</div>
                        </div>
                     </div>
                    <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Tên cửa hàng</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" rows="1" required="" placeholder="tên cửa hàng"  name="name" id="name" data-error="Nhập tên cửa hàng" value="<?=(isset($stores)) ? $stores->name : ''?>">
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Địa chỉ</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" rows="1" required="" placeholder="Địa chỉ"  name="address" id="address" data-error="Nhập địa chỉ" value="<?=(isset($stores)) ? $stores->address : ''?>">
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Quận</label>
                        <div class="col-sm-3">
                           <select class="form-control m-b" name="district" id="district">
                              <?php foreach ($list_district as $v) { ?>
                                 <option value="<?php echo $v->id ?>" <?=(isset($stores) && $stores->district==$v->id) ? 'selected="selected"' : '' ?>><?php echo $v->name ?></option>
                              <?php } ?>
                           </select>
                           <div class="block red mt5 font12" style="text-align: center;"><b>Lưu ý:</b> Vui lòng chọn thành phố trước.</div>
                        </div>
                        <label class="col-sm-2 control-label">Thành Phố</label>
                        <div class="col-sm-3">
                           <select class="form-control m-b" name="city" id="city" data-url="<?=base_url('district/api_district')?>" onchange="getdistrict(this)">
                              <?php foreach ($list_city as $v) { ?>
                                 <option data-value="<?php echo $v->id ?>" value="<?php echo $v->id ?>" <?=(isset($stores) && $stores->city==$v->id) ? 'selected="selected"' : '' ?>><?php echo $v->name ?></option>
                              <?php } ?>
                           </select>
                        </div>

                     </div>
                      
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Số điện thoại</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="number" onkeyup="validateInp(this);" class="form-control area-input" rows="1" required="" placeholder="Số điện thoai"  name="cellularphone" id="cellularphone" data-error="Nhập số điện thoại" value="<?=(isset($stores)) ? $stores->cellularphone : ''?>">
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Fax</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="number" onkeyup="validateInp(this);" class="form-control area-input" rows="1" required="" placeholder="fax"  name="fax" id="fax" data-error="Nhập tên cửa hàng" value="<?=(isset($stores)) ? $stores->fax : ''?>">
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                          <?=$this->randtoken('tokenstore'); ?>
                            <a class="btn btn-white" type="text" href="<?=base_url('stores');?>">Đóng</a>
                            <button class="btn btn-primary" type="submit" name="save" value="1"><?php echo $this->save ?></button>
                            <button class="btn btn-primary" type="submit" name="save" value="2"><?php echo $this->save_close ?></button>
                        </div>
                    </div>
                </form>
             </div>
            </div>
        </div>
    </div>
</div>
<script>
function getdistrict(selectobj) {
    var url = $(selectobj).data(`url`),city=  $(selectobj).val();
    if(url && city){
          $.ajax({
          type: "POST",
          url: url,
          data:'city='+city,
          success: function(data){
                        $("#district").html(data);
                     }
          });
    }
}
</script>