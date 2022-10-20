<?php
class APPChartData {
	public $labels=array();
	/**
	 * @var APPChartDataset
	 */
	public $datasets=array();
	function addLabels(array $labels){
		$this->labels=$labels;
	}
	/**
	 * @param unknown $label
	 * @param array $data
	 * @param unknown $backgroundColor
	 * @param number $borderWidth
	 * @param string $isFill
	 * @param string $borderColor
	 * @category is it used for line and bar chart;
	 */
	function addDataSetByValue($label,array $data,$backgroundColor,$borderWidth=1,$isFill=false,$borderColor=""){
		if(empty($borderColor)){
			$borderColor=$backgroundColor;
		}
		$mp=new stdClass();
		$mp->label=$label;
		$mp->data=$data;
		$mp->fill=$isFill;
		$mp->backgroundColor=$backgroundColor;
		$mp->borderColor=$borderColor;
		$mp->borderWidth=$borderWidth;		
		$this->datasets[]=$mp;
	}
	
}