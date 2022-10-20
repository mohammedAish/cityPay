<div class="w-100">
    <div class="clearfix form pb-3">
	    <?php
		    if(empty($mainobj)){
			    $mainobj=new Msite_user();
			    AddError("Main object has not initialized in controller");
		    }
		    if(!empty($mainobj->photo_url)){
			    $currentPhoto=$mainobj->photo_url;
		    }else{
			    $currentPhoto=base_url("images/default-user-image.png");
		    }
		    //$userdata=GetUserData();
		    //GPrint($userdata);
	    ?>
        <div class="form-group text-center">
            <img class="app-image-input img-thumbnail" data-name="user_photo" src="<?php echo $currentPhoto;?>" style="max-height: 200px; max-width: 250px;"/>
            <div class="form-group-help-block"><?php _e("Click on the Image to change. Best size is 250px x 200px");?></div>
        </div>
    </div>
    <div class="btn-group-md popup-footer ">
        <div class="clearfix">

            <div class="float-sm-right text-center text-sm-right ">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo __("Save")?></button>
                <button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
            </div>
        </div>
    </div>
</div>
