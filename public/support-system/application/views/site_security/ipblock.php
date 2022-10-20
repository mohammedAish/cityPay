
<div class="panel panel-default" style="margin-top: 25px;">      
  <div class="panel-body">
  <?php echo GetMsg();?>
   <div class="row text-center">
        <img class="app-logo-img" style="width:100px;" alt="Logo" src="<?php echo image_url('images/logo.png',true);?>">
   </div>
   
		<?php 
		if(!empty($lock_type) &&($lock_type=="GC" || $lock_type=="C")){
		echo form_open ( current_url(),array("class"=>"form bv-form","id"=>"ip-form","method"=>"post"));?>
	  
	  <div class="col-md-6 col-md-offset-3">
      	<div class="form-group text-center" style="padding-top: 50px;">
      	
		<label><?php echo $lock_type=="GC"?"":__("Captcha");?> </label> 
		
		<?php echo AppCaptcha::get_chapcha_html('','form-control');
		
		if($lock_type=="C"){
		?>
		<button type="submit" class="btn  btn-success">Submit</button>
		<style>
        .app-captcha-input{
        	max-width: 70%;
        	display: inline-block;
        }
   </style>
		<?php }?>
		</div>
	</div>
	<?php echo form_close();
		}elseif(!empty($lock_type) && $lock_type=="L"){?>
		<h4 class="text-danger text-center">Access denied for this IP (<?php echo $current_ip;?>)</h4>
		<?php }?>
  </div>
</div>

<script type="text/javascript">
function recaptchaCall(){
	$(".g-recaptcha").each(function() {
        var id = $(this).attr("id");
        var site_key = $(this).data("sitekey");
        $(this).addClass("added-recpatcha");
       // alert("ok");
        grecaptcha.render(id, {
            sitekey: site_key,
            callback: function() {
              $("#ip-form").submit();
            }
        });
    });
}
</script>
<?php  if(!empty($lock_type) && $lock_type=="GC"){
	     ?>
	<style>
    .g-recaptcha > div {
    	margin: 0 auto;
    }
    </style>  
	<script src="//www.google.com/recaptcha/api.js?onload=recaptchaCall&render=explicit"></script>
	   <?php 
}?>
