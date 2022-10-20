@php
    $value = data_get($entry, $column['name']);
$text = '';
if ($value == 0){
   $text = 'جديد'; 
}elseif ($value == 1){
    $text = 'قيد المراجعة'; 
}else{
    $text = 'تم الحل'; 
}
@endphp

<div class="">
    {{$text}}
</div>
