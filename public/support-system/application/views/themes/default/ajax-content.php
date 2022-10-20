<?php ob_start();?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
            <?php echo !empty($_title)?$_title:""; ?>
            <?php if(!empty($_subTitle)){?>
            <small><?php echo $_subTitle;?></small>
            <?php }?>
          </h1>
          <?php if(!empty($_uiBreadCrumb) && is_array($_uiBreadCrumb)){?>
          <ol class="breadcrumb">
          	<?php foreach ($_uiBreadCrumb as $btitle=>$blink){?>
            <li>
            <?php if($blink!="#"){?>
           		 <a href="<?php echo $blink;?>"><i class="fa fa-dashboard"></i> <?php echo  $btitle;?></a>
           		 <?php }else{ echo $btitle;}?>
            </li>
            <?php }?>           
          </ol>
          <?php }?>
</section>

<!-- Main content -->
<section class="content">
	<!-- Main row -->	
            <?php 	echo $output; ?>         
        </section>
<!-- /.content -->
<?php  
$html=ob_get_clean();
$response=new stdClass();
$response->title= !empty($_title)?$_title:"";
$response->current_url=current_url();
$response->html=$html;
die(json_encode($response));
?>