<?php 
$ctg_limit=!empty($ctg_limit)?$ctg_limit:5;
$col_width=!empty($col_width)?$col_width:6;
$ktkData=Mcategory::getCategoriesKnowledges($ctg_limit,0,"last_update_time","DESC",",");
//GPrint($ktkData);
	$isViewCount=Mapp_setting::GetSettingsValue("is_kn_iconc","N")=="N";
?>

<div id="kn-card-list-2020" class="row" >
    <?php 
    $_col_count=0;
    foreach ($ktkData as $cat_id=>$cdt){
    ?>
    <div class="col-md-<?php echo $col_width;?> article-box">
        <h2 class="art-title">
	       <?php echo $cdt->title;?>
        </h2>
        <div class="art-list">
	   <?php if(!empty($cdt->knData)){echo get_knowledge_list_artbox_2020($cdt->knData,false,$isViewCount);}?>
	   </div>
	    <?php if($ctg_limit>0 && $cdt->total>$ctg_limit){ ?>
        <div class="text-center pt-3">
            <a href="<?php echo site_url("category/details/{$cat_id}") ?>" class="btn btn-sm btn-theme-light"><i class="fa fa-ticket"></i><?php _e("View All") ?></a>
        </div>
	    <?php } ?>
	</div>
	<?php 
	$_col_count++;
    }?>	
</div>