<?php
$__ks_limit=!empty($__ks_limit)?$__ks_limit:10;

$__resentKnowledge=Mknowledge::FindAllBy("is_stickey", "N",array("status"=>"P"),'entry_time','DESC',$__ks_limit);
$__MostPopularKnowledge=Mknowledge::FindAllBy("status", "P",[],'v_count',"DESC",$__ks_limit);
$__MostHelpfullKnowledge=Mknowledge::FindAllBy("status", "P",[],'l_count',"DESC",$__ks_limit);

$isViewCount=$isLikeCount=Mapp_setting::GetSettingsValue("is_kn_iconc","N")=="N";

?>


<div class="row">

    <div class="col-md-6 article-box">
        <h2 class="art-title">
	        <?php _e("Recent Articles"); ?>
        </h2>
        <div class="art-list">
	        <?php if(!empty($__resentKnowledge)){echo get_knowledge_list_artbox_2020($__resentKnowledge,true,$isViewCount); }?>
        </div>
    </div>

    <div class="col-md-6 article-box">
        <h2 class="art-title">
	        <?php _e("Popular Articles") ; ?>
        </h2>
        <div class="art-list">
	        <?php if(!empty($__MostPopularKnowledge)){echo get_knowledge_list_artbox_2020($__MostPopularKnowledge,false,$isViewCount); }?>
        </div>
    </div>
    <?php /* ?>
    <div class="col-md-6 article-box">
        <h2 class="art-title">
	        <?php _e("Most Helpful Articles") ; ?>
        </h2>
        <div class="art-list">
	        <?php if(!empty($__MostHelpfullKnowledge)){echo get_knowledge_list_artbox_2020($__MostHelpfullKnowledge,false,false,$isLikeCount); }?>
        </div>
    </div>
 */?>
</div>