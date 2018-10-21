
<!DOCTYPE html>
<html>
<head>
    <?php $this->load('layout/login/head'); ?>
</head>
<body class="gray-bg">
    <?php 
        if(file_exists($this->pathview.$view.'.php'))
            include  $this->pathview.$view.'.php';
    ?>
</body>
<?php  echo $this->js; 
 	if($this->msg) {echo $this->msg;$this->msg='';} ?>
</html>
