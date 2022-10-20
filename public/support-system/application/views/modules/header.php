<?php $topbaricons=Mtopbar_icon::FindAllBy("status", "Y",[],"icon_order","ASC");?>
<div class="row">
	<div class="<?php echo get_app_container_type();?> ">
		<div class="row">
			<div class="col-md-<?php echo count($topbaricons)>0?"6":"12";?>  app-logo-container p-l-0">
				<a href="<?php echo base_url();?>">
                    <?php if(Mapp_setting::GetSettingsValue("isonly_logo","N")=="Y"){ ?>
                    <img class="app-logo-img" alt="Logo"
					src="<?php echo image_url('images/logo.png',true);?>">
                    <?php }
                    if(Mapp_setting::GetSettingsValue("is_show_app_ttl","Y")=="Y"){?>
				        <div class="app-title"><?php echo get_app_title();?></div>
				<?php }?>
				</a>
			</div>
			<?php if(count($topbaricons)>0){?>
			<div class="col-md-<?php echo count($topbaricons)>0?"6":"12";?>">
				<div class="app-header-features-container">
					<ul class="app-header-features">
						<?php foreach ($topbaricons as $tioc){?>
						<li><i class="fa <?php echo $tioc->icon_class;?>"></i>
							<div class="header-feature-caption pull-right">
								<h5 class="header-feature-title"><?php echo $tioc->title;?></h5>
								<p class="header-feature-sub-title"><?php echo $tioc->sub_title;?></p>
							</div>
						</li>
						<?php }?>
					</ul>
				</div>
			</div>
			<?php }?>	
		</div>
	</div>
</div>