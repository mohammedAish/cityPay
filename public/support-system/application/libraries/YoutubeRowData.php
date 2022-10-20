<?php
class  YoutubeRowData{
    public $videoID;
    public $title;
    public $channelId;
    public $videoTime="";
    public $viewCount=0;
    public $likeCount=0;
    public $dislikeCount=0;
    public $favoriteCount=0;
    public $commentCount=0; 
    public $description;
    public $thumb_default;
    public $thumb_medium;
    public $thumb_high; 
    public $thumb_standard;
    public $published_date="";
    
    static function &getFromYTapiV3Data($data,$isWithDescription=false){
       //GPrint($data);
        $newobj=new self();
        if($data->kind=='youtube#video'){
            $newobj->videoID=$data->id;
            $newobj->title=$data->snippet->title;
            $newobj->channelId=$data->snippet->channelId;
            $newobj->published_date=date('Y-m-d',strtotime($data->snippet->publishedAt));
            if($isWithDescription){
                 $newobj->description=$data->snippet->description;
            }
            if(!empty($data->statistics)){
             $newobj->viewCount=$data->statistics->viewCount;
             $newobj->likeCount=$data->statistics->likeCount;
             $newobj->dislikeCount=$data->statistics->dislikeCount;
             $newobj->favoriteCount=$data->statistics->favoriteCount; 
             $newobj->commentCount=$data->statistics->commentCount;
            }
            $newobj->videoTime=self::getConvertedTime($data->contentDetails->duration);
            $newobj->thumb_default=$data->snippet->thumbnails->default->url;
            $newobj->thumb_medium=$data->snippet->thumbnails->medium->url;
            $newobj->thumb_high=$data->snippet->thumbnails->high->url;
            //GPrint($data->snippet->thumbnails->standard);
            if(!empty($data->snippet->thumbnails->standard->url)){
                $newobj->thumb_standard=$data->snippet->thumbnails->standard->url;
            }
        }
        return $newobj;
    }
    static function getConvertedTime($timestr){
        $returntimestr="";
        preg_match('/([0-9]+)H/i', $timestr,$hour);
        if(!empty($hour[1])){
           $hour=$hour[1].":";
        }else{
            $hour="";
        }
       
        preg_match('/([0-9]+)M/i', $timestr,$min);        
        if(!empty($min[1])){
            //$min.=":";
            $min=$min[1].":";
        }else{
            $min="";
        }
      
        preg_match('/([0-9]+)S/i', $timestr,$sec);        
        if(!empty($sec[1])){
            //$min.=":";
            $sec=$sec[1];
        }else{
            $sec="00";
        }
        
        return $hour.$min.$sec;
    }
    
}