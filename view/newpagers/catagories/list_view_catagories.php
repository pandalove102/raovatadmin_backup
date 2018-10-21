<div class="row">
   <div class="col-lg-12">
      <div class="ibox float-e-margins">
      <div class="ibox float-e-margins">
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
                     <form method="get" action="<?=base_url('catagories'); ?>" id="form-search">
                        <div class="form-group">
                           <?=$this->randtoken('tokensearch'); ?>
                           <input name="key" type="text" class="form-control" value="<?=$this->get('key') ?>" placeholder="Tên trạng thái">
                           <button class="btn btn-primary" style="margin-bottom: 0px;" type="submit">Tìm Kiếm</button>
                           <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('catagories/create'); ?>">Thêm mới</a>
                        </div>            
                     </form>
                  </div>
                  <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 25 of 57 entries</div>
                  <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                     <thead>
                        <tr role="row">
                           <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 75px;">ID</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 60px;">Image</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Full Name: activate to sort column ascending" style="width: 218px;">Name</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Full Name: activate to sort column ascending" style="width: 218px;">Title</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Login Time: activate to sort column ascending" style="width: 105px;">User Name</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Login Time: activate to sort column ascending" style="width: 50px;">Status</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Login Time: activate to sort column ascending" style="width: 50px;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if(isset($catagories) && $catagories) {foreach ($catagories as $v) { ?>
                           <tr class="gradeA odd" role="row">
                              <td class="sorting_1"><?php echo $v->id ?></td>
                              <td class="center"><img src="<?=(isset($v->image)) ? $v->image : base_url('layout/images/no-image.png')?>" height="50px" width="50px"></td>
                              <td><?php echo $v->name ?></td>
                              <td><?php echo $v->title ?></td>
                              <td class="center"><?php echo $v->username ?></td>
                              <td class="center w100 a-hide">
                                 <span class="glyphicon glyphicon-ok-circle iconfa-show hide2<?=$v->id?> <?php if($v->status==2) echo 'hide'; ?>" data-id="<?=$v->id?>" data-hide="2" data-url="<?=base_url('catagories/hide')?>"></span>
                                 <span class="glyphicon glyphicon-remove-circle iconfa-hide hide1<?=$v->id?> <?php if($v->status==1) echo 'hide'; ?>" data-id="<?=$v->id?>" data-hide="1" data-url="<?=base_url('catagories/hide')?>"></span>
                              </td>
                              <td class="center">
                                 <a href="<?=base_url('catagories/edit/'.$v->id); ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                                 <a class="delete-confirm" href="<?=base_url('catagories/delete/'.$v->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
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