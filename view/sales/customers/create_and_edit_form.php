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
                    <input type="hidden" name="id_user" id="id_user" value="<?=(isset($customers)) ? $customers->id : ''?>">
                     <div class="form-group"><label class="col-sm-2 control-label">Họ & Tên</label>
                        <div class="col-sm-9">
                           <input type="text" required="" placeholder="Full Name" class="form-control" name="fullname" value="<?=(isset($customers)) ? $customers->fullname : ''?>"">
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Tên tài khoản</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" <?=$this->uri == 'edit'?'disabled':'' ?> class="form-control area-input" rows="1" required="" placeholder="User Name"  name="username" id="username" data-error="Nhập tên tài khoản" data-error-1="Tài khoản đã tồn tại!" data-url="<?=base_url('customers/api_check_username')?>" value="<?=(isset($customers)) ? $customers->name : ''?>">
                           </div>
                           <div class="block red mt5 font12"><b>Lưu ý:</b> Tên tài khoản phải không có dấu và khoảng trống</div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Mật khẩu</label>
                        <div class="col-sm-9">
                           <input type="password" <?=$this->uri == 'create'?'required="" data-error="nhập mật khẩu" id="password" name="password" ':' id="edpassword" name="edpassword" ' ?> placeholder="*******" class="form-control area-input" >
                        </div>
                     </div>
                     <div class="form-group"><label class="col-sm-2 control-label">Nhập lại mật khẩu</label>
                        <div class="col-sm-9">
                           <input type="password" <?=$this->uri == 'create'?'required="" data-error="nhập lại mật khẩu" id="re_password" name="re_password" ':' id="edre_password" name="edre_password" ' ?> placeholder="*******" class="form-control area-input"  >
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-9">
                           <input type="email" required="" <?=$this->uri == 'edit'?'disabled':'' ?> placeholder="Email" data-error="Nhập email" data-error-1="Email đã tồn tại" 
						   data-url="<?=base_url('customers/api_check_email')?>" class="form-control" id="email" name="email" value="<?=(isset($customers)) ? $customers->email : ''?>">
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Địa chỉ</label>
                        <div class="col-sm-9">
                           <input type="address" required="" placeholder="Địa chỉ" data-error="Nhập địa chỉ" class="form-control" id="address" name="address" value="<?=(isset($customers)) ? $customers->address : ''?>">
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Ảnh đại diện</label>
                        <div class="col-sm-9">
                           <img src="<?=(isset($customers)) ? $customers->image : base_url('layout/images/no-image.png')?>" height="100px" width="100px">                  
                           <input type="hidden" name="image" value="<?=(isset($customers)) ? $customers->image : ''?>"  id="image" />
                           <button class="btn btn-info" type="button" onclick="openPopup('image')">Changes</button>
                           <?php echo $this->size_image ?>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Nhóm tài khoản</label>
                        <div class="col-sm-4">
                           <select class="form-control m-b" name="groupid">
                              <?php foreach ($this->data['list_group'] as $v) { ?>
                                 <option value="<?php echo $v->group_id ?>" <?=(isset($customers) && $customers->group_id==$v->group_id) ? 'selected="selected"' : '' ?>><?php echo $v->fullname ?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Trạng thái</label>
                        <div class="col-sm-4">
                           <select class="form-control m-b" name="status">
                              <option value="1" <?=(isset($customers) && $customers->status==1) ? 'selected="selected"' : '' ?>>Enable</option>
                              <option value="2" <?=(isset($customers) && $customers->status==2) ? 'selected="selected"' : '' ?>>Disable</option>
                           </select>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                          <?=$this->randtoken('tokencustomers'); ?>
                            <a class="btn btn-white" type="text" href="<?=base_url('customers');?>">Đóng</a>
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