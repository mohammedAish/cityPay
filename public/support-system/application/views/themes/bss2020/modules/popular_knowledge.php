<?php
if(empty($cat_ids)){
    $cat_ids=[];
} 
if(empty($ctg_title)){
    $ctg_title="";
}
$cat_str="";
if(count($cat_ids)){   
    $cat_str="('".implode("','", $cat_ids)."')";
    //GPrint($cat_str);
}
	$isViewCount=Mapp_setting::GetSettingsValue("is_kn_iconc","N")=="N";
?>
<div class="card card-default app-panel-box mb-3">
			<div class="card-header"><?php _e("%s Popular Knowledge",$ctg_title); ?></div>
		  <div class="card-body p-0">
		  <ul class="kn-list ctg-list">
		      	<?php 
		      	$__pkn=new Mknowledge();
		      	if(!empty($cat_str)){
		      	    $__pkn->cat_id("in {$cat_str}", true);
		      	}
		      	$__pkn->status("P");
		      	$_tkts=$__pkn->SelectAll("", 'v_count','DESC',5);		      
		      	if(count($_tkts)>0){
		      	foreach ($_tkts as $_tkt){
		      	    ?>
		      	    
		      	    <li class=" p-10  ">
		      	    <h5 class="m-0">    			
		      	    <a href="<?php echo site_url("knowledge/details/{$_tkt->id}/{$_tkt->slug_id}");?>">
		      	     <i class="fa fa-angle-double-right"></i> <?php echo $_tkt->title;
		      	     if($isViewCount){
		      	     ?>
		      	     <span class="float-right">( <i class="fa fa-eye"></i> <?php echo _n(str_pad($_tkt->v_count, 2,'0',STR_PAD_LEFT));?> )</span>
                     <?php } ?>
		      	    </a>    				
		      	    </h5>		      	    
		      	    </li>
		      	   
		      	    <?php 
		      	}
		      	}else{
		      	    ?>
		      	    
		      	    <li class=" p-10  text-center">
		      	    <?php _e("No Knowledge found") ; ?>
		      	    
		      	    </li>
		      	    <?php 
		      	}
		      	?>
		       </ul>	
		  </div>
		</div>