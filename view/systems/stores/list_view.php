<?php defined('BASE') OR exit('Access Deny');?>
<div class="row">
   <div class="col-lg-12">
      <div class="ibox float-e-margins">
         <div class="ibox-title">
            <h5>Basic Data Tables example with responsive plugin</h5>
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
                     <form method="get" action="<?=base_url('stores'); ?>" id="form-search">
                        <div class="form-group">
                            <input name="key" type="text" required="" class="form-control" placeholder="Input Filter">
                            <button class="btn btn-primary" style="margin-bottom: 0px;" type="submit">Search</button>
                            <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('stores/create'); ?>">Add New</a>
                        </div>            
                     </form>
                  </div>
                  <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 25 of 57 entries</div>
                  <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                     <thead>
                        <tr role="row">
                           <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 75px;">ID</th>
                     <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Full Name: activate to sort column ascending" style="width: 218px;">Mã cửa hàng</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Full Name: activate to sort column ascending" style="width: 218px;">Tên cửa hàng</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="User Name: activate to sort column ascending" style="width: 196px;">Số điện thoại</th>
                     <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="User Name: activate to sort column ascending" style="width: 196px;">Địa chỉ</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 218px;">Trạng thái</th>
                     <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 218px;">Hành động</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if($stores ) {foreach ($stores as $v) { ?>
                           <tr class="gradeA odd" role="row">
                              <td class="sorting_1"><?php echo $v->id ?></td>
                              <td><?php echo $v->store_id ?></td>
                              <td><?php echo $v->name ?></td>
                              <td><?php echo $v->cellularphone ?></td>
                              <td><?php echo $v->address ?> , <?php echo $v->district ?> , <?php echo $v->city ?></td>
                              <td class="center w100 a-hide">
                                 <span class="glyphicon glyphicon-ok-circle iconfa-show hide1<?=$v->id?> <?php if($v->status==2) echo 'hide'; ?>" data-id="<?=$v->id?>" data-hide="2" data-url="<?=base_url('stores/hide')?>"></span>
                                    <span class="glyphicon glyphicon-remove-circle iconfa-hide hide0<?=$v->id?> <?php if($v->status==1) echo 'hide'; ?>" data-id="<?=$v->id?>" data-hide="1" data-url="<?=base_url('stores/hide')?>"></span>
                              </td>
                              <td class="center">
                                 <a href="<?=base_url('stores/edit/'.$v->id); ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                                 <a class="delete-confirm" href="<?=base_url('stores/hide/'.$v->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
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