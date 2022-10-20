<?php
if(isLiveEditMode() || getThemeAPIValue_2020('_feedb_sec_is_active','N')!='Y'){
    $tst=new Mtestimonial();
	$testimonials=Mtestimonial::getActiveTestimonials();
    if(isLiveEditMode() && count($testimonials)==0){
        $testimonials[]= Mtestimonial::getItem("Live Mode Dummy Name 1","Dummy Desifnation 1","This is dummy testimonial for live mode please add testimonial from admin panel. You will get it in admin panel menu named Testimonial. You can add multiple item. You can also add image of users.");
        $testimonials[]= Mtestimonial::getItem("Live Mode Dummy Name 2","Dummy Desifnation 2",'This is dummy testimonial for live mode please add testimonial from admin panel. You will get it in admin panel menu named Testimonial. You can add multiple item. You can also add image of users.');
       
    }

if(!isLiveEditMode() && getThemeAPIValue_2020('_faq_sec_is_active','N')=='Y'){ ?>
       <section id="faq-section" class="faq-section section-mt  section-ptb-h carosel-padding"></section>
<?php }
if(isLiveEditMode() || !empty($testimonials)) {
	?>
    <div class="container section-pb">
        <section id="feedback-carousel" class="feedback-carousel d-box-shadow">
			<?php echo getLiveEditButton( 'feedback-section' ); ?>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
					<?php
						$isActive = true;
						foreach ( $testimonials as $testimonial ) {
							?>
                            <div class="carousel-item <?php echo $isActive ? 'active' : ''; ?>">
                                <div class="text-center feed-img-container">
									<?php
										$file = Mtestimonial::get_user_testimonial_path( $testimonial->id );
										if ( file_exists( $file ) ) {
											?>
                                            <img src="<?php echo Mtestimonial::get_user_image_url( $testimonial->id ); ?>"
                                                 alt=" <?php echo $testimonial->name; ?> Image"
                                                 class="feed-img rounded-circle">
											<?php
										} else {
											?>
                                            <i class="fa fa-quote-right feed-img"></i>
											<?php
										}
									?>

                                </div>
                                <p><?php echo $testimonial->testimonial; ?></p>
                                <div class="feed-author">
                                    <div class="feed-autor-name">
										<?php echo $testimonial->name; ?>
                                    </div>
                                    <div class="feed-autor-designation">
										<?php echo $testimonial->designation; ?>
                                    </div>
                                </div>
                            </div>
							<?php
							$isActive = false;
						} ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <i class="fa fa-angle-left"></i>


                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">

                    <i class="fa fa-angle-right"></i>
                </a>
            </div>

        </section>
    </div>
	<?php
}
} ?>