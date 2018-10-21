<div class="row">
   <div class="col-lg-12">
      <div class="ibox float-e-margins">
         <form class="m-t" role="form" action="" method="get" id="form-users">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                  <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="user">Tên tài khoản</label>
                            <input type="text" id="users" name="users" value="<?=$this->get('users') ?>" placeholder="Tên tài khoản" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="email">Email</label>
                            <input type="email" id="emails" name="emails" value="<?=$this->get('emails') ?>" placeholder="Email" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="group">Nhóm</label>
                            <select name="groups" id="groups" class="form-control">
                                <option value="" >Danh sách</option>
                                <?php if($list_group) {foreach ($list_group as $v) { ?>
                                  <option <?php echo $this->get('groups') == $v->group_id? 'selected':'' ?> value="<?php echo $v->group_id?>"><?php echo $v->fullname?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="statuss">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                                <option value="" >Trạng Thái</option>
                                <option value="1" <?php echo $this->get('status') ==1? 'selected':'' ?>>Mở</option>
                                <option value="2" <?php echo $this->get('status') ==2? 'selected':'' ?>>Khóa</option>
                            </select>
                        </div>
                    </div>
                    <?=$this->randtoken('tokensearch'); ?>
                    <div class="col-sm-1" style="margin-top: 2%;margin-left: 56%;">
                      <div class="form-group">
                        <button class="btn btn-primary" type="submit">Tìm Kiếm</button>
                      </div>
                    </div>
                </div>
            </div>
          </form>
         <div class="ibox-content">
            <div class="table-responsive">
               <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  <div class="dataTables_length" id="DataTables_Table_0_length">
                     <label>
                        Show 
                        <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-control input-sm">
                           <option value="10">10</option>
                           <option value="25">25</option>
                           <option value="50">50</option>
                           <option value="100">100</option>
                        </select>
                        entries
                     </label>
                  </div>
                  <div id="DataTables_Table_0_filter" class="dataTables_filter">
                     <form method="get" action="<?=base_url('customers'); ?>" id="form-search">
                        <div class="form-group">
                           <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('customers/create'); ?>">Add New</a>
                        </div>            
                     </form>
                  </div>
                  <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 25 of 57 entries</div>
                  <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                     <thead>
                        <tr role="row">
                           <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 75px;">ID</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Full Name: activate to sort column ascending" style="width: 218px;">Full Name</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="User Name: activate to sort column ascending" style="width: 196px;">User Name</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 218px;">Email</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Login Time: activate to sort column ascending" style="width: 105px;">Login Time</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Login Time: activate to sort column ascending" style="width: 105px;">Group</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Login Time: activate to sort column ascending" style="width: 50px;">Status</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Login Time: activate to sort column ascending" style="width: 50px;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if($customers){foreach($customers as $v) { ?>
                           <tr class="gradeA odd" role="row">
                              <td class="sorting_1"><?php echo $v->id ?></td>
                              <td><?php echo $v->fullname ?></td>
                              <td><?php echo $v->name ?></td>
                              <td class="center"><?php echo $v->email ?></td>
                              <td class="center"><?php echo $v->last_login_time ?></td>
                              <td class="center" style="text-align: center;">
                                 <?php foreach ($list_group as $lg) { 
                                    if($v->group_id != $lg->group_id) continue; echo $lg->fullname; } ?>
                                    
                              </td>
                              <td class="center w100 a-hide" style="text-align: center;">
                                 <span class="glyphicon glyphicon-ok-circle iconfa-show hide2<?=$v->id?> <?php if($v->status==2) echo 'hide'; ?>" data-id="<?=$v->id?>" data-hide="2" data-url="<?=base_url('customers/hide')?>"></span>
                                 <span class="glyphicon glyphicon-remove-circle iconfa-hide hide1<?=$v->id?> <?php if($v->status==1) echo 'hide'; ?>" data-id="<?=$v->id?>" data-hide="1" data-url="<?=base_url('customers/hide')?>"></span>
                              </td>
                              <td class="center" style="text-align: center;">
                                 <a href="<?=base_url('customers/edit/'.$v->id); ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                                 <a class="delete-confirm" href="<?=base_url('customers/delete/'.$v->id); ?>" ><span class="glyphicon glyphicon-trash"></span></a>
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