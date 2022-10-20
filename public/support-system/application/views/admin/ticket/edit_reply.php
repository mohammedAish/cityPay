<div class="clearfix">
    <?php
    if (empty($mainobj)) {
        $mainobj = new Mticket_reply();
        AddError("Main object has not initialized in controller");
    }
    ?>

    <div class="form-group">
        <label class="control-label" for="reply_text"><?php _e("Reply Text"); ?></label>
        <textarea maxlength="" class="form-control app-html-editor"
                  id="reply_text" name="ticket_body"
                  placeholder="<?php _e("Reply Text"); ?>" data-bv-notempty="true"
                  data-bv-notempty-message="<?php _e("%s is required", __("Reply Text")); ?>"><?php echo $mainobj->GetPostValue("reply_text"); ?></textarea>

    </div>

</div>
<div class="row btn-group-md popup-footer text-right">
    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php _e("Update"); ?></button>
    <button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel"); ?>
    </button>
</div>
