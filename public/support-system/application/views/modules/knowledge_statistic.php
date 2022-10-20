<?php
$__ks_limit=!empty($__ks_limit)?$__ks_limit:10;

$__resentKnowledge=Mknowledge::FindAllBy("is_stickey", "N",array("status"=>"P"),'entry_time','DESC',$__ks_limit);
$__MostPopularKnowledge=Mknowledge::FindAllBy("status", "P",[],'v_count',"DESC",$__ks_limit);
$__MostHelpfullKnowledge=Mknowledge::FindAllBy("status", "P",[],'l_count',"DESC",$__ks_limit);

$isViewCount=$isLikeCount=Mapp_setting::GetSettingsValue("is_kn_iconc","N")=="N";

?>
<div class="row">
<div class="col-md-4 art-box">
<h3 class="art-box-title">
	      <?php _e("Recent Articles"); ?>
	   </h3>
	   <div class="art-box-content"> 
	   <?php if(!empty($__resentKnowledge)){echo get_knowledge_list_artbox($__resentKnowledge,true,$isViewCount); }?>
	   </div>
	</div>
	<div class="col-md-4 art-box">
	   <h3 class="art-box-title">
	       <?php _e("Popular Articles") ; ?>
	   </h3>
	   <div class="art-box-content"> 
	   <?php if(!empty($__MostPopularKnowledge)){echo get_knowledge_list_artbox($__MostPopularKnowledge,false,$isViewCount); }?>
	   </div>
	</div>
	<div class="col-md-4 art-box">
	  <h3 class="art-box-title">
	      <?php _e("Most Helpful Articles") ; ?>
	   </h3>
	   <div class="art-box-content"> 
	   <?php if(!empty($__MostHelpfullKnowledge)){echo get_knowledge_list_artbox($__MostHelpfullKnowledge,false,false,$isLikeCount); }?>
	   </div>
	</div>
	
</div>