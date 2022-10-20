<div class="row clearfix">
    <div class="col-md-12">
        <div class="panel panel-default app-panel-box">
          <div class="panel-heading"><?php _e("App User Details"); ?></div>
          <div class="panel-body p-0">
              <table class="table m-0">
                  <tr>
                      <th><?php _e("Name") ; ?></th>
                      <th>:</th>
                      <td><?php echo $mainobj->title; ?></td>
                  </tr>
                  <tr>
                      <th><?php _e("Email Address") ; ?></th>
                      <th>:</th>
                      <td><?php echo $mainobj->email; ?></td>
                  </tr>
                  <tr>
                      <th><?php _e("Role") ; ?></th>
                      <th>:</th>
                      <td><?php echo $role->title; ?></td>
                  </tr>
              </table>
          </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label label-required" for="pass"><?php _e("Set New Password"); ?></label>
            <input type="text" maxlength="32"   value="" class="form-control" id="pass"  name="pass"    placeholder="<?php _e("Password"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Password"));?>">
        </div>
    </div>
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php _e("Set Password");?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>