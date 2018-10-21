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
                <form class="m-t" role="form" action="" method="post" id="form-users">
                    <input type="hidden" name="uri" id="uri" value="<?php echo $this->uri ?>">
                    <input type="hidden" name="id_user" id="id_user" value="<?=(isset($catagory)) ? $catagory->id : ''?>">
                    <div class="form-group"><label class="col-sm-2 control-label">Tên danh mục</label>
                        <div class="col-sm-9">
                           <input type="text" required="" placeholder="Name" onchange="stralias('name','alias')" class="form-control area-input" name="name" id="name"  data-error="Nhập tên danh mục" value="<?=(isset($catagory)) ? $catagory->name : ''?>">
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Alias</label>
                        <div class="col-sm-9">
                           <input type="text" required="" placeholder="alias" class="form-control area-input" 
                           name="alias" id="alias" data-error="Nhập alias" data-error-1="Alias đã tồn tại!" data-url="<?=base_url('catagory/api_check_alias')?>" value="<?=(isset($catagory)) ? $catagory->alias : ''?>">
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Tiêu đề</label>
						<div class="col-sm-9">
							<div class="relative">
								<input type="text" class="form-control area-input" rows="1" required="" placeholder="Title"  name="title" id="title" value="<?=(isset($catagory)) ? $catagory->title : ''?>">
							</div>
						</div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Mô tả</label>
                        <div class="col-sm-9">
                           <textarea type="text" required=""  placeholder="Description" 
						   class="form-control area-input" name="description" id="description"> <?=(isset($catagory)) ? $catagory->description : ''?></textarea>
                        </div>
                     </div>
                     <div class="hr-line-dashed hidden"></div>
                     <div class="form-group hidden"><label class="col-sm-2 control-label">Metakey</label>
                        <div class="col-sm-9">
                           <input type="text"  placeholder="metakey" class="form-control area-input" 
						   name="metakey" id="metakey" value="<?=(isset($catagory)) ? $catagory->metakey : ''?>">
                        </div>
                     </div>
					 <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Metadesc</label>
                        <div class="col-sm-9">
                           <input type="text" required="" placeholder="metadesc" class="form-control area-input" 
						   name="metadesc" id="metadesc" value="<?=(isset($catagory)) ? $catagory->metadesc : ''?>">
                        </div>
                     </div>
					 <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Hình ảnh</label>
                        <div class="col-sm-9">
                           <img src="<?=(isset($catagory)) &&  $catagory->image ? $catagory->image : base_url('layout/images/no-image.png')?>" height="100px" width="100px">
                           <input type="hidden" name="image" value="<?=(isset($catagory)) ? $catagory->image : ''?>"  id="image" />
                            <button class="btn btn-info" type="button" onclick="openPopup('image')">Changes</button>
                            <?php echo $this->size_image ?>                    
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Hình ảnh chia sẽ</label>
                        <div class="col-sm-9">
                           <img src="<?=(isset($catagory)) && $catagory->imgshare ? $catagory->imgshare : base_url('layout/images/no-image.png')?>" height="100px" width="100px">                  
                           <input type="hidden" name="imgshare" value="<?=(isset($catagory)) ? $catagory->imgshare : ''?>"  id="imgshare" />
                           <button class="btn btn-info" type="button" onclick="openPopup('imgshare')">Changes</button>
                           <?php echo $this->size_imgshare ?>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Danh mục</label>
                        <div class="col-sm-4">
                            <?=$this->api_listcatnice('parent_id',@$catagory->parent_id)?>
                        </div>
                     </div>
					  <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Thứ tự</label>
                        <div class="col-sm-9">
                           <input type="text" required="" placeholder="Thứ tự hiển thị" class="form-control area-input" 
						   name="pos" id="thutu" value="<?=(isset($catagory)) ? $catagory->pos : '1'?>">
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                          <?=$this->randtoken('tokencatagory'); ?>
                            <a class="btn btn-white" type="text" href="<?=base_url('catagory');?>">Đóng</a>
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
<script type="text/javascript">CKEDITOR.replace('description');</script>