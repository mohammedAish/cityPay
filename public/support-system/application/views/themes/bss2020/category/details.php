<section id="article-container" class="article-container">
<div class="row" >
	<div class="col-md-8 pr-sm-0">
		
		<?php 
	      	if(!empty($category)){?>
		      	<div class="card card-default app-panel-box">
				<div class="card-header">
			         <h1 class="m-0"><?php echo $category->title; ?></h1>
				</div>		  
			  <div class="card-body article-box m-0 p-0">
            	   <div class="art-list">
            	   <?php if(!empty($knowledges)){echo get_knowledge_list_artbox_2020($knowledges,false,true,false,false,false,false,'');}?>
            	   </div>
			  </div>
                </div>
                <?php if(!empty($childKnowledge) && count($childKnowledge)>0){
                    foreach ($childKnowledge as $cctg){
                        if(!empty($cctg->kn_list)){?>
                            <div class="card card-default app-panel-box">
                                <div class="card-header">
                                    <h1 class="m-0"><?php echo $cctg->title; ?></h1>
                                </div>
                                <div class="card-body article-box m-0 p-0">
                                    <div class="art-list">
                                        <?php echo get_knowledge_list_artbox_2020($cctg->kn_list,true,true,false,false,false,false,'');?>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                }?>
                <?php }else{?>
	      		<div class="alert alert-danger">Details not found</div>
	      		<?php }?>
	      		
	      
	</div>
	<div class="col-md-4 md-p-l-0">
		<?php echo $this->getModule("popular_knowledge",["ctg_title"=>$category->title,"cat_ids"=>$cat_ids]);?>		
	</div>
</div>
</section>