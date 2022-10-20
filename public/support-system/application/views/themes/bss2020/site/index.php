<?php
   /*
    if(Mapp_setting::GetSettingsValue("is_state_kn","N")=="N") {
        echo $this->getModule("knowledge_statistic", ["__ks_limit" => 5]);
    }

*/
 
    ?>
<section id="article-container" class="article-container section-mt-h">
	
		<?php
			echo $this->getModule("pinned_knowledge");
			if(Mapp_setting::GetSettingsValue("is_state_kn","N")=="N") {
				echo $this->getModule("knowledge_statistic", ["__ks_limit" => 5]);
			}
			echo $this->getModule("category_knowledge");
		?>
	
</section>
