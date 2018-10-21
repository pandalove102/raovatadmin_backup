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
                    <input type="hidden" name="id_user" id="id_user" value="<?=(isset($group)) ? $group->id : ''?>">
                     <div class="form-group"><label class="col-sm-2 control-label">Mã nhóm</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" <?=$this->uri == 'edit'?'disabled':'' ?> rows="1" required="" placeholder="Mã nhóm"  name="group_id" id="group_id" data-error="Nhập mã nhóm" data-error-1="Mã nhóm đã tồn tại!" data-url="<?=base_url('group/api_check_groupid')?>" value="<?=(isset($group)) ? $group->group_id : ''?>">
                           </div>
                           <div class="block red mt5 font12"><b>Lưu ý:</b> Tên group phải không có dấu và khoảng trống</div>
                        </div>
                     </div>
                    <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Tên nhóm</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" rows="1" required="" placeholder="tên nhóm"  name="fullname" id="fullname" data-error="Nhập tên nhóm" value="<?=(isset($group)) ? $group->fullname : ''?>">
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Loại</label>
                        <div class="col-sm-9">
                            <select class="form-control m-b" id="type" name="type">
                                <option value="system">Hệ thống</option>
                                <option value="vip">Khách hàng vip</option>
                                <option value="normal">Khách hàng thường</option>
                                <option value="potential">Khách hàng tiềm năng</option>
                            </select>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                          <?=$this->randtoken('tokengroup'); ?>
                            <a class="btn btn-white" type="text" href="<?=base_url('group');?>">Đóng</a>
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