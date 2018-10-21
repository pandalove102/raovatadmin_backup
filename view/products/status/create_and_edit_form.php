<?php defined('BASE') OR exit('Access Deny');?>
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
            <div class="ibox-content">
               <div class="form-horizontal">
                <form class="m-t" role="form" action="" method="post" id="form-users">
                    <input type="hidden" name="uri" id="uri" value="<?php echo $this->uri ?>">
                    <input type="hidden" name="id_user" id="id_user" value="<?=(isset($status)) ? $status->id : ''?>">
                     <div class="form-group"><label class="col-sm-2 control-label">Tên trạng thái</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" <?=$this->uri == 'edit'?'disabled':'' ?> rows="1" required="" placeholder="Tên trạng thái"  name="username" id="username" data-error="Nhập Tên trạng thái" data-error-1="Tên trạng thái đã tồn tại!" data-url="<?=base_url('status/api_check_name')?>" value="<?=(isset($status)) ? $status->name : ''?>">
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Trạng thái</label>
                        <div class="col-sm-9">
                            <select class="form-control m-b" id="status" name="status">
                                <option value="1" <?=(isset($status) && $status->status==1) ? 'selected="selected"' : '' ?>>Hiện</option>
                                <option value="2" <?=(isset($status) && $status->status==2) ? 'selected="selected"' : '' ?>>Ẩn</option>
                            </select>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                          <?=$this->randtoken('tokenstatus'); ?>
                            <a class="btn btn-white" type="text" href="<?=base_url('status');?>">Đóng</a>
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