<?php
    $value = data_get($entry, $column['name']);
$text = '';
if ($value == 0){
   $text = 'قيد المراجعة'; 
}elseif ($value == 1){
    $text = 'مقبول'; 
}elseif ($value == -1){
    $text = 'غير مكتمل'; 
}else{
    $text = 'مرفوض'; 
}
?>

<div class="">
    <?php echo e($text); ?>

</div>
<?php /**PATH /home/ytadawu1/wallet-main/resources/views/vendor/backpack/crud/columns/custom_status.blade.php ENDPATH**/ ?>