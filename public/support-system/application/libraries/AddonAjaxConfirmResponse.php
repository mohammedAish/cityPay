<?php
	/**
	 * @since: 03/02/2019
	 * @author: Sarwar Hasan
	 * @version 1.0.0
	 */
	
	class AddonAjaxConfirmResponse {
		public $status=false;
		public $msg="";
		public $data=NULL;
		public $icon="";
		public $isSticky=false;
		public $title=NULL;
		function SetResponse($status,$msg,$data=null,$icon="",$title=null,$isSticky=false){
			if(empty($icon)){
				$icon=$status?" fa fa-check-circle-o ":" fa fa-times-circle-o ";
			}
			$this->status=$status;
			$this->msg=$msg;
			$this->data=$data;
			$this->icon=$icon;
			$this->isSticky=$isSticky;
			$this->title=$title;

		}
		function DisplayWithResponse($status,$msg,$data=null,$icon="",$title=null,$isSticky=false){
			$this->SetResponse($status,$msg,$data,$icon,$title,$isSticky);
			$this->Display();
		}
		function Display(){
			die(json_encode($this));
		}
	}