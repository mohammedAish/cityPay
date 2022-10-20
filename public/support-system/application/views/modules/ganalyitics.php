<?php
if(Mapp_setting_api::GetSettingsValue("gana","is_ga_active","N")=="Y") {
    $gtagid = Mapp_setting_api::GetSettingsValue("gana", "gtag_id", "");
    if (!empty($gtagid)) {
        ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $gtagid; ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', '<?php echo $gtagid; ?>');
        </script>
        <?php
    }
}

