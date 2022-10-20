<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          <?php if(!empty($__icon_class)){?>
          <i class="<?php echo $__icon_class;?>"></i> 
          <?php }?>
            <?php echo !empty($_title)?$_title:""; ?>
            <?php if(!empty($_subTitle)){?>
            <small><?php echo $_subTitle;?></small>
            <?php }?>
          </h1>          
        </section>