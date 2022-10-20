<?php 
UnsetModule("open_ticket_button",APP_Output::MODULE_BEFORE_CONTENT);
$__ks_limit=8;
$__resentKnowledge=Mknowledge::FindAllBy("is_stickey", "Y",array("status"=>"P"),'entry_time');
if($__resentKnowledge>count($__resentKnowledge)){
    $__resentKnowledge=array_merge($__resentKnowledge,Mknowledge::FindAllBy("is_stickey", "N",array("status"=>"P"),'entry_time','DESC',($__ks_limit-count($__resentKnowledge))));
}

?>
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default app-panel-box">
			<div class="panel-heading"><?php _e("Latest Knowledge"); ?></div>		  
		  <div class="panel-body p-0">		  
	      	<?php if(!empty($__resentKnowledge)){echo get_knowledge_list($__resentKnowledge); }?>		      	
		  </div>
		</div>
	</div>
	<div class="col-md-4 md-p-l-0">
	
		<?php echo $this->getModule("right_module");?>		
		
	</div>
</div>