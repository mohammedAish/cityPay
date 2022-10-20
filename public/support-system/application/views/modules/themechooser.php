<?php 	if(!ISDEMOMODE){ return;}
add_css('css/app-demo.css',11);
$c_url=current_url(false);
$c_url .= (strpos($c_url,"?")===false?'?':'&');
$selectedTheme=getDemoSelectedTheme();
if(empty($selectedTheme)){
    $selectedTheme='bss2020';
}
?>
<div id="demo-theme-chooser" class="show">
	<div class="chooser-button"> Change Theme</div>
	<div class="theme-list">
		<ul>
            <li class="<?php echo $selectedTheme=='bss2020'?' active ':''; ?>">
                <a href="<?php echo $c_url; ?>_dtheme=bss2020">
                    <img src="<?php echo base_url('data/theme-demos/bss2020/img.jpg'); ?>" alt="Theme 2020">
                    <span class="demo-title">
						Theme 2020
					</span>
                </a>
            </li>
            <li class="<?php echo $selectedTheme=='theme1'?' active ':''; ?>">
                <a href="<?php echo $c_url; ?>_dtheme=theme1">
                    <img src="<?php echo base_url('data/theme-demos/theme1/img.jpg'); ?>" alt="Theme 1">
                    <span class="demo-title">
						Theme 1
					</span>
                </a>
            </li>
            <li class="<?php echo $selectedTheme=='theme2'?' active ':''; ?>">
                <a href="<?php echo $c_url; ?>_dtheme=theme2">
                    <img src="<?php echo base_url('data/theme-demos/theme2/img.jpg'); ?>" alt="Theme 2">
                    <span class="demo-title">
						Theme 2
					</span>
                </a>
            </li>

            <li class="<?php echo $selectedTheme=='theme3'?' active ':''; ?>">
                <a href="<?php echo $c_url; ?>_dtheme=theme3">
                    <img src="<?php echo base_url('data/theme-demos/theme3/img.jpg'); ?>" alt="Theme 3">
                    <span class="demo-title">
						Theme 3
					</span>
                </a>
            </li>
            <li class="<?php echo $selectedTheme=='theme4'?' active ':''; ?>">
                <a href="<?php echo $c_url; ?>_dtheme=theme4">
                    <img src="<?php echo base_url('data/theme-demos/theme4/img.jpg'); ?>" alt="Theme 4">
                    <span class="demo-title">
						Theme 4
					</span>
                </a>
            </li>
		</ul>
	</div>
</div>
<script type="text/javascript">
	jQuery( document ).ready(function( $ ) {
        $("#demo-theme-chooser").removeClass('show');
        $("#demo-theme-chooser .chooser-button").on("click", function () {
            $("#demo-theme-chooser").toggleClass('show');
        });
    });
</script>