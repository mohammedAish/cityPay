<?php
$grid=new jQGrid();
$grid->url =$grid_url;
$grid->width = "auto";
//$grid->minWidth=500;
$grid->height = 340;
$grid->rowNum = 20;
$grid->pager = "#pagerb";
$grid->container = ".grid-body";
$grid->ShowReloadButtonInTitle=true;
$grid->ShowDownloadButtonInTitle=true;
//$grid->shrinkToFit=false;




//$status=array("*"=>"All","W"=>"Waiting For launch", "A"=>"Launched","I"=>"Inactive");
$grid->AddSearchProperty("Product", "pid","select",$products);
$grid->AddModelNonSearchable("Product", "cprodtitle", 80 ,"center");
$grid->AddModelNonSearchable("Name", "ccustname", 80 ,"center");
$grid->AddModelNonSearchable("Country", "ccustcc", 80 ,"center");
$grid->AddModel("Email", "ccustemail", 120 ,"center");
$grid->AddModelNonSearchable("Amount", "ctransamount", 80 ,"center");
$grid->AddModelCustomSearchable("Trn. Type", "ctransaction", 120 ,"center","select",array("*"=>"All","SALE"=>"SALE","RFND"=>"RFND"));
//$grid->AddModelNonSearchable("Action", "action", 80,"center");
//$grid->AddResponsiveHidden("user_email");
//$grid->AddResponsiveHidden("product_base_name,lictype,market,max_domain,lic_type");
if(function_exists("add_css")){
	//add_css('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/themes/base/jquery-ui.css');
}
?>
<div class="box box-primary">
	<?php /*?><div class="box-header" style="cursor: move;"></div><!-- /.box-header --><?php // */?>     
     <div class="box-body grid-body">
     <?php $grid->show();?>
     </div><!-- /.box-body -->
    <?php /*?> <div class="box-footer clearfix no-border"></div><?php // */?> 
</div>
<script type="text/javascript">
$(function(){
	AddOnCloseMethod(<?php echo $grid->ReloadMethod();?>);
});
</script>