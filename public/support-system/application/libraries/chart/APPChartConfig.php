<?php
require_once 'APPChartData.php';
class APPChartConfig{
  //  const TYPE_AREA="Area";
    const TYPE_BAR="bar";
    const TYPE_LINE="line"; 
    //const TYPE_AREA="area";
    const TYPE_DONUT="doughnut"; 
    const TYPE_PIE="pie";
    public $title="";
	public $type="line";	
	/**
	 * @var APPChartData
	 */
	public $data;
	public $options;
	function __construct(){
		$this->data=new APPChartData();		
		$this->setType($this->type);		
	}	
	function setType($type){
		if($type==self::TYPE_DONUT || $type==self::TYPE_PIE){			
			$obj=new stdClass();
			$obj->responsive=true;
			$obj->legend=new stdClass();
			$obj->legend->position="top";
			$obj->title=new stdClass();
			$obj->title->display=false;
			$obj->title->text=&$this->title;
			$obj->animation=new stdClass();
			$obj->animation->animateScale=true;
			$obj->animation->animateRotate=true;
			$this->options=$obj;
		}else{
			$this->options=new stdClass();
			$this->options->responsive=true;
			//$this->options->maintainAspectRatio= true;
			$this->options->scales=new stdClass();
			$this->options->scales->yAxes=array();
			$yAxes=new stdClass();
			$yAxes->ticks=new stdClass();
			$yAxes->ticks->beginAtZero=true;
			$this->options->scales->yAxes[]=$yAxes;
		}
		 $this->options->tooltips= new stdClass();
		 $this->options->tooltips->position="average";
		 $this->options->tooltips->mode= 'index';
		 $this->options->tooltips->intersect=false;
		 $this->options->minHeight=200;
		$this->type=$type;
	}
	function setAspectRatio($status){
		$this->options->maintainAspectRatio= $status;
	}
	function setMinimumHeight($height){
		$this->options->minHeight=$height;
	}
	private function getSampleScaleObject($title){
		$sampleobj=new stdClass();
		$sampleobj->display=true;
		$sampleobj->scaleLabel=new stdClass();
		$sampleobj->scaleLabel->display=true;
		$sampleobj->scaleLabel->labelString=$title;
		return $sampleobj;
	}
	function setXYTitle($xtitle='',$ytitle=''){
		/*scales: {
			xAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Month'
				}
			}],
			yAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Value'
				}
			}]
		}*/
		
		
		
		$this->options->scales=new stdClass();
		if(!empty($xtitle)){
			
			$this->options->scales->xAxes=array($this->getSampleScaleObject($xtitle));
		}
		if(!empty($ytitle)){			
			$this->options->scales->yAxes=array($this->getSampleScaleObject($ytitle));
		}
	}
}
