<?php 
$grid=new jQGrid();
$grid->url =$grid_url;
$grid->width = "auto";
//$grid->minWidth=500;
$grid->height = "auto";
$grid->rowNum = 20;
$grid->pager = "#pagerb";
$grid->container = ".grid-body";
$grid->ShowReloadButtonInTitle=true;
$grid->ShowDownloadButtonInTitle=true;
//$grid->shrinkToFit=false;
if(ACL::HasPermission("admin/ticket-assign-rule/add")){
	$grid->AddTitleRightHtml('<a data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-info" href="'.site_url("admin/ticket-assign-rule/add").'" ><i class="fa fa-plus"></i>'.__('Add New').'</a>');
}
//Fields
//$grid->AddModel("Id", "id", 100 ,"center");
$grid->AddModelNonSearchable("Categories", "cat_ids", 200 ,"center");
$grid->SetXSCombindeField("cat_ids");
$grid->AddModelNonSearchable("Rule Type", "rule_type", 100 ,"center");
$grid->AddModelNonSearchable("User Or Role", "rule_id", 100 ,"center");
$grid->AddModelNonSearchable("Status", "status", 80 ,"center");
	    
if(ACL::HasPermission("admin/ticket-assign-rule/edit")){
	$grid->AddModelNonSearchable("Action", "action", 100 ,"center");
}

?>
<style>
    .rule-cats{
        min-height: 100px;
        display: flex;
        align-items: center;
        position: relative;
       
    }
    .rule-js{
        justify-content: center;
        top: 0;
        bottom: 0;
        right: 0;
        bottom: 0;
    }
    .rule-cats::before{
        font-family: FontAwesome;
        content: "\f0da";
        position: absolute;

        bottom: 0;
        right: -22px;
        color: #2DE549;
        top: 50%;
        margin-top: -13px;
        font-size: 40px;
       
    }
    .rule-cats::after{
        font-family: FontAwesome;
        content: " ";
        position: absolute;
        top: 0;
        bottom: 0;
        right: -10px;
        width: 3px;
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#2de549+0,2de549+100&0+0,1+28,1+70,0+100 */
        background: -moz-linear-gradient(top,  rgba(45,229,73,0) 0%, rgba(45,229,73,1) 28%, rgba(45,229,73,1) 70%, rgba(45,229,73,0) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(45,229,73,0) 0%,rgba(45,229,73,1) 28%,rgba(45,229,73,1) 70%,rgba(45,229,73,0) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(45,229,73,0) 0%,rgba(45,229,73,1) 28%,rgba(45,229,73,1) 70%,rgba(45,229,73,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#002de549', endColorstr='#002de549',GradientType=0 ); /* IE6-9 */


    }
    .rule-cats > div{
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .rule-cats > div > div{
        white-space: nowrap;
    }
    .rule-cats > div > div >span{
        color: #2DE549;
        padding-right: 5px;
    }
    .gs-jq-grid .ui-jqgrid tr.ui-row-ltr td:nth-child(2) ,.gs-jq-grid .ui-jqgrid tr.ui-row-ltr td:nth-child(3){
        border-right-color: transparent;
    }
   
    
    
</style>
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
