<?php if(empty($cboxWidth)){$cboxWidth=325;}
	$cboxWidth=strtolower($cboxWidth)=="auto"?"auto":$cboxWidth."px";
	$col_class=!empty($__col_class)?$__col_class:"col-md-6";
	if(empty($method)){$method="post";}
	if(!isset($isPopupFormMultiPath)){$isPopupFormMultiPath=false;}
	if(!isset($formtype)){$formtype="";}
	$col_class=str_replace('col-md','col-sm',$col_class);
?>
<div id="popup-container" class="mfp-with-anim mfp-dialog  <?php echo ($col_class);?> clearfix pt-2">
	<?php if(!empty($__icon_class)){?><div class="dialog-icon "> <i class="fa <?php echo ($__icon_class);?>"></i></div><?php }?>
    <div class="apbd-lb-container" >
        <div id="LightBoxBody" class="lightbox-body">
			<?php if(!empty($_title)){?>
                <div class="apd-lg-title">
                    <h3 class="p-0"><?php echo $_title;?>
						<?php $bkbtn=GetValue("bbtn","");
							if(!empty($bkbtn)){
								?>
                                <a href="<?php echo $bkbtn;?>" data-effect="mfp-move-from-top" class="popupformWR back-btn btn btn-sm btn-theme-light float-right"> <i class="fa fa-angle-double-left"></i> <?php _e("Back") ; ?></a>
							<?php }?>
                    </h3>
					<?php if(!empty($_subTitle)){?>
                        <h5 class="p-0 mt-3"><?php echo $_subTitle;?></h5>
					<?php }	?>
                    <hr class="mt-3" />
                </div>
			<?php }?>
            <div class="container-fluid">
                <div class="w-100">
					<?php echo GetMsg();?>
                </div>
	            <?php echo !empty($_msg_only)?$_msg_only:""; ?>
             
            </div>
            <div class="popup-msg-footer">
                <div class="btn-group-md popup-footer w-100">
                    <div class="clearfix">

                        <div class="float-sm-right text-center text-sm-right ">
                          
                            <button type="button" class="close-pop-up btn btn-sm  btn-danger"><i class="fa fa-times"></i> <?php _e("Close"); ?></button>
                        </div>
                        <div class="float-sm-left text-center text-sm-left">

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script type="text/javascript">
		<?php if(IsPostBack){?>
        window.MyAjaxChange=true;
		<?php }?>
        window.IsValid=true;
		<?php if(!empty($__close_popup_disable)){?>
        $(function(){
            $(".mfp-close").remove();
        });
		<?php }?>
    </script>
</div>