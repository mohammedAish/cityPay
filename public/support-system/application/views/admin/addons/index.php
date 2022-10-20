<div class="box box-primary">
	<div class="box-header">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="m-0" ><?php _e("Addon List") ; ?></h3>
            </div>
            <div class="col-sm-6 text-right">
                <a href="" class="btn btn-success btn-sm"><?php _e("Add New Addon") ; ?></a>
            </div>
        </div>
    </div>
     <div class="box-body" style="min-height: 600px;">

     <?php if(!empty($addons)) {
         foreach ($addons as $addon) {
             ?>
             <div class="panel panel-default addon-panel">
                 <div class="panel-body">
                     <div class="row">
                         <div class="col-sm-4 col-md-2">
                             <span class="addon-title"><?php echo $addon->name; ?></span>
                             <div class="clearfix m-t-10">
                                 <a class="btn btn-xs <?php echo $addon->status?'btn-warning':'btn-success'; ?> ConfirmAjaxWR"  data-on-complete='change_addon_status' data-msg="<?php _e("Are you sure to %s this %s",($addon->status?"deactivate":"active"), $addon->name); ?>" href="<?php echo site_url("admin/addons-confirm/active-addon?p=".urlencode($addon->file_path)) ?>" ><?php echo $addon->status?__('Deactive'):__('Activate'); ?></a>
                                 <a href="#" class="btn btn-xs btn-danger"><?php _e("Delete") ; ?></a>
                             </div>
                         </div>
                         <div class="col-sm-8 col-md-10">
                             <?php echo $addon->description; ?>
                             <div class="row">
                                 <div class="col-sm-12">
                                 <?php _e("Version: %s | By: %s ",$addon->version,$addon->author) ; ?>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-sm-12">

                         </div>                        
                     </div>


                 </div>
             </div>
             <?php
         }
     }else{
         ?>
         <h4 class="text-center text-bold text-danger"><?php _e("No addon installed right now") ; ?></h4>
         <?php
     } ?>
     </div><!-- /.box-body -->
    <?php /*?> <div class="box-footer clearfix no-border"></div><?php // */?>
</div>
<script type="text/javascript">
    function change_addon_status(rdata,element){
        if (typeof(swal) == "function") {
            swal(rdata.status ? "Success" : "Failed", rdata.msg, rdata.status ? "success" : "error");
            if (rdata.status) {
                setTimeout(ReloadSiteUrl, 1500);
            }
        } else {
            ShowGritterMsg(rdata.msg, rdata.status, rdata.is_sticky, rdata.title, rdata.icon);
        }
        if (rdata.status) {
            if(rdata.data=="A"){
                element.removeClass("btn-success").addClass("btn-warning").html("<?php _e("Deactive"); ?>");
            }else{
                element.removeClass("btn-warning").addClass("btn-success").html("<?php _e("Activate"); ?>");
            }

        }
    }
</script>