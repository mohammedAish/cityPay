<?php if(isLiveEditMode() || getThemeAPIValue_2020('_b_knw_is_active','N')!='Y'){ ?>
<section id="before-article" class="section-mt text-center">
	<?php echo getLiveEditButton('before-article'); ?>
	<div class="container">
		<h2><?php echo getThemeAPIValue_2020('_b_knw_title','Check out our guide categories') ?></h2>
        <?php
        $dtls=getThemeAPIValue_2020('_b_knw_description','Write into the box to search & get result immediately.');
        if(startsWith($dtls,'<p')){
            echo $dtls;
        }else{?>
		<p><?php echo $dtls; ?></p>
    <?php } ?>
	</div>
</section>
<?php } ?>