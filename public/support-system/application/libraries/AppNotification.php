<?php

class AppNotification{
	/**
	 * @var multitype:ANotificaiton 
	 */
	private static $notifications=array();
	/**
	 * @var multitype:AMessage
	 */
	private static $messages=array();
	/**
	 * @var multitype:ATask
	 */
	private static $tasks=array();
	private static $unread_ticket_noti=[];
	
	public static function addNotification($id,$title,$time,$text,$sender_title,$sender_img,$href,$is_popup_link=false,$isViewed=false,$icon="fa fa-bell-o"){
		$obj=new ANotificaiton();
		$obj->id=$id;
		$obj->title=$title;
		$obj->addTime=$time;
		$obj->icon=$icon;
		$obj->text=$text;
		$obj->href=$href;
		$obj->message_from=$sender_title;
		$obj->message_from_img=$sender_img;
		$obj->isViewed=$isViewed;
		$obj->isPopup=$is_popup_link;
		self::$notifications[]=$obj;		
	}	
	public static function addMessage($id,$title,$time,$text,$href,$msg_user_title,$msg_user_img,$is_popup_link=false,$isViewed=false){
		$obj=new AMessage();
		$obj->id=$id;
		$obj->title=$title;
		$obj->addTime=$time;
		$obj->message_from=$msg_user_title;
		$obj->message_from_img=$msg_user_img;
		$obj->text=$text;
		$obj->href=$href;
		$obj->isViewed=$isViewed;
		$obj->isPopup=$is_popup_link;
		self::$messages[]=$obj;	
	}
	
	public static function addTaskold($id,$title,$time,$totalTask,$completed_task,$href,$is_popup_link=false,$isViewed=false){
		$obj=new ATask();
		$obj->id=$id;
		$obj->title=$title;
		$obj->addTime=$time;	
		$obj->totalTask=$totalTask;
		$obj->completedTask=$completed_task;
		$obj->href=$href;
		$obj->isViewed=$isViewed;
		$obj->isPopup=$is_popup_link;
		self::$tasks[]=$obj;	
	}
	public static function addTask($id,$title,$time,$text,$href,$is_popup_link=false,$isViewed=false,$icon="fa fa-bell-o"){
		$obj=new ANotificaiton();
		$obj->id=$id;
		$obj->title=$title;
		$obj->addTime=$time;
		$obj->icon=$icon;
		$obj->text=$text;
		$obj->href=$href;
		$obj->isViewed=$isViewed;
		$obj->isPopup=$is_popup_link;
		self::$tasks[]=$obj;
	}
	
	public static function totalNotifications(){
		return count(self::$notifications);
	}
	public static function totalMessages(){
		return count(self::$messages);
	}
	public static function totalTasks(){
		return count(self::$tasks);
	}
	
	/**
	 * @return multitype:ANotificaiton
	 */
	public static function getAllNotifications(){
		return self::$notifications;
	} 
	
	/**
	 * @return multitype:AMessage
	 */
	public static function getAllMessages(){
		return self::$messages;
	}
	
