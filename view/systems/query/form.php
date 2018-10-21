<div class="wrap">
   <div class="section-dashboard">
      <form class="m-t" role="form" action="" method="post" id="form-users">
      <div class="tab-head">
         <span class="title"> <i class="fa fa-users text-info" aria-hidden="true" style="color:#3b5998"></i> Query SQL</span>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">					
         <textarea id="sql"  rows="10" class="form-control" name="sql" required="" placeholder="Input MySQL"><?php echo @$_POST['sql'] ?></textarea>				
      </div>
      <button type="submit" class="btn btn-primary" id="start">Run</button>
      <a href="<?=base_url('home');?>" class="btn btn-warning" onclick="">Cancel</a>
      <?php if(@$this->data['list']){ ?>
      <div class="table-responsive mt15">
         <br>
         <div class="alert alert-success">Result: <?php echo number_format(count($this->data['list'])) ?> row</div>
         <table class="table table-bordered table table-striped">
            <tbody>
               <tr>
                  <th>No.</th>
                  <?php  
                     $col = get_object_vars($list[0]);
                     foreach($col as $k=>$v){ 
                     	echo '<th>'.$k.'</th>';
                     } ?>
               </tr>
               <?php 
                  foreach($this->data['list'] as $i=>$user){
                  ?>
               <tr >
                  <td><?php echo $i+1 ?></td>
                  <?php 
                     $col = get_object_vars($user);
                     foreach($col as $k=>$v){ 
                     	echo '<td>'.$v.'</td>';
                     } 
                     ?>
               </tr>
               <?php } ?>
            </tbody>
         </table>
         <div class="box-footer clearfix">		        	 
         </div>
      </div>
      <?php } ?>
      </form>
   </div>
</div>