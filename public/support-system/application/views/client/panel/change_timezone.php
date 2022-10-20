<div class="row clearfix ">
    <?php
    if(empty($mainobj)){
        $mainobj=new Msite_user();
        AddError("mainobj is not initilised");
    }
    ?>
    <div class="col-md-12">
        <div class="form-group no-feedback">

            <select    class="form-control select2" id="tzone"  name="tzone"    data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Timezone"));?>">
                <?php
                $tzone_selected= $mainobj->GetPostValue("tzone","");
                GetHTMLOptionByArray($mainobj->GetPropertyOptions("tzone",true),$tzone_selected);
                ?>
            </select>
            <?php /*<span class="form-group-help-block"><?php _e("tzone");?></span>	*/?>

        </div>
    </div>
</div>
<div class="row btn-group-md popup-footer text-right">
    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo __("Update");?></button>
    <button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>