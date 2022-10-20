<div class="<?php echo get_app_container_type();?>">
    <section id="still-need-section" class="still-need-section d-box-shadow">
	    <?php echo getLiveEditButton('need-help') ?>
        <div class="row">
            <div class="col-sm text-center">
                <h2><?php echo getThemeAPIValue_2020('_needhlp_title','Still Need Support?'); ?></h2>
                <p><?php echo getThemeAPIValue_2020('_needhlp_subtitle','We normally response within 24 hours'); ?></p>
            </div>
            <div class="col-sm text-center pt-3">
	            <?php echo get_open_ticket_link_2020("btn btn-theme  ");?></h2>
            </div>
        </div>

    </section>
</div>