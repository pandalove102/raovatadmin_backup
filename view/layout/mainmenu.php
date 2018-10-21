<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element" style="text-align: center;"> <span>
                    <img alt="image" class="img-circle" src="<?=base_url()?>layout/images/male-user.jpg" />
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->model->session->get('admin_user') ?></strong>
                     </span> <span class="text-muted text-xs block"><?php echo $this->model->session->get('group_id') ?> <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Contacts</a></li>
                        <li><a href="#">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="<?=base_url('user/logout');?>">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    HD
                </div>
            </li>
			<?php 
			if($this->pages)
			{
				$check = $this->pages[0]->parent; 
				$icname=$this->getcontrollername();				
				foreach($this->pages as $i=>$pr)
				{
					$nmenu = $this->getnamemenu($pr->parent);
					if($i !=0 && $pr->parent == $check){						
						continue;
					}
					else{										
						$check = $pr->parent;
					}										
					?>
					<li class="<?=$this->parent==$pr->parent?'active':'' ?>">
						<a ><i class="<?=$nmenu['icon']?>"></i> <span class="nav-label"><?=$nmenu['name']?></span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level collapse">
							<?php 
							$check2 = ''; 
							foreach($this->pages as $i2=>$cr)
							{
								if($cr->parent == $pr->parent && ($check2=='' || $check2 != $cr->controller)){	
								$snmenu=$this->getnamemenu($pr->parent,$cr->controller);
							?>
							<li class="<?=$icname ==$cr->controller?'active':'' ?>"><a href="<?=base_url($cr->controller);?>"><i class="<?=$snmenu['icon']?>"></i> <?=$snmenu['name']?></a></li>
							<?php 
								$check2=$cr->controller;
								} 
							} ?>							
						</ul>
					</li>
					<?php 
				}
			}
			?>            
        </ul>
    </div>
</nav>
