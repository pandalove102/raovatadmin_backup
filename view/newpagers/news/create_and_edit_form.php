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
                  <input type="hidden" name="id_user" id="id_user" value="<?=(isset($news)) ? $news->id : ''?>">
                  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                    <div class="col-sm-9 col-sm-offset-8">
                        <a class="btn btn-white" type="text" href="<?=base_url('news');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit" name="save" value="1"><?php echo $this->save ?></button>
                        <button class="btn btn-primary" type="submit" name="save" value="2"><?php echo $this->save_close ?></button>
                    </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="tabs-container">
                           <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#tab-1"> Thông tin bài viết</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-2"> Hình slider</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-3"> SEO</a></li>
                           </ul>
                           <div class="tab-content">
                              <div id="tab-1" class="tab-pane active">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Tên bài viết:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="Name" onchange="stralias('username','alias')" class="form-control area-input" name="username" id="username"  data-error="Nhập tên sản phẩm" data-error-1="Tên sản phẩm đã tồn tại!" data-url="<?=base_url('news/api_check_news')?>" value="<?=(isset($news)) ? $news->name : ''?>"></div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Alias</label>
                                          <div class="col-sm-10">
                                             <input type="text" required="" placeholder="alias" class="form-control area-input" 
                                                name="alias" id="alias" data-error="Nhập alias" data-error-1="Alias đã tồn tại!" data-url="<?=base_url('news/api_check_alias')?>" value="<?=(isset($news)) ? $news->alias : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Mô tả ngắn:</label>
                                          <div class="col-sm-10">
                                             <textarea type="text" required=""  placeholder="Description" class="form-control area-input" name="shortdescription" id="shortdescription"> <?=(isset($news)) ? $news->shortdescription : ''?></textarea>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Nội dung chi tiết:</label>
                                          <div class="col-sm-10">
                                             <textarea type="text" required=""  placeholder="Description" class="form-control area-input" name="description" id="description"> <?=(isset($news)) ? $news->description : ''?></textarea>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Hình ảnh</label>
                                          <div class="col-sm-9">
                                             <img src="<?=(isset($news)) ? $news->image : base_url('layout/images/no-image.png')?>" height="100px" width="100px">
                                             <input type="hidden" name="image" value="<?=(isset($news)) ? $news->image : ''?>"  id="image" />
                                              <button class="btn btn-info" type="button" onclick="openPopup('image')">Thêm</button>
                                              <?php echo $this->size_image ?>                    
                                          </div>
                                       </div>
									    <div class="form-group">
                                          <label class="col-sm-2 control-label">Danh mục sản phẩm (chọn nhiều):</label>
                                          <div class="col-sm-10">
                                             <?=$catcontrl->api_listcatnicemulti('catshow',@$news->catshow)?>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Danh mục:</label>
                                          <div class="col-sm-10">
                                             <select class="form-control m-b" id="catagorie_id" name="catagorie_id">
                                                <option value="0">Chọn danh mục</option>
                                                <?php foreach ($list_catagory as $v) { ?>
                                                <option value="<?php echo $v->id ?>" <?=(isset($news) && $news->catagories_id==$v->id) ? 'selected="selected"' : '' ?>><?php echo $v->name ?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Trạng thái:</label>
                                          <div class="col-sm-10">
                                             <select class="form-control m-b" name="status">
                                                <option value="1" <?=(isset($news) && $news->status==1) ? 'selected="selected"' : '' ?>>Hiện</option>
                                                <option value="2" <?=(isset($news) && $news->status==2) ? 'selected="selected"' : '' ?>>Ẩn</option>
                                             </select>
                                          </div>
                                       </div>
                                    </fieldset>
                                 </div>
                              </div>
                              <div id="tab-2" class="tab-pane">
                                 <div class="panel-body">
                                    <div class="table-responsive">
                                       <table class="table table-bordered table-stripped">
                                          <thead>
                                             <tr>
                                                <th>
                                                   Hình ảnh
                                                </th>
                                                <th>
                                                   Đường dẫn
                                                </th>
                                                <th>
                                                   Thứ tự
                                                </th>
                                                <th>
                                                   Hành động
                                                </th>
                                             </tr>
                                          </thead>
                                          <tbody id="listimg">
                                             <?php  if(isset($news->images) && $news->images){
                                                $listimgs = json_decode($news->images);
                                              foreach ( $listimgs  as $k => $img) { 
                                                $idim = str_replace('.', '_',str_replace('/', '_',str_replace('://', '_', $img->img)));
                                                ?>
                                                   <tr id="img_<?=$idim?>">
                                                      <td> <img width="100" src="<?=$img->img?>"></td>
                                                      <td><input type="hidden" name="imgs[]" class="form-control" value="<?=$img->img?>">
													  <input type="text" name="links[]" class="form-control" value="<?=$img->link?>"></td>
                                                      <td>   <input type="text" name="pos[]" class="form-control" value="<?=$img->pos?>"></td>
                                                      <td>   <button type="button" data-id="<?=$idim?>" class="btn btndelimg btn-white"><i class="fa fa-trash"></i> </button></td>
                                                   </tr>                                    
                                             <?php                                            
                                             }
                                          } ?>
                                          </tbody>
                                       </table>
                                       <a class="btn btn-success" id="hdfinder" onclick="openhd('imgs')">Thêm hình ảnh</a>
                                       <input type="hidden" id="imgs" class="form-control"  value="">
                                    </div>
                                 </div>
                              </div>
                              <div id="tab-3" class="tab-pane">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Hình ảnh chia sẽ</label>
                                          <div class="col-sm-9">
                                             <img src="<?=(isset($news)) ? $news->imgshare : base_url('layout/images/no-image.png')?>" height="100px" width="100px">                  
                                             <input type="hidden" name="imgshare" value="<?=(isset($news)) ? $news->imgshare : ''?>"  id="imgshare" />
                                             <button class="btn btn-info" type="button" onclick="openPopup('imgshare')">Changes</button>
                                             <?php echo $this->size_imgshare ?>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">H1:</label>
                                          <div class="col-sm-10">
                                            <input type="text" placeholder="H1" class="form-control area-input" 
                                             name="h1" id="h1" value="<?=(isset($news)) ? $news->h1 : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Meta Tag Title:</label>
                                          <div class="col-sm-10">
                                            <input type="text" placeholder="metatitle" class="form-control area-input" 
                                             name="metatitle" id="metatitle" value="<?=(isset($news)) ? $news->metatitle : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Meta Tag Description:</label>
                                          <div class="col-sm-10">
                                            <input type="text"  placeholder="metadesc" class="form-control area-input" 
                                             name="metadesc" id="metadesc" value="<?=(isset($news)) ? $news->metadesc : ''?>">
                                         </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Meta Tag Keywords:</label>
                                          <div class="col-sm-10">
                                            <input type="text" placeholder="metakey" class="form-control area-input" 
                                             name="metakey" id="metakey" value="<?=(isset($news)) ? $news->metakey : ''?>">
                                         </div>
                                       </div>
                                    </fieldset>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?=$this->randtoken('tokennews'); ?>
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
        $('#imgs').change(function(){
            var hinhchon = $(this).val();
            var imgs = hinhchon.split(',');
            $.each(imgs,function(i,img){
                var id = img.replace(/\//g,'_').replace(/\./g,'_').replace(/:/g,'_');
                $('#listimg').append('<tr id="img_'+id+'">'+
                '<td>'+
                   ' <img width="100" src="'+img+'">'+
                '</td>'+
                '<td>'+
                '<input type="hidden" name="imgs[]" class="form-control"  value="'+img+'"><input type="text" name="links[]" class="form-control"  value="">'+
                '</td>'+
                '<td>'+
                 '   <input type="text" name="pos[]" class="form-control" value="'+(i+1)+'">'+
                '</td>'+
                '<td>'+
                 '   <button type="button" data-id="'+id+'" class="btn btndelimg btn-white"><i class="fa fa-trash"></i> </button>'+
                '</td>'+
                '</tr>');
            });
        });
         $(document).on('click','.btndelimg',function(){  
            var that = $(this);
            //muon tao hieu ung
            that.loading();
            setTimeout(function(){                     
                $('#img_'+that.data('id')).remove();
            },2000);
        });
      });
</script>