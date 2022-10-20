@php
    $value = data_get($entry, $column['name']);
$text = '';
if ($value == 0){
   $text = 'قيد المراجعة'; 
}elseif ($value == 1){
    $text = 'مكتمل'; 
}elseif ($value == -1){
    $text = 'غير مكتمل'; 
}else{
    $text = 'مرفوض'; 
}
@endphp

<div class="">
    {{$text}}
</div>
