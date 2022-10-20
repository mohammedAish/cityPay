<?php
    $value = data_get($entry, $column['name']);
$text = '';
if ($value == 0){
   $text = 'جديد'; 
}elseif ($value == 1){
    $text = 'قيد المراجعة'; 
}else{
    $text = 'تم الحل'; 
}
?>

<div class="">
    <?php echo e($text); ?>

</div>
<?php /**PATH /home/ytadawu1/wallet-main/resources/views/vendor/backpack/crud/columns/custom_status_error.blade.php ENDPATH**/ ?>