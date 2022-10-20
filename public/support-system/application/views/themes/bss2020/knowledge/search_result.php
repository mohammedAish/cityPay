<div class="row" >
	<div class="col-md-8">
		<div class="card card-default app-panel-box">
			<div class="card-header"><?php _e("Knowledge"); ?></div>
		  <div class="card-body p-0">
	      	<?php if(!empty($knowledges)){ echo get_knowledge_list_2020($knowledges); }?>
		  </div>
		</div>
	</div>
	<div class="col-md-4 md-p-l-0">
		<?php echo $this->getModule("right_module");?>		
	</div>
</div>
