<?php
APP_Controller::LoadChartDataController();
class Report_chart_data extends APP_ChartDataController{
	
	function get_agent_month_data(){
	    $adminData=GetAdminData();
		$this->response->title=__("Day Report")." (Month ".date("F-Y").")";
		$this->response->setType(APPChartConfig::TYPE_LINE);
		$this->response->setXYTitle(date("F-Y"),__('Assigned & Closed'));
		//$result= Magent_staff::getMonthlyAccountOpenData($year, $month, $agentData->id);
		$reportOpenData=Mticket::getTicketOpenData(date("Y-m-01"),date("Y-m-t"),$adminData->id);
		//$reportOpenData=Mticket::getTicketOpenData('2017-10-01','2017-10-30',$adminData->id);
		$reportCloseData=Mticket::getTicketCloseData(date("Y-m-01"),date("Y-m-t"),$adminData->id);
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
		//Mticket::
		
		$this->response->data->addLabels(range(01,$totaldays));
		$this->response->data->addDataSetByValue("Assigned",$data1, "#00c0ef",2);
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
		$this->response->title=__("Monthly Report")." (Year-{$year})";
		$this->response->setType(APPChartConfig::TYPE_LINE);
		$this->response->setXYTitle("Year-{$year}",__('Assigned & Closed'));
		$this->response->data->addLabels($months);
		//$result= Magent_staff::getYearlyAccountOpenData($year,$agentData->id);
		//$this->response->data->addDataSetByValue("Member",array_values($result->member), "#0CB4E2",2);
		//$this->response->data->addDataSetByValue("Share",array_values($result->share), "#62DC1D",4);
		$this->response->setMinimumHeight(300);
	}	
}