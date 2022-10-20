<div class="row" >
	<div class="col-md-8">
		<div class="panel panel-default app-panel-box">
			<div class="panel-heading"><?php _e("Knowledge"); ?></div>		  
		  <div class="panel-body p-0">		  
	      	<?php if(!empty($knowledges)){ echo get_knowledge_list($knowledges); }?>		      	
		  </div>
		</div>
	</div>
	<div class="col-md-4 md-p-l-0">
		<?php echo $this->getModule("right_module");?>		
	</div>
</div>
