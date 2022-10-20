<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

        <?php //*/?>
<div class="login-box">
      <div class="login-logo">
      <?php ?><img style="max-height: 90px; max-width: 100%;min-width: 90px;" src="<?php echo image_url("images/logo-admin.png",true);?>" alt="<?php echo get_app_title();?>" /><br/>
        <h3><?php _e("Admin Panel") ; ?></h3>

      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg"><?php _e("Sign in to start your session") ; ?></p>
        <?php echo GetMsg();?>
           <?php echo form_open(current_url(),array("class"=>"form bv-form material","method"=>"post"));?>
          <div class="form-group ">
           <label for="username" class="control-label"><i class="fa fa-user"></i> <?php _e("Username") ; ?></label>
           <input autofocus   name="username" id="username"  class="form-control" value=""
			 	 data-bv-notempty-message="Username is required" data-bv-notempty="true" >

           </div>
           <div class="form-group ">
           <label for="password" class="control-label"><i class="fa fa-lock"></i> <?php _e("Password") ; ?></label>
           <input type="password"  name="password" id="password" class="form-control" value=""
			 	data-bv-notempty-message="Password is required" data-bv-notempty="true" >
           </div>
              <?php if(Mapp_setting::GetSettingsValue("is_cptcha_admin_login","N")=="Y"){?>
        	<div class="form-group">
        		<label><?php _e("Captcha");?></label>
        		<?php echo AppCaptcha::get_chapcha_html('','form-control');?>
        	</div>
        	<?php }?>
          <div class="row">
          <div class="col-sm-12">
              <button type="submit" class="btn btn-success btn-raised fa-btn-icon faa-parent animated-hover "><i class="fa fa-an-login   faa-pulse  "></i> <?php _e("Sign In") ; ?></button>
              <a data-effect="mfp-move-from-top" tabindex="-1"	href="<?php echo site_url("admin/user/forget");?>" class="popupform  pull-right"><?php _e("Forgot password?");?></a>
            </div><!-- /.col -->
          </div>
        <?php echo form_close();?>
          <?php if(ISDEMOMODE){ ?>
              <div class="row m-t-15"></div>
              <small class="">Demo Login Info</small>
              <table class="table m-b-0 m-t-5 demo-table">
                  <tr>
                      <th>Username</th>
                      <th>Password</th>
                      <th></th>
                  </tr>
                  <tr>
                      <td>admin</td>
                      <td>admin</td>
                      <td class="text-center"><button data-user="admin" data-pw="admin" class="demo-setit btn btn-xs btn-info">SET IT</button></td>
                  </tr>
                  <tr>
                      <td>agent</td>
                      <td>agent</td>
                      <td class="text-center"><button data-user="agent" data-pw="agent" class="demo-setit btn btn-xs btn-info">SET IT</button></td>
                  </tr>
              </table>
          <?php } ?>
      </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
<?php if(ISDEMOMODE){ ?>
    <style type="text/css">
    .demo-setit{

    }
    .demo-table{
        border: 1px solid #ddd;
    }
    .demo-table *{
        font-size: 10px;
    }
    .demo-table tr td,.demo-table tr th{
        padding: 5px !important;
    }
    </style>
    <script type="text/javascript">
        $(function(){
            $(".demo-setit").on("click",function (e) {
                e.preventDefault();
                $("#username").val($(this).data("user"));
                $("#password").val($(this).data("pw"));
            });
        });
    </script>
<?php } ?>

