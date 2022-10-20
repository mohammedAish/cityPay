<?php
APP_Controller::LoadChartDataController();
class Admin_report_chart_data extends APP_ChartDataController{
	
	function get_agent_month_data(){
	    $adminData=GetAdminData();
	    $chartType=PostValue("report_type","Y");
	    $this->response->setType(APPChartConfig::TYPE_LINE);
	    if($chartType=="Y"){
	        //yearly
	        $current_year=date('Y');
	      $this->response->title=__("Month Report")." (Year ".date("Y").")";
	      $this->response->setXYTitle("Year-".date("Y"),__('Opened & Closed'));
	      $month=[1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December'];
	      $reportOpenData=Mticket::getTicketYearlyOpenData($current_year);
	      $reportCloseData=Mticket::getTicketYearlyCloseData($current_year);
	      //GPrint($responseData);
	      $data1=[];
	      $data2=[];
	      $totaldays=date("t");
	      foreach ($month as $key=>$i){
	          if(isset($reportOpenData[$key])){
	              $data1[]=$reportOpenData[$key];
	          }else{
	              $data1[]=0;//rand(1, 9);
	          }
	          if(isset($reportCloseData[$key])){
	              $data2[]=$reportCloseData[$key];
	          }else{
	              $data2[]=0;//rand(1, 9);
	          }
	      
	      }
	      //asort($month);
	      $this->response->data->addLabels(array_values($month));
	    }else{	    
		  $this->response->title=__("Day Report")." (Month ".date("F-Y").")";
		  $this->response->setXYTitle(date("F-Y"),__('Opened & Closed'));
		  
		  $reportOpenData=Mticket::getTicketOpenData(date("Y-m-01"),date("Y-m-t"));
		  $reportCloseData=Mticket::getTicketCloseData(date("Y-m-01"),date("Y-m-t"));
		  //GPrint($responseData);
		  $data1=[];
		  $data2=[];
		  $totaldays=date("t");
		  foreach (range(01,$totaldays) as $i){
		      if(isset($reportOpenData[$i])){
		          $data1[]=$reportOpenData[$i];
		      }else{
		          $data1[]=0;//rand(1, 9);
		      }
		      if(isset($reportCloseData[$i])){
		          $data2[]=$reportCloseData[$i];
		      }else{
		          $data2[]=0;//rand(1, 9);
		      }
		  
		  }
		  $this->response->data->addLabels(range(01,$totaldays));
	    }	
		
		//Mticket::
		
		
		$this->response->data->addDataSetByValue("Opened",$data1, "#00c0ef",2);
		$this->response->data->addDataSetByValue("Closed",$data2, "#00A65A",2);
		$this->response->setMinimumHeight(300);		
	}
	function get_agent_year_data(){
		//Magent_staff::
		$agentData=GetAgentData();
		$months = array('January','February','March','April','May','June','July ','August','September','October','November','December');
		$year=PostValue("year");
		if(empty($year)){
			$year=get_current_user_timezonetime('','Y');
		}
		$this->response->title="Monthly Report (Year-{$year})";
		$this->response->setType(APPChartConfig::TYPE_LINE);
		$this->response->setXYTitle("Year-{$year}",'Member & Share');
		$this->response->data->addLabels($months);
		//$result= Magent_staff::getYearlyAccountOpenData($year,$agentData->id);
		//$this->response->data->addDataSetByValue("Member",array_values($result->member), "#0CB4E2",2);
		//$this->response->data->addDataSetByValue("Share",array_values($result->share), "#62DC1D",4);
		$this->response->setMinimumHeight(300);		
	}	
}