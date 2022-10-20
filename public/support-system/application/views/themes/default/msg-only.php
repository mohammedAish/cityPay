<div class="box box-primary">    	
         <div class="box-body grid-body">
        	<?php   echo GetMsg();?> 
        	<?php if(!empty($_msg_only)){?>
        	<h2 class="<?php echo !empty($__msg_class_name)?$__msg_class_name:"text-danger"?> text-center"><?php echo $_msg_only;?></h2>
        	<?php }?> 
         </div><!-- /.box-body -->
        <?php /*?> <div class="box-footer clearfix no-border"></div><?php // */?>         
 <?php if(!empty($__rdir_page)){?>       
        <h4 class="text-center text-success" ><?php _e("It will redirect within");?> <span id="counter"><?php  printf("%d",$__rdir_time);?></span> <?php _e("second(s)")?></h4>
        <script type="text/javascript">
        $(function(){
        	setInterval(function(){
        		var c=$("#counter").text();
        		if(c==1){
        			RedirectUrl("<?php echo $__rdir_page;?>");
        		}else{
        			$("#counter").text(c-1);
        		}
        	},1000);
        });
        </script>
<?php }?>
</div>
