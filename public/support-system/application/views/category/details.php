<div class="row" >
	<div class="col-md-8">
		
		<?php 
	      	if(!empty($category)){?>
		      	<div class="panel panel-default app-panel-box">
				<div class="panel-heading">
			         <h1 class="m-0"><?php echo $category->title; ?></h1>
				
				</div>		  
			  <div class="panel-body art-box m-0 p-t-0 p-b-0" style="min-height: 400px;">
            	   <div class="art-box-content"> 
            	   <?php if(!empty($knowledges)){echo get_knowledge_list_artbox($knowledges,false);}?>	
            	   </div> 
            	   <div class="row">
            	   		<?php if(!empty($childKnowledge) && count($childKnowledge)>0){
	      		    foreach ($childKnowledge as $cctg){
	      		        if(!empty($cctg->kn_list)){
	      		?>
	      		
	      		<div class="col-md-6 art-box">
                <h3 class="art-box-title">
                	      <?php echo $cctg->title; ?>
                	   </h3>
                	   <div class="art-box-content"> 
                	   <?php echo get_knowledge_list_artbox($cctg->kn_list);?>	
                	   </div>
                	</div>
	      			 <?php }
	      		    }
	      		}?> 
	      		</div>              	
			  </div>			  
			</div>
	      		<?php }else{?>	
	      		<div class="alert alert-danger">Details not found</div>
	      		<?php }?>
	      		
	      
	</div>
	<div class="col-md-4 md-p-l-0">
		<?php echo $this->getModule("popular_knowledge",["ctg_title"=>$category->title,"cat_ids"=>$cat_ids]);?>		
	</div>
</div>