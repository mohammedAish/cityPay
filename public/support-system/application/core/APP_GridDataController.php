<?php
class APP_GridDataController extends APP_Controller {	
	public $orderBy;
	public $order;
	public $rows = 20;
	public $pageNo = 1;
	public $limit = 20;
	public $limitStart = 0;
	public $srcItem = "";
	public $srcText = "";
	public $toDate="";
	public $fromDate = "";
	public $srcOption = "";
	public $searchOper="";
	
	public $multiparam=array();
	public $multiOperator=array();
	public $isMultisearch=array();
	private $response;
	private $isDownloadCSV=false;
	private $download_filename="";
	function __construct($skipSessionCheck=''){	
		parent::__construct();
		
		$this->output->unset_template();
		$this->response=new stdClass();
		$this->response->rowdata=array();
		$this->response->redirect_url="";
		$this->isDownloadCSV=RequestValue( 'download_csv' ,"false")=="true";
		$this->CheckSession($skipSessionCheck);
		if (IsPostBack || $this->isDownloadCSV) {		
			$this->orderBy = RequestValue("sidx");				
		    $this->order = RequestValue( 'sord' );
		    $this->rows = RequestValue(  'rows',$this->rows);
		    if($this->rows>200){
		    	$this->rows=200;
		    }
			$this->pageNo = (int)RequestValue(  'page' );
			if($this->pageNo==0){
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
			if($this->searchOper=="bt"){
			    $this->fromDate=$this->srcText;
			    $this->srcTex="";
			}
			$this->limitStart = ($this->pageNo - 1) * $this->rows;
			$this->limit=&$this->rows;
			$this->multiparam=array();
			$this->multiOperator=array();
			$this->isMultisearch=false;
			$oplist=array("lg"=>"<","gr"=>">");
			$this->isMultisearch = RequestValue( 'isMultiSearch' ,"")=="true" || $this->isMultisearch==true;			
			if($this->isMultisearch)	{
				$this->load->helper('security');
				$ptext=RequestValue ( 'ms' ,"",false);
				if(!empty($ptext)){
				    $ptext=base64_decode($ptext);				    
					$multi_options=array();
					parse_str($ptext,$multi_options);
		            if(isset($multi_options['ms'])){
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
				$this->multiparam=array_filter($this->multiparam,function ($value){ return !empty($value) && $value!="*";});
			}
		}
		
		
	}
	protected function setOrderByIfEmpty($property,$order="ASC"){
	    if(empty($this->orderBy)){
	       $this->orderBy=$property;
	       $this->order=$order;
	    }
	}
	protected function CheckSession($skips=''){	
		if(!$this->CheckPageAccess($skips,"",true,'',false)){		   
	        $panel=get_panel_by_dir($this->uri->uri_string());
	        $redirectURL="";
	        if($panel=="A"){
	            $redirectURL=site_url("admin/user/login");
	        }else{
	            $redirectURL=site_url("user/login");
	        }
	        $this->DisplayGridPermissionDenied($redirectURL);		    
		}
	}
	function setDownloadFileName($filename){
	    if(!empty($filename)){
	       $this->download_filename=$filename;
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
	protected function DisplayGridPermissionDenied($redirect_url=''){
		$this->response->records=0;
		$this->response->page =0;
		$this->response->total = 0;
		$this->response->rowdata=array();
		$this->response->msg="Permission Denied";
		$this->response->redirect_url=$redirect_url;
		echo json_encode ( $this->response );die;		
	}
	protected function DisplayGridResponse(){	
	    if($this->isDownloadCSV){	  
	           $cols=RequestValue("cols");
	           $cols=(base64_decode($cols));
	           $cols=json_decode($cols);
	           if(!empty($cols->action)){
	               unset($cols->action);
	           }
	           if(empty($this->download_filename)){
	               $this->download_filename=RequestValue("filename","data");
	           }
	           $this->DownloadCSVFromResponseData($cols,$this->response,$this->download_filename.".csv");
	      
	    }else{	
    		$this->response->page = $this->pageNo;
    		$this->response->total = !empty($this->response->records)? ceil ( $this->response->records / $this->rows ):0;
    		if($this->response->total==0){
    		    $this->response->page=0;
    		}
    		if(!$this->isDownloadCSV){echo json_encode ( $this->response );die;};	
	    }	
	}
	protected function DownloadCSVFromResponseData($cols,&$response,$filename,$delimiter=","){	  	    
	    $this->DownloadCSV($cols,$response->rowdata,$filename,$delimiter);
	}
	protected function DownloadCSV($cols,&$data,$filename,$delimiter=","){
	    ob_start();
	    AddLog("O", "Download:$filename", "l008","CSV Downloaded");
	    ob_end_clean();
	    header('Content-Type: application/csv');
	    header('Content-Disposition: attachement; filename="'.$filename.'";');
	    $f = fopen('php://output', 'w');
	    $maindlarray=array();
	    $titles=array();
	    if(count($cols)>0){
	        foreach ($cols as $key=>$value){
	            $value=preg_replace("/&.*?;/", "", $value);
	            array_push($titles,$value);
	        }
	        fputcsv($f, $titles, $delimiter);
	        foreach ($data as $cdata){
	            $row=array();
	            foreach ($cols as $key=>$value){
	                $rvalue="";
	                if(!empty($cdata->$key)){
	                    $rvalue=strip_tags($cdata->$key);
	                }
	                $rvalue=preg_replace("/&.*?; /", "", $rvalue);
	                array_push($row, $rvalue);
	            }
	            fputcsv($f, $row, $delimiter);
	        }
	        fclose($f);
	    }
	}
	protected function AddIntoPageList(){
		
	}
}
