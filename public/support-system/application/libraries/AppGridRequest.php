<?php
class AppGridRequest {
    public $orderBy;
	public $order;
	public $rows = 20;
	public $pageNo = 1;
	public $limit = 20;
	public $limitStart = 0;
	public $srcItem = "";
	public $srcText = "";
	public $srcOption = "";
	public $searchOper="";
	
	public $multiparam=array();
	public $multiOperator=array();
	public $isMultisearch=array();
	private $response;
	private $isDownloadCSV=false;
	function __construct(){	
		$this->response=new stdClass();
		$this->response->rowdata=array();
		$ci=get_instance();
		$ci->load->helper('security');
		if (IsPostBack) {			
			$this->orderBy = RequestValue("sidx");				
		    $this->order = RequestValue( 'sord' );
		    $this->rows = RequestValue(  'rows',$this->rows);
		    if($this->rows>200){
		    	$this->rows=200;
		    }
			$this->pageNo = (int)RequestValue(  'page' );
			if($this->pageNo<=0){
			    $this->pageNo=1;
			}			
			$this->srcItem = RequestValue(  'searchField' );
			$this->srcText = RequestValue(  'searchString' );
			if(empty($this->srcText) || $this->srcText=="*"){
				$this->srcText="";
				$this->srcItem="";
			}			
			$this->searchOper = RequestValue(  'searchOper' );			
			$this->toDate = RequestValue(  'toString' );
			
			$this->limitStart = ($this->pageNo - 1) * $this->rows;
			$this->limit=&$this->rows;
			$this->multiparam=array();
			$this->multiOperator=array();
			$this->isMultisearch=false;
			$oplist=array("lg"=>"<","gr"=>">");
			$this->isMultisearch = RequestValue( 'isMultiSearch' ,"")=="true";			
			if($this->isMultisearch)	{
				$ptext=RequestValue ( 'ms' ,"",false);				
				if(!empty($ptext)){
				    $ptext=urldecode($ptext);
				    //AddFileLog($ptext,true,"post.log");
					$multi_options=array();
					parse_str($ptext,$multi_options);	
					//AddFileLog($multi_options,true,"post.log");						          
					$this->multiparam=$multi_options['ms'];
					foreach ($this->multiparam as &$_mp){
						if(is_string($_mp)){
							$_mp= xss_clean($_mp);
						}
					}
					if(!empty($multi_options['op']) && is_array($multi_options['op'])){
						foreach ($multi_options['op'] as $opkey=>$_op){
							if(!empty($oplist[$_op])){
								$this->multiOperator[$opkey]= $oplist[$_op];
							}
						}
					}
				}
			}
		}		
		
	}
	function getMultiParam($key = '', $defaultValue = '') {
	    if (empty ( $key )) return $defaultValue;
	    if (isset ( $this->multiparam [$key] )) return $this->multiparam [$key];
	    return $defaultValue;
	}
	function SetGridRecords($records){
	    $this->response->records=$records;
	}
	function SetGridData($data,$key='rowdata'){
	    $this->response->$key=$data;
	}	
	function getGridResponse(){
	    $this->response->page = $this->pageNo;
	    $this->response->total = !empty($this->response->records)? ceil ( $this->response->records / $this->rows ):0;	
	    return $this->response;
	}
    
}