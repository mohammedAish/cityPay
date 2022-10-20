<?php echo GetMsg(); 
$paramlist=Memail_templates::getEmailParamList($mainobj->k_word);
echo form_open ( current_url(),array("id"=>"lformID","class"=>"form bv-form small form-vertical","method"=>"post"));?>
     <div class=" box box-primary">
         <div class="box-body grid-body">
          <?php /*   <div class="col-md-6">

                     <div class="form-group form-group-sm">
                         <label class="control-label" for="k_word"><?php _e("Keyword"); ?></label>
                         <div class="">
                             <select name="k_word" id="k_word" class="form-control" data-bv-notempty="true" data-bv-notempty-message="Keyword is required">
                                 <?php
                                     $keywords = array(""=>"---Select---") + Memail_templates::get_email_keywords();
                                     GetHTMLOptionByArray($keywords,$mainobj->GetPostValue("k_word"));
                                 ?>
                             </select>
                         </div>
                     </div>
             </div>  */ ?>


             <div class="<?php echo count($paramlist)>0?"col-md-8":"col-md-12";?> md-p-r-0">
                 <div class="form-group form-group-sm">
                     <label class="control-label" for="title"><?php _e("Title"); ?></label>
                     <div class="">
                         <input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" <?php echo  ! $isUpdate ? "name='title'" : ""; ?> <?php echo $isUpdate ? "disabled='disabled'" : ""; ?> placeholder="<?php _e("Title"); ?>" data-bv-notempty="true" data-bv-notempty-message="Title is required">
                     </div>
                 </div>
             

                 <div class="form-group form-group-sm">
                     <label class="control-label" for="subject"><?php _e("Subject"); ?></label>
                     <div class="">
                         <input type="text" maxlength="150"   value="<?php echo  $mainobj->GetPostValue("subject");?>" class="form-control" id="subject" name="subject" placeholder="<?php _e("Subject"); ?>" data-bv-notempty="true" data-bv-notempty-message="Subject is required">
                     </div>
                 </div>
                 <div class="form-group form-group-sm">
                     <label class="control-label" for="content"><?php _e("Content"); ?></label>
                     <div class="">
                         <textarea name="app_des_html" id="content" style="height: 180px;" class="form-control app-html-editor" data-bv-notempty="true" data-bv-notempty-message="Content is required"><?php echo  $mainobj->GetPostValue("content");?></textarea>
                     </div>
                 </div>

                 
                 <button type="submit" class="btn btn-success  btn-md" id="create_attribute"><i class="fa fa-save"></i> <?php echo $isUpdate ? "Update" : "Save" ?> </button>
                 <a href="<?php echo admin_url('email-templates')?>" class="btn pull-right btn-primary btn-md" id="template-list"> Go to template list </a>
             </div>
             <?php if(count($paramlist)>0){?>
             <div class="col-md-4 md-p-t-20 ">
             
                <div class="panel panel-primary">
                <div class="panel-heading text-bold"><?php _e("Email Field Details") ; ?></div>
                	<div class="panel-body p-0">
                	       <table class="table m-b-0 table-striped">
                 	<thead>
                 		<tr class="bg-info">
                 		    <th style="width: 20px;"></th>
                 			<th style="width: 120px;"><?php _e("Property") ; ?></th>
                 			<th><?php _e("Description") ; ?></th>
                 		</tr>
                 	</thead>
                 	<tbody>
                 	  <?php foreach ($paramlist as $key=>$des){?>
                 		<tr>
                 		    <th ><i title="Click to insert {{<?php echo $key;?>}} to edittor" style="font-size: 16px;" class="tooltip2 ap ap-insert app-ins-btn text-green text-bold" data-tooltip-position="left" data-tooltip-delay="2000" data-clipboard-text="{{<?php echo $key;?>}}"></i>  </th>
                 			<th>{{<?php echo $key;?>}} </th>
                 			<td><?php _e($des);?></td>
                 		</tr>
                 		<?php }?>                 		
                 	</tbody>
                 </table>
                	</div>
                </div>
             </div>
             <?php }?>
         </div>
     </div>
<?php echo form_close();?>

<script type="text/javascript">
$(function(){
	$(".app-ins-btn").on("click",function(e){
		e.preventDefault();
		var text=$(this).data("clipboard-text");
		if(text){
			insert_edittor_text("content",text);
		}
		
	});
})
</script>
