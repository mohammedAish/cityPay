<div class="clearfix form-horizontal">
<?php     
    if(empty($mainobj)){
        $mainobj=new Msite_user();
        AddError("Main object has not initialized in controller");
    }
    $except=array('pass');
    $disabled=array();
    /*if($isUpdate){
    	$except[]="firstName,lastName,username,email,password,is_verified_email,gender,phone,address,region,city,zip,country,dob,profile_url,photo_url,age,login_type,join_date,tzone";
    	$disabled[]="firstName,lastName,username,email,password,is_verified_email,gender,phone,address,region,city,zip,country,dob,profile_url,photo_url,age,login_type,join_date,tzone";
    }*/
    $mainobj->GetAddForm2(3,9,NULL,$except,$disabled,$custom_fields);
   
?>	  
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $isUpdate?__("Update"):__("Save")?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
