<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->h ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?=base_url()?>">Home</a>
            </li>
            <li>
                <a href="<?=base_url($this->getcontrollername())?>"><?php echo $this->a?$this->a:ucfirst($this->getcontrollername()) ?></a>
            </li>
            <li class="active">
                <strong><?php  echo $this->strong ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>