<div class="panel panel-default" style="margin-top: 25px;">
  <div class="panel-body">
  <?php echo GetMsg();?>
   <div class="row text-center">
        <img class="app-logo-img" style="width:100px;" alt="Logo" src="<?php echo image_url('images/logo.png',true);?>">
   </div>
      <h4 class="text-danger text-center">Admin access denied for your country <?php if(!empty($current_name)){ ?>(<?php echo $current_name;?>)<?php } ?></h4>
      <div class="text-center">
          <a href="<?php echo base_url() ?>" class="btn btn-lg btn-success"> <i class="fa fa-home"></i> <?php _e("Go Back") ; ?></a>
      </div>
  </div>
</div>

