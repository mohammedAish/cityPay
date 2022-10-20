<?php
	$obj=new Mnotice();
	$obj->msg_for("in ('B','S')",true);
	$obj->start_date("<='".date('Y-m-d')."'",true);
	$obj->end_date(">'".date('Y-m-d')."'",true);
	$obj->status('A');
	$items=$obj->SelectAll("","msg_type","ASC");
	if(is_array($items) && count($items)>0){
?>
<section id="app-notification" class="app-notification">
    <?php  echo getLiveEditButton('edit-notification'); ?>
    <div id="noti-content">
        <?php foreach ($items as $item){ ?>
        <div class="app-noti-item alert"  role="alert">
            <h4 class="alert-heading"><?php echo $item->title; ?></h4>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
	        <?php echo $item->msg; ?>
        </div>
      <?php } ?>

        
    </div>
</section>

<script type="text/javascript">
    jQuery( document ).ready(function( $ ) {
        setTimeout(function () {
           var content_height= $("#app-notification > #noti-content").height();
            $("#app-notification").height(0);
            $("#app-notification > #noti-content").css('margin-top','0px');
            $("#app-notification").height(content_height+5);
            setTimeout(function () {
                $("#app-notification").height('auto');
            },1000)
        },2000);
    });
</script>
<?php } ?>