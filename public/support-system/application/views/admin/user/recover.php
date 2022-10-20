<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">

.video-wrapper{
	background: rgba(1, 1, 1, 0.74) url(../images/login-images/pattern.png) repeat top left;
  position: fixed;
  top: 0; right: 0; bottom: 0; left: 0;
  z-index: -1;
	visibility: hidden;
}
.video-background {
  background: #000;
  position: fixed;
  top: 0; right: 0; bottom: 0; left: 0;
  z-index: -99;
	visibility: hidden;
}
.video-foreground,
.video-background iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
}
#vidtop-content {
	top: 0;
	color: #fff;
}
.vid-info { position: absolute; top: 0; right: 0; width: 33%; background: rgba(0,0,0,0.3); color: #fff; padding: 1rem; font-family: Avenir, Helvetica, sans-serif; }
.vid-info h1 { font-size: 2rem; font-weight: 700; margin-top: 0; line-height: 1.2; }
.vid-info a { display: block; color: #fff; text-decoration: none; background: rgba(0,0,0,0.5); -webkit-transition: .6s background; transition: .6s background; border-bottom: none; margin: 1rem auto; text-align: center; }
@media (min-aspect-ratio: 16/9) {
  .video-foreground { height: 300%; top: -100%; }
}
@media (max-aspect-ratio: 16/9) {
  .video-foreground { width: 300%; left: -100%; }
}
@media all and (max-width: 600px) {
.vid-info { width: 50%; padding: .5rem; }
.vid-info h1 { margin-bottom: .2rem; }
}
@media all and (max-width: 500px) {
.vid-info .acronym { display: none; }
}
</style>
<?php /* ?>
<div class="video-wrapper"></div>
<div class="video-background">
    <div class="video-foreground">
	  <div id="muteYouTubeVideoPlayer"></div>

		<script async src="https://www.youtube.com/iframe_api"></script>
		<script>
		 function onYouTubeIframeAPIReady() {
		  var player;
		  player = new YT.Player('muteYouTubeVideoPlayer', {
			videoId: 'gr6Qh4zOZYI', // YouTube Video ID
			width: 560,               // Player width (in px)
			height: 316,              // Player height (in px)
			playerVars: {
			  autoplay: 1,        // Auto-play the video on load
			  controls: 0,        // Show pause/play buttons in player
			  showinfo: 0,        // Hide the video title
			  modestbranding: 1,  // Hide the Youtube Logo
			  loop: 1,            // Run the video in a loop
			  fs: 0,              // Hide the full screen button
			  cc_load_policy: 0, // Hide closed captions
			  iv_load_policy: 3,  // Hide the Video Annotations
			  autohide: 0,         // Hide video controls when playing
			  rel:0
			},
			events: {
			  onReady: function(e) {
				$(".video-wrapper").css("visibility","visible");
				$(".video-background").css("visibility","visible");
				e.target.mute();
			  },
			  onStateChange:function(e){
				if (e.data === YT.PlayerState.ENDED) {
					player.playVideo();
				}
			  }

			}
		  });
		 }

		 // Written by @labnol
		</script>
    </div>
  </div>
  <?php */ ?>
    <ul id="bgslider" class="cb-slideshow" style="display: none;">
            <li><span>Image 01</span><div><h3></h3></div></li>
            <li><span>Image 02</span><div><h3></h3></div></li>
            <li><span>Image 03</span><div><h3></h3></div></li>
            <li><span>Image 04</span><div><h3></h3></div></li>
            <li><span>Image 05</span><div><h3></h3></div></li>
            <li><span>Image 06</span><div><h3></h3></div></li>
        </ul>
        <?php //*/?>
<div class="login-box">
      <div class="login-logo">
      <?php ?><img style="max-height: 90px;" src="<?php echo base_url("images/logo.png");?>" alt="appsbd" /><br/>
        <h3>
         <?php
          	$_app_name=$this->config->item('app_name');
          	$sppost=strpos($_app_name, " ");
          	$_firstpart=$_app_name;
          	$_2ndpart="";
          	if($sppost!==FALSE){
          		$_firstpart=substr($_app_name, 0,$sppost);
          		$_2ndpart=substr($_app_name,$sppost);
          	}
          ?>
          <b><?php echo $_firstpart;?></b><?php echo $_2ndpart;?><br/> Password Recover</h3>

      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Set new password</p>
        <?php echo GetMsg();
        //GPrint($recover_obj);
        ?>
           <?php echo form_open(current_url(),array("class"=>"form bv-form material","method"=>"post"));?>
          <div class="form-group">
	      		<label class="control-label label-required" for="pass"><?php _e("Password"); ?></label>
	      		<input type="password" maxlength="32"   value="" class="form-control" id="pass"  name="pass"     placeholder="<?php _e("Password"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Password"));?>">
	      	</div>
           <div class="form-group">
				<label class="control-label" for="cpass">Confirm Password</label>
				<input type="password" name="cpass" id="cpass" value="" maxlength="250" autocomplete="off" class="form-control" placeholder="<?php _e("Confirm password"); ?>" data-bv-identical="true"data-bv-identical-field="pass" data-bv-field="password" data-bv-notempty="true"data-bv-identical-message="Confirm password is not same"data-bv-notempty-message="Confirm Password is required">
			</div>
			<div class="">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-unlock-alt"></i> <?php _e("Update");?></button>
            </div>
            <div class="row"></div>
       <?php echo form_close();?>
      </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<script type="text/javascript">
$(function(e){
	var newImg = new Image;
	var bgcount=0;
	var imgList=["<?php echo base_url("images/login-images/1.jpg");?>","<?php echo base_url("images/login-images/2.jpg");?>","<?php echo base_url("images/login-images/3.jpg");?>","<?php echo base_url("images/login-images/4.jpg");?>"]
    setTimeout(function(){
       // return;
    	newImg.onload = function() {
    		if(bgcount<imgList.length){
    			//newImg = new Image;
    			$("#bgslider").show();
    			//$("#bgslider").append('<li><span>Image '+bgcount+'</span><div><h3></h3></div></li>');
    			//return;
    			newImg.src=imgList[bgcount];

    			bgcount++;
    		}else{
    			$("#bgslider").show();
    		}
    	}
    	newImg.src = imgList[bgcount];
    },1000);

});
</script>
