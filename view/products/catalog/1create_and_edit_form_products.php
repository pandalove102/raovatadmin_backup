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
                  <input type="hidden" name="id_user" id="id_user" value="<?=(isset($catalogs)) ? $catalogs->id : ''?>">
                  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                    <div class="col-sm-9 col-sm-offset-8">
                        <a class="btn btn-white" type="text" href="<?=base_url('catalog');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit" name="save" value="1"><?php echo $this->save ?></button>
                        <button class="btn btn-primary" type="submit" name="save" value="2"><?php echo $this->save_close ?></button>
                    </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="tabs-container">
                           <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#tab-1"> Thông tin sản phẩm</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-2"> Thông tin khác</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-3"> Giảm giá</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-4"> Hình ảnh</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-5"> SEO</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-6"> Khuyến mãi</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-7"> Thuộc tính khác</a></li>
                           </ul>
                           <div class="tab-content">
                              <div id="tab-1" class="tab-pane active">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Sku:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="Sku" class="form-control area-input" name="sku" id="sku"  data-error="Nhập Sku" data-error-1="Mã sku đã tồn tại!" data-url="<?=base_url('catalog/api_check_sku')?>" value="<?=(isset($catalogs)) ? $catalogs->sku : ''?>"></div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Tên sản phẩm:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="Name" onchange="stralias('username','alias')" class="form-control area-input" name="username" id="username"  data-error="Nhập tên sản phẩm" data-error-1="Tên sản phẩm đã tồn tại!" data-url="<?=base_url('catalog/api_check_catalogs')?>" value="<?=(isset($catalogs)) ? $catalogs->name : ''?>"></div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Alias</label>
                                          <div class="col-sm-10">
                                             <input type="text" required="" placeholder="alias" class="form-control area-input" 
                                                name="alias" id="alias" data-error="Nhập alias" data-error-1="Alias đã tồn tại!" data-url="<?=base_url('catalog/api_check_alias')?>" value="<?=(isset($catalogs)) ? $catalogs->alias : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Giá:</label>
                                          <div class="col-sm-10">
                                            <input type="number" onkeyup="validateInp(this);" required="" placeholder="price" class="form-control area-input" 
                                             name="price" id="price" value="<?=(isset($catalogs)) ? $catalogs->price : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Mô tả ngắn:</label>
                                          <div class="col-sm-10">
                                             <textarea type="text" required=""  placeholder="Description" class="form-control area-input" name="shortdescription" id="shortdescription"> <?=(isset($catalogs)) ? $catalogs->shortdescription : ''?></textarea>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Mô tả:</label>
                                          <div class="col-sm-10">
                                             <textarea type="text" required=""  placeholder="Description" class="form-control area-input" name="description" id="description"> <?=(isset($catalogs)) ? $catalogs->description : ''?></textarea>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Hình ảnh</label>
                                          <div class="col-sm-9">
                                             <img src="<?=(isset($catalogs)) ? $catalogs->image : base_url('layout/images/no-image.png')?>" height="100px" width="100px">
                                             <input type="hidden" name="image" value="<?=(isset($catalogs)) ? $catalogs->image : ''?>"  id="image" />
                                              <button class="btn btn-info" type="button" onclick="openPopup('image')">Thêm</button>
                                              <?php echo $this->size_image ?>                    
                                          </div>
                                       </div>
                                    </fieldset>
                                 </div>
                              </div>
                              <div id="tab-2" class="tab-pane">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                     
                                            <input type="hidden" 
                                             name="id" id="id" value="<?=(isset($catalogs)) ? $catalogs->id : ''?>">
                                        
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Thương hiệu:</label>
                                          <div class="col-sm-10">
                                             <input type="text" class="form-control" required="" name="brand" id="brand" placeholder="Thương hiệu" data-error="Nhập thương hiệu" value="<?=(isset($catalogs)) ? $catalogs->brand : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Danh mục:</label>
                                          <div class="col-sm-10">
                                              <?=$this->api_listcatnice('catagorie_id',@$catalogs->catagories_id)?>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Thuế</label>
                                          <div class="col-sm-10">
                                             <select class="form-control" id="tax" name="tax">
                                                <option value="5" <?=(isset($catalogs) && $catalogs->tax==5) ? 'selected="selected"' : '' ?>>5 %</option>
                                                <option value="10" <?=(isset($catalogs) && $catalogs->tax==10) ? 'selected="selected"' : '' ?>>10 %</option>
                                                <option value="15" <?=(isset($catalogs) && $catalogs->tax==15) ? 'selected="selected"' : '' ?>>15 %</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Số lượng:</label>
                                          <div class="col-sm-10">
                                            <input type="number" required="" placeholder="quantity" class="form-control area-input" 
                                             name="quantity" data-error="Nhập số lượng" onkeyup="validateInp(this);" id="quantity" value="<?=(isset($catalogs)) ? $catalogs->quantity : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Trạng thái:</label>
                                          <div class="col-sm-10">
                                             <select class="form-control m-b" name="status">
                                                <option value="1" <?=(isset($catalogs) && $catalogs->status==1) ? 'selected="selected"' : '' ?>>Hiện</option>
                                                <option value="2" <?=(isset($catalogs) && $catalogs->status==2) ? 'selected="selected"' : '' ?>>Ẩn</option>
                                                <option value="3" <?=(isset($catalogs) && $catalogs->status==3) ? 'selected="selected"' : '' ?>>Hết hàng</option>
                                             </select>
                                          </div>
                                       </div>
                                    </fieldset>
                                 </div>
                              </div>
                              <div id="tab-3" class="tab-pane">
                                 <div class="panel-body">
                                    <div class="table-responsive">
                                       <table class="table table-stripped table-bordered">
                                          <thead>
                                             <tr>
                                                <th>
                                                   Tên
                                                </th>
                                                <th>
                                                   Số lượng
                                                </th>
                                                <th>
                                                   Giá
                                                </th>
                                                <th style="width: 20%">
                                                   Ngày bắt đầu
                                                </th>
                                                <th style="width: 20%">
                                                   Ngày kết thúc
                                                </th>
                                              
                                                <th>
                                                   Hành động
                                                </th>
                                             </tr>
                                          </thead>
                                          <tbody id="listdis">
                                             <?php  $idd = 1; if(isset($listdis) && $listdis){ foreach ($listdis as $ds) { ?>
                                                <tr id="dis_<?=$ds->id?>">
                                                   <td><input type="text" class="form-control" name="disname[]" value="<?=$ds->name?>" placeholder="name"></td>
                                                   <td><input type="text" class="form-control" name="disqty[]" value="<?=$ds->quantity?>" placeholder="00"></td>
                                                   <td> <input type="text" class="form-control" name="disprice[]" value="<?=$ds->price?>" placeholder="$00.00"></td>
                                                   <td>
                                                      <div class="input-group"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="disstart[]" type="text" class="form-control date" value="<?=$ds->datestart?>"/></div>
                                                   </td>
                                                   <td>
                                                      <div class="input-group">   <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="disend[]" type="text" class="form-control date " value="<?=$ds->dateend?>">  </div>
                                                   </td>
                                                 
                                                   <td align="center">    <button data-id="<?=$ds->id?>" class="btn btndeldis btn-white"><i class="fa fa-trash"></i> </button> </td>
                                                </tr>                                           
                                             <?php
                                             if($ds->id>$idd) $idd=$ds->id; 
                                             }
                                          } ?>
                                          </tbody>
                                       </table>
                                        <a class="btn btn-success" id="adddis" >Thêm giảm giá</a>
                                    </div>
                                 </div>
                              </div>
                              <div id="tab-4" class="tab-pane">
                                 <div class="panel-body">
                                    <div class="table-responsive">
                                       <table class="table table-bordered table-stripped">
                                          <thead>
                                             <tr>
                                                <th>
                                                   Hình ảnh
                                                </th>
                                                <th>
                                                   url ảnh
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
                                             <?php  if(isset($catalogs->images) && $catalogs->images){
                                                $listimgs = json_decode($catalogs->images);
                                              foreach ( $listimgs  as $k => $img) { 
                                                $idim = str_replace('.', '_',str_replace('/', '_',str_replace('://', '_', $img->img)));
                                                ?>
                                                   <tr id="img_<?=$idim?>">
                                                      <td> <img width="100" src="<?=$img->img?>"></td>
                                                      <td>    <input type="text" name="imgs[]" class="form-control" value="<?=$img->img?>"></td>
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
                              <div id="tab-5" class="tab-pane">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Hình ảnh chia sẽ</label>
                                          <div class="col-sm-9">
                                             <img src="<?=(isset($catalogs)) ? $catalogs->imgshare : base_url('layout/images/no-image.png')?>" height="100px" width="100px">                  
                                             <input type="hidden" name="imgshare" value="<?=(isset($catalogs)) ? $catalogs->imgshare : ''?>"  id="imgshare" />
                                             <button class="btn btn-info" type="button" onclick="openPopup('imgshare')">Changes</button>
                                             <?php echo $this->size_imgshare ?>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">H1:</label>
                                          <div class="col-sm-10">
                                            <input type="text" required="" placeholder="H1" class="form-control area-input" 
                                             name="h1" id="h1" value="<?=(isset($catalogs)) ? $catalogs->h1 : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Meta Tag Title:</label>
                                          <div class="col-sm-10">
                                            <input type="text" required="" placeholder="metatitle" class="form-control area-input" 
                                             name="metatitle" id="metatitle" value="<?=(isset($catalogs)) ? $catalogs->metatitle : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Meta Tag Description:</label>
                                          <div class="col-sm-10">
                                            <input type="text" required="" placeholder="metadesc" class="form-control area-input" 
                                             name="metadesc" id="metadesc" value="<?=(isset($catalogs)) ? $catalogs->metadesc : ''?>">
                                         </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Meta Tag Keywords:</label>
                                          <div class="col-sm-10">
                                            <input type="text" required="" placeholder="metakey" class="form-control area-input" 
                                             name="metakey" id="metakey" value="<?=(isset($catalogs)) ? $catalogs->metakey : ''?>">
                                         </div>
                                       </div>
                                    </fieldset>
                                 </div>
                              </div>
                              <div id="tab-6" class="tab-pane">
                                 <div class="panel-body">
                                    <div class="table-responsive">
                                       <table class="table table-stripped table-bordered">
                                          <thead>
                                             <tr>
                                                <th>
                                                   Mã sku sản phẩm
                                                </th>
                                                <th>
                                                   Số lượng tặng
                                                </th>                                                                                          
                                                <th>
                                                   Hành động
                                                </th>
                                             </tr>
                                          </thead>
                                          <tbody id="listkm">
                                              <?php  $idkm = 1; if(isset($listkm) && $listkm){ foreach ($listkm as $km) { ?>
                                                <tr id="km_<?=$km->id?>">
                                                   <td>                                                      
                                                      <div class="col-md-12">
                                                         <select class="select2_demo_3 form-control" name="kmitem_id[]">
                                                            <option value=" ">-- Chọn sản phẩm tặng --</option>
                                                            <?php 
                                                            if(isset($itemkm) && $itemkm)
                                                            {
                                                               foreach($itemkm as $item)
                                                                  echo "<option ".( $km->item_id ==  $item->id?'selected':'')." value='{$item->id}'>{$item->name}</option>";
                                                            }
                                                            ?>
                                                         </select>
                                                     </div>
                                                   </td>
                                                   <td><input type="text" class="form-control" name="kmqty[]" value="<?=$km->qty?>" placeholder="00"></td>
                                                   <td align="center">    <button data-id="<?=$km->id?>" class="btn btndelkm btn-white"><i class="fa fa-trash"></i> </button> </td>
                                                </tr>                                           
                                             <?php
                                             if($km->id>$idkm) $idkm=$km->id; 
                                          }
                                          } ?>
                                          </tbody>
                                       </table>
                                        <a class="btn btn-success" id="addkm" >Thêm hàng tặng</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?=$this->randtoken('tokencatalog'); ?>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">CKEDITOR.replace('description');</script>
<script>
      var idd = <?=$idd+1?>;
      var idkm = <?=$idkm+1?>;
    
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
                '    <input type="text" name="imgs[]" class="form-control"  value="'+img+'">'+
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
         $('#adddis').click(function(){
            $('#listdis').append('<tr id="dis_'+idd+'">'+
                '<td>'+
                  '<input type="text" class="form-control" name="disname[]" placeholder="Tên chương trình">'+
                '</td>'+
                '<td>'+
                   '<input type="number" class="form-control" name="disqty[]" placeholder="0.0">'+
                '</td>'+
                '<td>'+
                  ' <input type="number" class="form-control" name="disprice[]" placeholder="00.00 VNĐ">'+
                '</td>'+
                '<td>'+
                  ' <div class="input-group">'+
                     ' <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="disstart[]" type="text" class="form-control date" value="">'+
                   '</div>'+
                '</td>'+
                '<td>'+
                  ' <div class="input-group">'+
                   '   <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="disend[]" type="text" class="form-control date" value="">'+
                 '  </div>'+
                '</td>'+            
               ' <td align="center">'+
               '    <button data-id="'+idd+'" class="btn btndeldis btn-white"><i class="fa fa-trash"></i> </button>'+
               ' </td>'+
            ' </tr>'); $( ".date" ).datepicker({dateFormat:'yy-mm-dd'});
            idd++;
        });
    });
    $(document).on('click','.btndeldis',function(){  
            var that = $(this);
            that.loading();
            setTimeout(function(){                     
                $('#dis_'+that.data('id')).remove();
            },2000);
        });
    $('#addkm').click(function(){
            $('#listkm').append('<tr id="km_'+idkm+'">'+
                '<td>'+
                     '<div class="col-md-12">'+
                        '<select class="select2_demo_3 form-control" name="kmitem_id[]">'+
                           '<option value=" ">-- Chọn sản phẩm tặng --</option>'+
                           <?php 
                           if(isset($itemkm) && $itemkm)
                           {
                              foreach($itemkm as $item)
                                 echo "'<option value=\"{$item->id}\">{$item->name}</option>'+";
                           }
                           ?>
                        '</select>'+
                    '</div>'+
                '</td>'+
                '<td>'+
                   '<input type="number" class="form-control" name="kmqty[]" placeholder="00">'+
                '</td>'+                     
               ' <td align="center">'+
               '    <button data-id="'+idkm+'" class="btn btndelkm btn-white"><i class="fa fa-trash"></i> </button>'+
               ' </td>'+
            ' </tr>');
            $(document).on('click','.btndelkm',function(){  
               var that = $(this);
               that.loading();
               setTimeout(function(){                     
                   $('#km_'+that.data('id')).remove();
               },2000);
            });
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });
             $( ".date" ).datepicker({dateFormat:'yy-mm-dd'});
             idkm++;
        });
    
</script>