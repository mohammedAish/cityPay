<div class="panel panel-default" style="margin-top: 25px;">
  <div class="panel-body text-center">
  <?php echo GetMsg();?>
   <div class="row text-center">
        <img class="app-logo-img" style="width:100px;" alt="Logo" src="<?php echo image_url('images/logo.png',true);?>">
   </div>
      <?php
      if(!empty($lock_type) && strtoupper($lock_type)=="H"){
	      $msg=__("Access denied for hacking attempts");
      }else{
	      $msg=__("Access denied");
      }
      ?>
      <br>
      <div class="alert alert-danger"><?php echo $warning_messages ; ?></div><br>
      <a href="<?php echo base_url() ?>" class="btn btn-lg btn-success"> <i class="fa fa-home"></i> <?php _e("Go Home Page") ; ?></a>
  </div>    
</div>


