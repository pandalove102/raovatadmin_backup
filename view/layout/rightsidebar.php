<div class="sidebar-container">
    <ul class="nav nav-tabs navs-3">

        <li class="active"><a data-toggle="tab" href="#tab-1">
            Notes
        </a></li>
        <li><a data-toggle="tab" href="#tab-2">
            Projects
        </a></li>
        <li class=""><a data-toggle="tab" href="#tab-3">
            <i class="fa fa-gear"></i>
        </a></li>
    </ul>

    <div class="tab-content">

    	<!-- Tab Note -->
        	<?php $this->load('page/tab/note.php'); ?>
        <!-- // -->

        <!-- Project -->
        	<?php $this->load('page/tab/project.php'); ?>
        <!-- // -->

        <!-- Project -->
        	<?php $this->load('page/tab/setting.php'); ?>
        <!-- // --> 
	</div>
</div>