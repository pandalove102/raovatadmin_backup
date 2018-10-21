<?php defined('BASE') OR exit('No direct script access allowed');?>
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
               <form class="m-t" role="form" action="" method="post" >
                  <input type="hidden" name="uri" id="uri" value="<?php echo $this->uri ?>">
                  <input type="hidden" name="id_user" id="id_user" value="<?=(isset($slider)) ? $slider->id : ''?>">
                  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                    <div class="col-sm-9 col-sm-offset-8">
                        <a class="btn btn-white" type="text" href="<?=base_url('slider');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit" name="save" value="1"><?php echo $this->save ?></button>
                        <button class="btn btn-primary" type="submit" name="save" value="2"><?php echo $this->save_close ?></button>
                    </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="tabs-container">
                           <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#tab-1"> Thông tin hình ảnh</a></li>                         
                           </ul>
                           <div class="tab-content">
                              <div id="tab-1" class="tab-pane active">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Tên:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="Name" class="form-control area-input" name="name"  value="<?=(isset($slider)) ? $slider->name : ''?>"></div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Link</label>
                                          <div class="col-sm-10">
                                             <input type="text" required="" placeholder="link" class="form-control area-input" 
                                                name="link"  value="<?=(isset($slider)) ? $slider->link : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Mô tả ngắn:</label>
                                          <div class="col-sm-10">
                                             <textarea type="text" required=""  placeholder="Content" class="form-control area-input" name="content" id="description"> <?=(isset($slider)) ? $slider->content : ''?></textarea>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Hình ảnh</label>
                                          <div class="col-sm-9">
                                             <img src="<?=(isset($slider)) ? $slider->image : base_url('layout/images/no-image.png')?>" height="100px" width="100px">
                                             <input type="hidden" name="image" value="<?=(isset($slider)) ? $slider->image : ''?>"  id="image" />
                                              <button class="btn btn-info" type="button" onclick="openPopup('image')">Thêm</button>
                                              <?php echo $this->size_image ?>                    
                                          </div>
                                       </div>                                       
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Trạng thái:</label>
                                          <div class="col-sm-10">
                                             <select class="form-control m-b" name="status">
                                                <option value="1" <?=(isset($slider) && $slider->status==1) ? 'selected="selected"' : '' ?>>Hiện</option>
                                                <option value="2" <?=(isset($slider) && $slider->status==2) ? 'selected="selected"' : '' ?>>Ẩn</option>
                                             </select>
                                          </div>
                                       </div>
                                    </fieldset>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?=$this->randtoken('tokenslider'); ?>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">CKEDITOR.replace('description');</script>
<script>    
    $(document).ready(function(){
       
      });
</script>