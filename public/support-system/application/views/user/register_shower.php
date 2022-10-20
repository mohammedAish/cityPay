<script type="text/javascript">
$(function(){
	var obj=$('<a data-effect="mfp-move-from-top">').attr("href","<?php echo base_url("user/register");?>?rurl=<?php echo urlencode(current_url());?>");
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