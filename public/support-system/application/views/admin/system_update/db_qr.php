<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Database Query</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <label class="control-label col-md-2" for="show_on">Query</label>
                    <textarea id="query" class="form-control" name="query" id="" cols="30" rows="10"></textarea>
                </div>
                <?php /* ?>
                <div class="form-group">

                    <label class="control-label " for="q_type">Type</label>
                    <div class="inline radio-inline">
                        <?php GetHTMLRadioByArray("Type", "q_type", "q_type", true, ['S' => "Select", "U" => "Update or Delete"], "S"); ?>

                    </div>
                </div>
                */ ?>
                <div class="form-group">

                    <button id="runqr" type="button" class="btn btn-success">Run</button>
                </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <h5>Result</h5>
                <hr>
                <div id="result" style="overflow: auto;">

                </div>
            </div>
            <!-- /.footer -->
        </div>
        <!-- /.box -->
    </div>
</div>


<div class="row"></div>

<script type="text/javascript">
jQuery( document ).ready(function( $ ) {
   $("#runqr").on("click",function(e) {
       e.preventDefault();
       var qr = $("#query").val();
       if (qr == "") {
           alert("Query is empty");
       }
       var qtype = $("input[name=q_type]").val();
       var request_data = {
           qr: btoa(qr)
       };

       $.ajax({
           url: "<?php echo admin_url("system-update/db-qr-response"); ?>",
           data: set_csrf_param(request_data),
           type: "POST",
           scriptCharset: "utf-8",
           dataType: "html",
           error:function(xhr,ajaxoption,thrownError){
              //console.log($(xhr.responseText).find("#container"));
              $("#result").html(thrownError);
           },
           beforeSend: function () {

           },
           success: function (rdata) {

               $("#result").html(rdata);
           },
           complete: function (jqXHR, textStatus) {

           }
       });
   });
});
</script>