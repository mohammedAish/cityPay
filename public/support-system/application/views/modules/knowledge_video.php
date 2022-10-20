<?php
if(!empty($kn_video_link)){ 
    $kn_video_link=str_replace(["http:","https:"], "", $kn_video_link);    
   if(strpos($kn_video_link, "youtu.b")!==FALSE){
    $kn_video_link= preg_replace("/\s*[a-zA-Z\/\/:\.]*youtu.be\/([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","//www.youtube.com/embed/$1?rel=0&amp;showinfo=0",$kn_video_link);
   }elseif(strpos($kn_video_link, "youtube.com")!==FALSE){
    $kn_video_link= preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","//www.youtube.com/embed/$1?rel=0&amp;showinfo=0",$kn_video_link);;
   }elseif(strpos($kn_video_link, "dai.ly")!==FALSE){
    $kn_video_link= preg_replace("/\s*[a-zA-Z\/\/:\.]*dai.ly\/([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","//www.dailymotion.com/embed/video/$1?rel=0&amp;showinfo=0",$kn_video_link);
   }elseif(strpos($kn_video_link, "dailymotion")!==FALSE){
    $kn_video_link= preg_replace("/\s*[a-zA-Z\/\/:\.]*dailymotion.com\/video\/([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","//www.dailymotion.com/embed/video/$1?rel=0&amp;showinfo=0",$kn_video_link);
   } 
    
?>
<div class="panel panel-default app-panel-box">
  <div class="panel-heading"><?php _e("Video"); ?></div>		  
  <div class="panel-body p-0">
  <iframe src="<?php echo $kn_video_link;?>" allowfullscreen="" allow="autoplay; encrypted-media" width="100%" style="min-height: 215px;margin-bottom: -5px;"  frameborder="0"></iframe>
  </div>
</div>
<?php }?>