<!DOCTYPE html>
<html>
<head>
    <?php $this->load('layout/head'); ?>
</head>

<body>
    <div id="wrapper">
    	<!-- ==========Left Menu========== -->
        <?php $this->load('layout/mainmenu'); ?>
        <!-- =============//============== -->
        <div id="page-wrapper" class="gray-bg dashbard-1">
        	<!-- ==========Top Menu========== -->
        		<?php $this->load('layout/topmenu'); ?>
        	<!-- =============//============== -->
           <?php $this->load('layout/title'); ?>
            <?php 
                if(file_exists($this->pathview.$view.'.php'))
                    include  $this->pathview.$view.'.php';
                $this->loadhtml();                   
            ?>

	         <?php $this->load('layout/footer'); ?>
        </div>
        
        <div id="right-sidebar" class="animated">
            <?php $this->load('layout/rightsidebar'); ?>
    	</div>

<!--/=================Js===============/-->
<?php $this->load('layout/script');?>

<?php
        echo $this->js; 
    if($this->msg) {echo $this->msg;$this->msg='';}
?>

<!--/==================================/-->
   
</body>

</html>
