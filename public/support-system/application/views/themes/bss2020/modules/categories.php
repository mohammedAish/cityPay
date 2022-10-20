<div class="card card-default app-panel-box mb-3">
			<div class="card-header"><?php _e("Categories"); ?></div>
		  <div class="card-body p-0">
		  <ul class="kn-list ctg-list">
		      	<?php 
		      	$_ctgs=Mcategory::getTicketActiveCategories(5,0,"DESC",true);
		      	if(count($_ctgs)>0){
		      	foreach ($_ctgs as $_ctg){
		      	    ?>
		      	    
		      	    <li class=" p-10  ">
		      	    <h5 class="m-0">    			
		      	    <a href="<?php echo site_url("category/details/{$_ctg->cat_id}/{$_ctg->title}");?>">
		      	     <i class="fa fa-angle-double-right"></i> <?php echo $_ctg->title;?>
		      	     <span class="float-right">( <i class="fa fa-file-text-o"></i> <?php echo _n(str_pad($_ctg->total, 2,'0',STR_PAD_LEFT));?> )</span>
		      	    </a>    				
		      	    </h5>		      	    
		      	    </li>
		      	   
		      	    <?php 
		      	}
		      	}else{
		      	    ?>
		      	    
		      	    <li class=" p-10  text-center">
		      	    <?php _e("No category found") ; ?>
		      	    
		      	    </li>
		      	    <?php 
		      	}
		      	?>
		       </ul>	
		  </div>
		</div>