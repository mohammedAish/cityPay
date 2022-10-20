<?php if(isLiveEditMode() || getThemeAPIValue_2020('_faq_sec_is_active','N')!='Y'){
	$testimonials=Mtestimonial::getActiveTestimonials();
	$extraClass='';
	if(isLiveEditMode() || (getThemeAPIValue_2020('_feedb_sec_is_active','N')!='Y' && count($testimonials)>0)) {
		$extraClass='carosel-padding';
	}
    ?>
<section id="faq-section" class="faq-section <?php echo getThemeAPIValue_2020('_faq_sec_bg_img','N')=='Y'?' with-bg-img ':''; ?> section-mt  section-ptb-h <?php echo $extraClass; ?>">
 
	<div class="container">
		
		<div class="faq-heading  text-center position-relative">
			<?php echo getLiveEditButton('faq-section'); ?>
            <h2><?php echo getThemeAPIValue_2020('_faq_sec_title','How long will you take?') ?></h2>
			<?php
				$dtls=getThemeAPIValue_2020('_faq_sec_description','Find quick answers to frequent pre-sale questions asked by customers');
				if(startsWith($dtls,'<p')){
					echo $dtls;
				}else{?>
                    <p><?php echo $dtls; ?></p>
				<?php } ?>
		</div>
        <?php $faqs=Mfaq_category::getCategoriesWithQuestions('A');
        if(!empty($faqs) && count($faqs)>0){
	        $tab_pan='';
        ?>
		<div class="faq-tab-container">
			<ul class="nav nav-c mb-3 justify-content-center" role="tablist">
                <?php foreach ($faqs as $faq){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $tab_pan==''?' active ':''; ?>" id="faq-cat-<?php echo $faq->id; ?>-tab" data-toggle="pill" href="#faq-cat-<?php echo $faq->id; ?>" role="tab" aria-controls="faq-cat-<?php echo $faq->id; ?>" aria-selected="true"><?php echo $faq->name; ?></a>
                    </li>
                    <?php
                    ob_start();
                    ?>
                    <div class="tab-pane fade show animated fadeIn <?php echo $tab_pan==''?' active ':''; ?>" id="faq-cat-<?php echo $faq->id; ?>" role="tabpanel" aria-labelledby="faq-cat-<?php echo $faq->id; ?>-tab">
                        <div class="row">
                            <div class="col-sm-6">
                            <?php
	                            $leftItemCount=ceil(count($faq->questions)/2);
	                            $fiq=1;
                                foreach ($faq->questions as $question){?>
                                    <div class="faq-item">
                                        <a class="faq-qus collapsed" type="button" data-toggle="collapse" data-target="#qus_<?php echo $question->id; ?>"
                                           aria-expanded="false" aria-controls="qus_<?php echo $question->id; ?>">
                                           <?php echo $question->question; ?>
                                        </a>
                                        <div class="collapse faq-ans animated fadeIn" id="qus_<?php echo $question->id; ?>">
	                                        <p><?php echo $question->ans; ?></p>
                                        </div>
                                    </div>
                                <?php
                                    if($fiq%$leftItemCount==0){
                                        echo '</div><div class="col-sm-6">';
                                    }
	                                $fiq++;
                            } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $tab_pan.=ob_get_clean();
                } ?>
			</ul>
			<div class="tab-content">
				<?php echo $tab_pan; ?>
			</div>
		</div>
       <?php }else{
            if(isLiveEditMode()) {
	            ?>
                <h4 class="text-center text-danger animated pulse">No FAQ item found.<br/>Please add FAQ Items form admin panel first</h4>
	            <?php
            }
        } ?>
	</div>
</section>
<?php } ?>