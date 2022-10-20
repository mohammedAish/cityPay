<?php $userdata=GetAppBaseUserData();
$ratinglink=AddOnManager::DoFilter("rate-it-link",'');
?>
<div class="clearfix form-horizontal text-center">
    <h3 class="p-t-20">Redirecting to the rating page. Please wait</h3>
</div>

<script type="text/javascript">
    RedirectUrl("<?php echo $ratinglink; ?>");
</script>