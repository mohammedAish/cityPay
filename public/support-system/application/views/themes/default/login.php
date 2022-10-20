<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo !empty($title)?$title:""; ?></title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
        <meta name="resource-type" content="document" />
        <meta name="robots" content="all, index, follow"/>
        <meta name="googlebot" content="all, index, follow" />
     	<script type="text/javascript">var base_url="<?php echo base_url();?>";</script>

        <?php
        $favexist=true;
        $faviconurl=base_url("images/icon-logo/logo.png");
        
        if($favexist){
        ?>

        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url("images/icon-logo/apple-touch-icon.png");?>">
        <link rel="icon" type="image/png" href="<?php echo $faviconurl;?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url("images/icon-logo/favicon-32x32.png");?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("images/icon-logo/favicon-16x16.png");?>">
        <link rel="manifest" href="<?php echo base_url("images/icon-logo/manifest.json");?>">

        <meta name="theme-color" content="#720000">
        <meta name="msapplication-navbutton-color" content="#720000">
        <?php
     }
    /** -- Copy from here -- */
    if(!empty($meta))
    foreach($meta as $name=>$content){
        echo "\n\t\t";
        ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
             }
    echo "\n";
 
    if(!empty($canonical))
    {
        echo "\n\t\t";
        ?><link rel="canonical" href="<?php echo $canonical?>" /><?php
 
    }
    echo "\n\t";
 
    foreach($css as $file){
         echo "\n\t\t";
        ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
    } echo "\n\t";
 
    foreach($js as $file){
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
    } echo "\n\t";
 
    /** -- to here -- */
?>
       <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
	<body class="aps-ctrl-p login-page">

    <style type="text/css">
        .video-wrapper{
            background: rgba(1, 1, 1, 0.74) url("../images/login-images/pattern.png") repeat top left;
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
	    <?php 	echo $output; ?>

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
	</body>
</html>