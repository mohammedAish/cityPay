<!-- Content breadcrumb -->
<section class="content-breadcrumb">		
  <?php if(!empty($_uiBreadCrumb) && is_array($_uiBreadCrumb) && count($_uiBreadCrumb)>1){?>
  <ol class="breadcrumb m-b-10">
  	<?php foreach ($_uiBreadCrumb as $btitle=>$blink){  		
  	?>
    <li>
    <?php if($blink->url!="#"){?>
   		 <a href="<?php echo $blink->url;?>"><i class="<?php echo $blink->icon;?>"></i> <?php echo  $blink->title;?></a>
   		 <?php }else{
   		 	?>
   		 	<i class="<?php echo $blink->icon;?>"></i>
   		 	<?php 
   		 	echo $blink->title;
   		 }?>
    </li>
    <?php }?>   
  </ol>
  <?php }?>
</section>