<?php 
$ctg_limit=!empty($ctg_limit)?$ctg_limit:5;
$col_width=!empty($col_width)?$col_width:4;
$ktkData=Mcategory::getCategoriesKnowledges($ctg_limit,0,"last_update_time","DESC",",");
//GPrint($ktkData);
	$isViewCount=Mapp_setting::GetSettingsValue("is_kn_iconc","N")=="N";
?>
<div class="row">
    <?php 
    $_col_count=0;
    foreach ($ktkData as $cat_id=>$cdt){
        if($_col_count!=0 && $_col_count%3==0){
            ?>
            </div>
            <div class="row">
            <?php 
        }
    ?>
    <div class="col-md-<?php echo $col_width;?> art-box">
	  <h3 class="art-box-title">
	       <?php echo $cdt->title.(($ctg_limit>0 && $cdt->total>$ctg_limit)?' <small>( '.$cdt->total.' <a class="art-title-btn" href="'.site_url("category/details/{$cat_id}").'">'.__("View All").'</a> )</small>':"");?>	      
	   </h3>
	   <div class="art-box-content"> 
	   <?php if(!empty($cdt->knData)){echo get_knowledge_list_artbox($cdt->knData,false,$isViewCount);}?>
	   </div>
	</div>
	<?php 
	$_col_count++;
    }?>	
</div>