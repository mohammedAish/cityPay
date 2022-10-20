
<div class="text-center">
    <h2 class="m-b-30"><?php _e("Login Required, Please login") ; ?></h2>
	<?php
		$rr=GetValue("_ru","");
		if(empty($rr)){
			$rr=current_url();
		}
	?>
    <a class=" btn btn-orange btn-theme btn-lg popupformWR" id="app-login" href="<?php echo get_redirect_login_url($rr);?>" data-effect="mfp-move-from-top">
        <span><i class="fa fa-lock"></i></span> <?php _e("Login");?>
    </a>

    <div>
        <h3 class="m-30"><?php _e("OR") ; ?></h3>
    </div>
    <a class="popupformWR btn btn-info  btn-lg " data-effect="mfp-move-from-top" href="<?php echo get_redirect_register_url($rr);?>">
        <span><i class="fa fa-wpforms"></i> <?php _e("Register") ; ?>
    </a>
</div>
<script type="text/javascript">
$(function(){
	var obj=$('<a data-effect="mfp-move-from-top">').attr("href","<?php echo base_url("user/login");?>?rurl=<?php echo urlencode(current_url());?>");
	obj.magnificPopup({
        type: 'ajax',
        preloader: true,
        removalDelay: 500,
        closeBtnInside: true,
        overflowY: 'auto',
        closeOnBgClick: false,
        fixedBgPos: false,
        zoom: { enabled: false },
        tLoading: '<i class="fa fa-circle-o faa-burst animated"></i> &nbsp;Loading..',
        callbacks: {
            beforeOpen: function() { this.st.mainClass = this.st.el.attr('data-effect'); },
            open: function() {},
            close: OnClosed,
            updateStatus: function(data) {
                if (data.status === 'ready') {
                    _popupajaxLoadComplted();
                }
            }
        }
    }).click();
});
</script>