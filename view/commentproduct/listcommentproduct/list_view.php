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
               <div><a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('commentproduct/create'); ?>">Add New</a>
                  <table class="table table-striped table-bordered table-hover ">
                     <thead>
                        <tr role="row">
                     <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 75px;">ID</th>
                     <th  style="width: 218px;">Content</th>
                     <th style="width: 218px;">ID Post</th>
                     <th  style="width: 196px;">ID User</th>
                     <th  style="width: 196px;">ID Content</th>
                     <th  style="width: 218px;">State</th>
                     <th style="width: 218px;">created</th>      
                     <th style="width: 218px;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if($commentproduct ) {foreach ($commentproduct as $v) { ?>
                           <tr class="gradeA odd" role="row">
                              <td class="sorting_1"><?php echo $v->id ?></td>
                              <td><?php echo $v->label ?></td>
                              <td><?php echo $v->defaultvalue ?></td>
                              <td><?php echo $v->requrire==1?'Có':'Không' ?></td>
                              <td><?php echo $v->unique==1?'Có':'Không' ?></td>
                              <td><?php echo $v->code ?></td>
                              <td><?php echo $v->type ?></td>
                              <td class="center">
                                 <a href="<?=base_url('commentproduct/edit/'.$v->id); ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                                 <a class="delete-confirm" href="<?=base_url('commentproduct/delete/'.$v->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
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