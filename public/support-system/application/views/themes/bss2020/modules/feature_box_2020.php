<?php if(isLiveEditMode() || getThemeAPIValue_2020('_fbox_is_hide','N')!='Y'){ ?>
<section id="feature-box-container" class="feature-box-container section-mt">
	<?php echo getLiveEditButton('feature-box'); ?>
	<div class="container">
		<div class="row">
			
			<div class="col-sm">
                <div class="feature-box d-box-shadow">
                    <div class="f-icon">
                        <i class="<?php echo getThemeAPIValue_2020("_fbox_icon_1","fas fa-star"); ?>"></i>
                    </div>
                    <div class="f-title"><?php echo getThemeAPIValue_2020("_fbox_title_1","Documentation"); ?></div>
                    <div class="f-content"><?php echo getThemeAPIValue_2020("_fbox_dtls_1","Documentation"); ?></div>
                    <div class="f-btn">
						<?php $link=getThemeAPIValue_2020("_fbox_link_1","");
							if(!empty($link)){
								?>
                                <a href="<?php echo $link; ?>"><i class="fa fa-long-arrow-alt-right"></i></a>
							<?php } ?>
                    </div>
                </div>
			
			
			</div>
			<div class="col-sm ">
				<div class="feature-box d-box-shadow">
					<div class="f-icon">
						<i class="<?php echo getThemeAPIValue_2020("_fbox_icon_2","fas fa-star"); ?>"></i>
					</div>
					<div class="f-title"><?php echo getThemeAPIValue_2020("_fbox_title_2","Documentation"); ?></div>
					<div class="f-content"><?php echo getThemeAPIValue_2020("_fbox_dtls_2","Documentation"); ?></div>
					<div class="f-btn">
                        <?php $link=getThemeAPIValue_2020("_fbox_link_2","");
                        if(!empty($link)){
                        ?>
						<a href="<?php echo $link; ?>"><i class="fa fa-long-arrow-alt-right"></i></a>
                        <?php } ?>
					</div>
				</div>
			</div>
			<div class="col-sm ">
                <div class="feature-box d-box-shadow">
                    <div class="f-icon">
                        <i class="<?php echo getThemeAPIValue_2020("_fbox_icon_3","fas fa-star"); ?>"></i>
                    </div>
                    <div class="f-title"><?php echo getThemeAPIValue_2020("_fbox_title_3","Documentation"); ?></div>
                    <div class="f-content"><?php echo getThemeAPIValue_2020("_fbox_dtls_3","Documentation"); ?></div>
                    <div class="f-btn">
						<?php $link=getThemeAPIValue_2020("_fbox_link_3","");
							if(!empty($link)){
								?>
                                <a href="<?php echo $link; ?>"><i class="fa fa-long-arrow-alt-right"></i></a>
							<?php } ?>
                    </div>
                </div>
			</div>
		
		</div>
	</div>
</section>
<?php } ?>