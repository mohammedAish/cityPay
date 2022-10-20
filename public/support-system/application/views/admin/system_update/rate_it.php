<?php $userdata=GetAppBaseUserData(); ?>
<div class="clearfix form-horizontal text-center">
    <h3 class="p-t-20">Dear <?php echo $userdata->title; ?>, If you love our app, would you please take a moment to rate it.</h3>
    <h3 class="p-t-20">
        <i class="fa fa-star text-green"></i>
        <i class="fa fa-star text-green"></i>
        <i class="fa fa-star text-green"></i>
        <i class="fa fa-star text-green"></i>
        <i class="fa fa-star text-green"></i>
    </h3>
    <h3 class="p-t-20">This rating motivate us to add more features.</h3>
    <div class="row btn-group-md p-b-20">
        <button type="submit" class="btn btn-success"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> Rate it</button>
        <button id="remained-me" type="button" class= btn  btn-info"><i class="fa fa-clock-o"></i> Remained Me Later</button>
        <a id="already-rated" href="<?php echo admin_url("system-update/thank-you") ?>"  data-effect= "mfp-move-from-top" class="popupform btn  btn-default"><i class="fa fa-check-circle-o"></i> I already rate it</a>
    </div>

</div>
<script type="text/javascript">
    $(function(){
        $("#remained-me").on("click",function(e){
            e.preventDefault();
            try {
                $.magnificPopup.instance.close();
            } catch (e) {}

            $.get( "<?php echo admin_url("system-update/rate-status/r"); ?>");

        });
        $("#already-rated").on("click",function(e){
            $.get( "<?php echo admin_url("system-update/rate-status/a"); ?>");
        });

    });
</script>
