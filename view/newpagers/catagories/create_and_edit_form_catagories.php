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
                    <input type="hidden" name="id_user" id="id_user" value="<?=(isset($catagories)) ? $catagories->id : ''?>">
                    <div class="form-group"><label class="col-sm-2 control-label">Tên danh mục</label>
                        <div class="col-sm-9">
                           <input type="text" required="" placeholder="Name" <?=$this->uri == 'edit'?'disabled':'' ?> onchange="stralias('username','alias')" class="form-control area-input" name="username" id="username"  data-error="Nhập tên danh mục" data-error-1="Tên danh mục đã tồn tại!" data-url="<?=base_url('catagories/api_check_catagories')?>" value="<?=(isset($catagories)) ? $catagories->name : ''?>">
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Alias</label>
                        <div class="col-sm-9">
                           <input type="text" required="" placeholder="alias" class="form-control area-input" 
                           name="alias" id="alias" data-error="Nhập alias" data-error-1="Alias đã tồn tại!" data-url="<?=base_url('catagories/api_check_alias')?>" value="<?=(isset($catagories)) ? $catagories->alias : ''?>">
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Tiêu đề</label>
						<div class="col-sm-9">
							<div class="relative">
								<input type="text" class="form-control area-input" rows="1" required="" placeholder="Title"  name="title" id="title" value="<?=(isset($catagories)) ? $catagories->title : ''?>">
							</div>
						</div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Mô tả</label>
                        <div class="col-sm-9">
                           <textarea type="text" required=""  placeholder="Description" 
						   class="form-control area-input" name="description" id="description"> <?=(isset($catagories)) ? $catagories->description : ''?></textarea>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Metakey</label>
                        <div class="col-sm-9">
                           <input type="text" required="" placeholder="metakey" class="form-control area-input" 
						   name="metakey" id="metakey" value="<?=(isset($catagories)) ? $catagories->metakey : ''?>">
                        </div>
                     </div>
					 <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Metadesc</label>
                        <div class="col-sm-9">
                           <input type="text" required="" placeholder="metadesc" class="form-control area-input" 
						   name="metadesc" id="metadesc" value="<?=(isset($catagories)) ? $catagories->metadesc : ''?>">
                        </div>
                     </div>
					 <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Hình ảnh</label>
                        <div class="col-sm-9">
                           <img src="<?=(isset($catagories)) ? $catagories->image : base_url('layout/images/no-image.png')?>" height="100px" width="100px">
                           <input type="hidden" name="image" value="<?=(isset($catagories)) ? $catagories->image : ''?>"  id="image" />
                            <button class="btn btn-info" type="button" onclick="openPopup('image')">Changes</button>
                            <?php echo $this->size_image ?>                    
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Hình ảnh chia sẽ</label>
                        <div class="col-sm-9">
                           <img src="<?=(isset($catagories)) ? $catagories->imgshare : base_url('layout/images/no-image.png')?>" height="100px" width="100px">                  
                           <input type="hidden" name="imgshare" value="<?=(isset($catagories)) ? $catagories->imgshare : ''?>"  id="imgshare" />
                           <button class="btn btn-info" type="button" onclick="openPopup('imgshare')">Changes</button>
                           <?php echo $this->size_imgshare ?>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Danh mục</label>
                        <div class="col-sm-4">
                           <select class="form-control m-b" name="parent_id">
                                <option value="0">Danh mục cha</option>
                              <?php foreach ($list_catagories as $v) { ?>
                                <option value="<?php echo $v->parent_id ?>" <?=(isset($catagories) && $catagories->parent_id==$v->parent_id) ? 'selected="selected"' : '' ?>><?php echo $v->name ?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                          <?=$this->randtoken('tokencatagories'); ?>
                            <a class="btn btn-white" type="text" href="<?=base_url('catagories');?>">Đóng</a>
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