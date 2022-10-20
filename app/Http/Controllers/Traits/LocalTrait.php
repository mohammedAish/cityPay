<?php


namespace App\Http\Controllers\Traits;


trait LocalTrait
{

    function get_local(){
        $local               = config('app.locale');
        $this->current_local = $local;

        return $local;
    }

    function get_direction(){
        $dir = config('backpack.base.html_direction','rtl');;
        $this->current_direction = $dir;

        return $dir;
    }
}