	/**
	 * @return multitype:ATask
	 */
	public static function getAllTasks(){
		return self::$tasks;
	}
	public static function getAllTicketUnknownNotification(){
		return self::$unread_ticket_noti;
    }
	public static function CheckTicketNotification($ticket_id) {
		if(!empty(self::$unread_ticket_noti[$ticket_id]) && is_array(self::$unread_ticket_noti[$ticket_id])){
		    foreach (self::$unread_ticket_noti[$ticket_id] as $noti_id){
			    Mapp_notificaiton::ViewedByID($noti_id);
            }
        }
	}
	public static function SetData()
    {
        $adminData = GetAdminData();
        if ($adminData) {
           
            $noti = new Mapp_notificaiton();
            $noti->user_id($adminData->id);
            $noti->status("in ('A','V')",true);
            $notifications = $noti->SelectAll('', 'status');
            if (!empty($notifications)) {                
                foreach ($notifications as $ndata) {
                    // $ndata=new Mapp_notificaiton();
                    if($ndata->status=="A" && !empty($ndata->extra_param)){
	                    $extraParam=json_decode(base64_decode($ndata->extra_param));
	                    if(!empty($extraParam->id)){
	                        if(!isset(self::$unread_ticket_noti[$extraParam->id])){
		                        self::$unread_ticket_noti[$extraParam->id]=[];
	                        }
		                    self::$unread_ticket_noti[$extraParam->id][]=$ndata->id;
                        }
                    }
                    self::addNotification($ndata->id, $ndata->title, $ndata->entry_time, $ndata->msg, "", "", $ndata->entry_link, $ndata->is_popup_link == "Y", $ndata->status == "V");
                }
            }
        }
    }
	public static function getNotificationHTML(){
	    $adminData = GetAdminData();
	    if (!$adminData) {
	         
	        return "";
	    }
	    $noti = new Mapp_notificaiton();
	    $noti->user_id($adminData->id);
	    $noti->entry_type("N");
	    $noti->status('A');
	    $count=$noti->CountALL();
	    $noti->status("in ('A','V')",true);	 
	    $notifications = $noti->SelectAll('', 'id',"DESC","10");
	    ob_start();  
		?>
<a href="#" class="dropdown-toggle"  data-toggle="dropdown"> <i	class="fa fa-bell-o"></i>
<?php if($count>0){?>
      <span class="count-label label label-warning"><?php echo $count;?></span>
      <?php }?>
    </a>
<ul class="dropdown-menu ">
                 <?php if (!empty($notifications)) {?>
                 
	<li class="msg-dp-heigt">
		<!-- inner menu: contains the actual data -->
		<ul class="menu msg-dp-heigt" style="width:auto !important; max-height: 400px;">
                     <?php foreach ($notifications as $ndata) {
	             //$ndata=new Mapp_notificaiton();	                      
		                     	$ndata->entry_link=!empty($ndata->entry_link)?admin_url('notification/show/'.$ndata->id):"javascript:void(0);";
		                     ?>
		 <li class=" <?php echo $ndata->status=="A"?"unseen":"seen"?> ">
				<!-- start message --> <a <?php if($ndata->is_popup_link=="Y"){?>
				data-effect="mfp-move-from-top" class="popupformWR app-noti-click" <?php }else{?> class="app-noti-click" <?php } ?>href="<?php echo $ndata->entry_link;?>">					
					<h4><?php echo $ndata->title.(($ndata->n_counter>1)?"(".$ndata->n_counter.")":"");?>
		              <small><i class="fa fa-clock-o"></i> <?php echo app_time_elapsed_string($ndata->entry_time);?></small>
					</h4>
					<p> <?php echo $ndata->msg;?></p>
			</a>
			</li>
			<!-- end message -->
		                      <?php }?>                         
                    </ul>
	</li>
                  <li class="footer"><a href="<?php echo admin_url('notification/show-list/N');?>"><?php _e("View all") ; ?></a></li>
                  <?php }else{?>
                  <li class="header"><?php _e("You have no notifications right now") ; ?></li>
                  <?php }?>
                </ul>
<?php 
		$html=ob_get_clean();
		$html=str_replace(array("\r", "\n"), '', $html);
		return $html;
	}
	public static function getNotificationHTMLNewAdmin(){
		$adminData = GetAdminData();
		if (!$adminData) {
			
			return "";
		}
		$noti = new Mapp_notificaiton();
		$noti->user_id($adminData->id);
		$noti->entry_type("N");
		$noti->status('A');
		$count=$noti->CountALL();
		$noti->status("in ('A','V')",true);
		$notifications = $noti->SelectAll('', 'id',"DESC","10");
		ob_start();
		?>

        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell-o"></i>
		    <?php if($count>0){?>
            <span class="badge bg-green"><?php echo $count;?></span>
            <?php } ?>
        </a>
        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
		<?php if (!empty($notifications)) {
			foreach ( $notifications as $ndata ) {
				$ndata->entry_link=!empty($ndata->entry_link)?admin_url('notification/show/'.$ndata->id):"javascript:void(0);";
				?>
                <li class=" <?php echo $ndata->status=="A"?"unseen":"seen"?> ">
                    <a <?php if($ndata->is_popup_link=="Y"){?> data-effect="mfp-move-from-top" class="popupformWR app-noti-click" <?php }else{?> class="app-noti-click" <?php } ?>href="<?php echo $ndata->entry_link;?>" >
                        
                        <span>
                                          <span><?php echo $ndata->title.(($ndata->n_counter>1)?"(".$ndata->n_counter.")":"");?></span>
                                          <span class="time"><?php echo app_time_elapsed_string($ndata->entry_time);?></span>
                                        </span>
                        <span class="message">
                                          <?php echo $ndata->msg;?>
                                        </span>
                    </a>
                </li>
			<?php }
			?>
            <li>
                <div class="text-center">
                    <a href="<?php echo admin_url('notification/show-list/N');?>"> <strong><?php _e("View all") ; ?> </strong> <i class="fa fa-angle-right"></i></a>
                    
                </div>
            </li>
			<?php
		}else{?>
            <li>
                <div class="text-center">
	                <?php _e("You have no notifications right now") ; ?>

                </div>
            </li>
            <?php } ?>
        </ul>
		<?php
		$html=ob_get_clean();
		$html=str_replace(array("\r", "\n"), '', $html);
		return $html;
	}
	public static function getMessageHTMLNewAdmin(){
		$adminData = GetAdminData();
		if (!$adminData) {
			
			return "";
		}
		$noti = new Mapp_notificaiton();
		$noti->user_id($adminData->id);
		$noti->entry_type("M");
		$noti->status('A');
		$count=$noti->CountALL();
		$noti->status("in ('A','V')",true);
		$notifications = $noti->SelectAll('', 'id',"DESC","10");
		ob_start();
		?>

        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
			<?php if($count>0){?>
                <span class="badge bg-green"><?php echo $count;?></span>
			<?php } ?>
        </a>
        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
			<?php if (!empty($notifications)) {
				foreach ( $notifications as $ndata ) {
					$ndata->entry_link=!empty($ndata->entry_link)?admin_url('notification/show/'.$ndata->id):"javascript:void(0);";
					?>
                    <li>
                        <a <?php if($ndata->is_popup_link=="Y"){?> data-effect="mfp-move-from-top" class="popupformWR app-noti-click" <?php }else{?> class="app-noti-click" <?php } ?>href="<?php echo $ndata->entry_link;?>" >
                        
                        <span>
                                          <span><?php echo $ndata->title.(($ndata->n_counter>1)?"(".$ndata->n_counter.")":"");?></span>
                                          <span class="time"><?php echo app_time_elapsed_string($ndata->entry_time);?></span>
                                        </span>
                            <span class="message">
                                          <?php echo $ndata->msg;?>
                                        </span>
                        </a>
                    </li>
				<?php }
				?>
                <li>
                    <div class="text-center">
                        <a href="<?php echo admin_url('notification/show-list/N');?>"> <strong><?php _e("View all") ; ?> </strong> <i class="fa fa-angle-right"></i></a>

                    </div>
                </li>
				<?php
			}else{?>
                <li>
                    <div class="text-center">
	                    <?php _e("You have no notifications right now") ; ?>
                    </div>
                </li>
            <?php } ?>
        </ul>
		<?php
		$html=ob_get_clean();
		$html=str_replace(array("\r", "\n"), '', $html);
		return $html;
	}
	public static function getMessageHTML(){
	    $adminData = GetAdminData();
	    if (!$adminData) {
	         
	        return "";
	    }
	    $noti = new Mapp_notificaiton();
	    $noti->user_id($adminData->id);
	    $noti->entry_type("M");
	    $noti->status('A');
	    $count=$noti->CountALL();
	    $noti->status("in ('A','V')",true);	 
	    $notifications = $noti->SelectAll('', 'id',"DESC","10");
	    ob_start();  
		?>
<a href="#" class="dropdown-toggle"  data-toggle="dropdown"> <i	class="fa fa-envelope-o"></i>
<?php if($count>0){?>
      <span class="count-label label label-warning"><?php echo $count;?></span>
      <?php }?>
    </a>
<ul class="dropdown-menu ">
                 <?php if (!empty($notifications)) {?>
                 
	<li class="msg-dp-heigt">
		<!-- inner menu: contains the actual data -->
		<ul class="menu ">
                     <?php foreach ($notifications as $ndata) {
	             //$ndata=new Mapp_notificaiton();	                      
		                     	$ndata->entry_link=!empty($ndata->entry_link)?admin_url('notification/show/'.$ndata->id):"javascript:void(0);";
		                     ?>
		    <li class=" <?php echo $ndata->status=="A"?"unseen":"seen"?> ">
				<!-- start message --> <a <?php if($ndata->is_popup_link=="Y"){?>
				data-effect="mfp-move-from-top" class="popupformWR app-noti-click" <?php }else{?> class="app-noti-click" <?php } ?>href="<?php echo $ndata->entry_link;?>">					
					<h4><?php echo $ndata->title.(($ndata->n_counter>1)?"(".$ndata->n_counter.")":"");?>
		              <small><i class="fa fa-clock-o"></i> <?php echo app_time_elapsed_string($ndata->entry_time);?></small>
					</h4>
					<p> <?php echo $ndata->msg;?></p>
			</a>
			</li>
			<!-- end message -->
		                      <?php }?>                         
                    </ul>
	</li>
                  <li class="footer"><a href="<?php echo admin_url('notification/show-list/M');?>"><?php _e("View all") ; ?></a></li>
                  <?php }else{?>
                  <li class="header"><?php _e("You have no notifications right now") ; ?></li>
                  <?php }?>
                </ul>
<?php 
		$html=ob_get_clean();
		$html=str_replace(array("\r", "\n"), '', $html);
		return $html;
	}
	public static function getTasksHTML(){
		ob_start();
		?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
	class="fa fa-flag-o"></i>
                   <?php if(self::totalTasks()>0){?>
                  <span class="label label-danger"><?php echo self::totalTasks();?></span>
                  <?php }?>
                </a>
<ul class="dropdown-menu">
                 <?php if(self::totalTasks()>0){?>
                  <li class="header">You have <?php echo self::totalTasks();?> tasks</li>
	<li>
		<!-- inner menu: contains the actual data -->
		<ul class="menu">
                      <?php foreach (self::getAllTasks() as $__task){?>
                      <li>
				<!-- Task item --> <a href="<?php echo $__task->href;?>">
					<h3>
                           <?php echo $__task->title;?>
                            <small class="pull-right"><?php echo $__task->getCompletePercentage();?>%</small>
					</h3>
					<div class="progress xs">
						<div class="progress-bar progress-bar-aqua" style="width: <?php echo $__task->getCompletePercentage();?>%" role="progressbar" aria-valuenow="<?php echo $__task->getCompletePercentage();?>" aria-valuemin="0" aria-valuemax="100">
							<span class="sr-only"><?php echo $__task->getCompletePercentage();?>% Complete</span>
						</div>
					</div>
			</a>
			</li>
			<!-- end task item -->
                      <?php }?>                     
                    </ul>
	</li>
                  <?php /*?>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                  */?>
                  <?php }else{?>
                    <li class="header">You have no task right now</li>
                  <?php }?>
                </ul>
<?php 
		$html=ob_get_clean();
		$html=str_replace(array("\r", "\n"), '', $html);
	    return $html;
	}
		
}
class ANotificaiton{
	public $id;
	public $title;
	public $addTime;
	public $icon;
	public $text;
	public $message_from;
	public $message_from_img;
	public $isViewed=false;
	public $href;
	public $isPopup=false;
	public function getTimeSpentStr(){
		$time1obj =  new DateTime($this->addTime);    	 	
    	$time2obj =  new DateTime();
    	$time2obj->setTimestamp(time());   
    	$dif=$time1obj->diff($time2obj);
    	$returnstr="0 second";
    	if($dif->y>0){
    		$returnstr="{$dif->y} year".($dif->y>1?"s":"");
    	}elseif ($dif->m>0){
    		$returnstr="{$dif->m} month".($dif->m>1?"s":"");
    	}elseif ($dif->d>0){
    		$returnstr="{$dif->d} day".($dif->d>1?"s":"");
    	}elseif ($dif->h>0){
    		$returnstr="{$dif->h} hour".($dif->h>1?"s":"");
    	}elseif ($dif->i>0){
    		$returnstr="{$dif->i} minute".($dif->i>1?"s":"");
    	}elseif ($dif->s>0){
    		$returnstr="{$dif->s} second".($dif->s>1?"s":"");
    	}    	
    	return $returnstr." ago";
	}
}
class AMessage extends ANotificaiton{
	public $message_from;
	public $message_from_img;
}
class ATask extends ANotificaiton{
	public $totalTask;
	public $completedTask;
	public $color;
	public function getCompletePercentage(){		
		$returnp=0;
		if($this->totalTask>0){
			$returnp=($this->completedTask/$this->totalTask)*100;
			$returnp=floor($returnp);
		}else{
			$returnp=100;
		}
		return $returnp>100?100:$returnp;	
	}
}