<?php defined('BASE') OR exit('No direct script access allowed');?>
<div class="row">
   <div class="col-lg-12">
      <div class="ibox float-e-margins">
         <div class="ibox-content">
            <div class="form-horizontal">
               <form class="m-t" role="form" action="" method="post" id="form-users">
                  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                    <div class="col-sm-3 col-sm-offset-10 ">
                        <a class="btn btn-white" type="text" href="<?=base_url('catalog');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit" name="save"><?php echo $this->save ?></button>
                    </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="tabs-container">
                           <ul class="nav nav-tabs">
						   <?php foreach($_SESSION['configgroup'] as $k=>$gr){ ?>
                              <li class="<?=$k==1?'active':''?>"><a data-toggle="tab" href="#tab-<?=$k?>"><?=$gr?></a></li>
						   <?php } ?>
                           </ul>
                           <div class="tab-content">
						    <?php foreach($_SESSION['configgroup'] as $k=>$gr){ ?>
                              <div id="tab-<?=$k?>" class="tab-pane <?=$k==1?'active':''?>">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                       <?php if($configs) {foreach ($configs as $a){if($a->tabs == $k){?>
                                          <?=$this->api_config($a->id,$a->name,$a->value,$a->description,$a->types,'',$a->small); ?>
                                       <?php }}} ?>
                                    </fieldset>
                                 </div>
                              </div>
							   <?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?=$this->randtoken('tokenconfigs'); ?>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?=$this->api_script();?>