<?php echo GetMsg();?>
<h3 class="text-center text-danger" ><?php _e("Authentication failed!. May be remote server rejected.");?></h3>
<h4 class="text-center text-success" ><?php _e("It will redirect to home page within");?> <span id="counter">10</span> <?php _e("second")?></h4>
<script type="text/javascript">
$(function(){
	setInterval(function(){
		var c=$("#counter").text();
		if(c==1){
			RedirectUrl("<?php echo base_url();?>");
		}else{
			$("#counter").text(c-1);
		}
	},1000);
});
</script>