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
                    <input type="hidden" name="id_user" id="id_user" value="<?=(isset($attribute)) ? $attribute->id : ''?>">
                     <div class="form-group"><label class="col-sm-2 control-label">Nhãn</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" <?=$this->uri == 'edit'?'disabled':'' ?> rows="1" required="" placeholder="Nhãn"  name="username" id="username" data-error="Nhập label" data-error-1="Label đã tồn tại!" data-url="<?=base_url('attribute/api_check_label')?>" value="<?=(isset($attribute)) ? $attribute->label : ''?>">
                           </div>
                           <div class="block red mt5 font12"><b>Lưu ý:</b> Tên thuộc tính là duy nhất</div>
                        </div>
                     </div>
                    <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Giá trị mặc định</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" rows="1" required="" placeholder="Giá trị mặc định"  name="defaultvalue" id="defaultvalue" data-error="Nhập tên nhóm" value="<?=(isset($attribute)) ? $attribute->defaultvalue : ''?>">
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Bắt buộc</label>
                        <div class="col-sm-9">
                           <div class="relative">
                             <select class="form-control m-b" name="requrire">                              
                              <option value="0" <?=(isset($attribute) && $attribute->requrire==0) ? 'selected="selected"' : '' ?>>Không</option>
							  <option value="1" <?=(isset($attribute) && $attribute->requrire==1) ? 'selected="selected"' : '' ?>>Có</option>
                           </select>
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Không trùng</label>
                        <div class="col-sm-9">
                           <div class="relative">
                               <select class="form-control m-b" name="unique">                              
                              <option value="0" <?=(isset($attribute) && $attribute->unique==0) ? 'selected="selected"' : '' ?>>Không</option>
							  <option value="1" <?=(isset($attribute) && $attribute->unique==1) ? 'selected="selected"' : '' ?>>Có</option>
                           </select>
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" rows="1" required="" placeholder="code"  name="code" id="code" data-error="Nhập unique" value="<?=(isset($attribute)) ? $attribute->code : ''?>">
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Loại</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" rows="1" required="" placeholder="Loại"  name="type" id="type" data-error="Nhập unique" value="<?=(isset($attribute)) ? $attribute->type : ''?>">
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                          <?=$this->randtoken('tokenattribute'); ?>
                            <a class="btn btn-white" type="text" href="<?=base_url('attribute');?>">Đóng</a>
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