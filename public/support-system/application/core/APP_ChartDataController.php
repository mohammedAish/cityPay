<?php
class APP_ChartDataController extends APP_Controller {	
	private $isDisplayed=false;
	/**
	 * @var APPChartConfig
	 */
	public $response;
	function __construct($skipSessionCheck=''){	
		parent::__construct();
		$this->load->library("chart/APPChartConfig");
		$this->output->unset_template();
		$this->response=new APPChartConfig();
		$this->response->title="Unknown Titile";		
		$this->CheckSession($skipSessionCheck);				
	}
	function __destruct(){
		if(!$this->isDisplayed){
			$this->DisplayResponse();
		}
	}
	protected function CheckSession($skips=''){	
		if(!$this->CheckPageAccess($skips,"",true,'',false)){
			$this->DisplayChartPermissionDenied();
		}
	}
	protected function DisplayChartPermissionDenied(){
		if(!$this->isDisplayed){
			$this->isDisplayed=true;
			$this->response->title="Permission Denied";
			echo json_encode ( $this->response );die;	
		}	
	}
	
	function DisplayResponse(){
		$this->isDisplayed=true;		
		header('Content-Type: text/json');
		die(json_encode($this->response));
	}
	
	protected function AddIntoPageList(){
		
	}
}
