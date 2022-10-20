<div class="panel panel-default" style="margin-top: 25px;">
  <div class="panel-body">
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
      <h4 class="text-danger text-center"><?php echo $msg ; ?></h4>
  </div>
</div>

