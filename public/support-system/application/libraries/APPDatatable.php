<?php
class APPDatatable{
	static $counter=0;
	private $GridId="";
	public $IsCSVDownload=false;
	public $width="100%";
	public $height="400px";
	public $url="";
	public $datatype= "json";		
	public $colNames="";
	public $afterInsertRow="";
	public $container="";
	public $multiselect=false;
	public $multisearch=false;
	private $MultiSearchOperator=array();
	public $ShowAdvanceSearch=false;
	/**
	 * Enter description here ...
	 * @var GridModel
	 */	
	public $colModel=array();	
	public $rowNum=15; 
	public $rowList=array(5,10,20,50,100,200); 
	public $mtype="POST";
	public $caption=null;	
	public $rownumbers= true;
  	public $pager=''; 
  	public $sortname=''; 
  	public $viewrecords= true; 
  	public $sortorder="asc" ;
	public $jsonReader;
	public $autowidth=false;
	public $SRCObj;
	public $searchbtn="";
	
	public $loadComplete;
	public $OnSelectAll;
	public $hidecaption=true;
	public $hidegrid=true;
	public $shrinkToFit=true;
	public $postData=null;
	public $CustomSearchOnTopGrid=true;
	public $ShowDefaultSearch=false;
	public $emptySetText="No Record Found";
	public $TotalColumn=0;	
	public $isShowNoRecordMsg=true;
	public $IsColAutoWidth=false;
	public $minWidth=200;
	public $rightPadding=0;
	public $ShowReloadButtonInTitle=false;
	public $ShowDownloadButtonInBottom=false;
	public $ShowDownloadButtonInTitle=false;	
	public $DownloadFileName="";
	public $TextwDownloadButtonInTitle="Download CSV";
	public $TextReloadButtonInTitle="Reload";
	public $auto_height_records=14;
	/* Toolbar*/
	public $toolbar=array(false,"top");
	public $toolbarControl="";
	public $toolbarHeight=null;
	public $toolbarCSS="";	
	/*end toolbar*/
	
	public $isForBootstrap=true;
	
	private $TitleRightHtml="";	
	private $custom_searchoption=array();
	private $CustomPostArray=array();
	private $tempIndex=array();
	private $jsMethods=array();
	public $beforeSelectRow="";
	private $leftButtons="";
	private $modelTooltips=array();
	private $modeltooltopPlacement="bottom";	
	private static $isLoadedCSSJS=false;
	private $hidecols=array("xs"=>array(),"sm"=>array());
  	function __construct($gid=""){ 
  		if(!self::$isLoadedCSSJS){	
	  		if(function_exists("add_js")){
	  			add_js('//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js');	 
	  		
	  			
	  		}
	  		if(function_exists("add_css")){
	  			add_css('//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css');	
	  		}
	  		self::$isLoadedCSSJS=true;
  		}
  		 $this->jsonReader=new stdClass();
	  	 $this->jsonReader->root="rowdata";	  	
	   // $this->jsonReader->page= "currpage";
      	//$this->jsonReader->total= "totalpages";
      	//$this->jsonReader->records="totalrecords";
	    $this->jsonReader->repeatitems= false;
	    $this->jsonReader->id=0;
	    if(!empty($gid)){
	    	$this->GridId=$gid;
	    }else{
	    	$this->GridId="tab".(self::$counter++)."_".time();
	    }
	    $this->postData=new stdClass();
	    $this->CustomPostArray['jsf']=array();
	    $this->CustomPostArray['value']=array();
	}
	function addModelTooltips(array $tooltips,$placement="bottom"){
		$this->modelTooltips=$tooltips;
		$this->modeltooltopPlacement=$placement;
	}
	function DisplayTooltip(){
		if(count($this->modelTooltips)==0)return;
		?>
		try{
		<?php 
		foreach ($this->modelTooltips as $key=>$tooltip){
			if(isset($this->tempIndex[$key])){
				$gridid=$this->GetGridId()."_".$key;
				?>
		$("<?php echo $gridid?>").addClass("gs-col-tooltop").attr("title", "<?php echo addslashes($tooltip);?>");
		<?php 
		}
			}
		?>
		 $('.gs-col-tooltop').tooltip({container:'body',placement:'<?php echo $this->modeltooltopPlacement;?>'});
		 }catch(e){
		 
		 } 
		<?php	
				
	}
	function __call($func,$arg){
		if($func=="AddSearhProperty"){			
			call_user_func_array(array($this, "AddSearchProperty"), $arg);
		}
	}
	function AddResponsiveHidden($col_id,$bootstrapSizeKey="xs"){
		if(!isset($this->hidecols[$bootstrapSizeKey])){
			return;
		}
		$hmodels=explode(",", $col_id);
		foreach ($hmodels as $hc){
			$this->hidecols[$bootstrapSizeKey][]=$hc;
		}
	}
	function AddTitleLeftHtml($str){
		$this->leftButtons.=$str." ";
	}
  	function AddTitleRightHtml($str){
  		$this->TitleRightHtml.=$str." ";
  	}
  	function AddMultisearchOperator($property){
  		$this->MultiSearchOperator[]=$property;
  	}
  	private function GetJson(){
  		 $colNames=array();  		 
  		foreach ($this->colModel as $cm){  			
  			array_push($colNames, $cm->Title);    			
  		}
  		$this->colNames=$colNames;
  		foreach ($this->CustomPostArray['jsf'] as $key=>$cp){
  			$this->postData->$key="";
  		}
  		foreach ($this->CustomPostArray['value'] as $key=>$cp){
  			$this->postData->$key=$cp;
  		}
  		//GPrint($this);
  		return json_encode($this);
  	}
  	function GetGridId($noHash=false){
  		if($noHash){
  			return $this->GridId;
  		}else{
  			return "#".$this->GridId;
  		}
  	}
  	function AddCustomPostData($key,$strFun,$isJavascriptFunc=false){
  		if($isJavascriptFunc){  
  				$this->CustomPostArray['jsf'][$key]=$strFun;	
  		}else{
  			$this->CustomPostArray['value'][$key]= $strFun;		
  		}  		
  	}
  	function ReloadMethod(){
  		return "Grid_".$this->GridId."_reload";
  	}
  	function ResizeMethod(){
  		return $this->GridId."_ResizeGrid";
  	}  	
  	function DownloadCSVMethod(){
  		return "Grid_".$this->GridId."_download";
  	}
  	function AddCustomPropertyOfModel($index,$property,$value){
  		if(isset($this->tempIndex[$index])){
			$rowid=$this->tempIndex[$index];
  			$this->colModel[$rowid]->$property=$value;
		}
  	}
  	function SetDefaultValue($name,$default,$default2=''){
  		$this->AddCustomPropertyOfModel($name, "dvalue", $default);
  		$this->AddCustomPropertyOfModel($name, "dvalue2", $default2);
  	}
  	function ExtendModel($name,$jsonString){
  		$this->custom_searchoption[$name]=$jsonString;
  	}
	function AddModelCSSClass($name,$classStr){
		if(!empty($this->tempIndex[$name])){
			$rowid=$this->tempIndex[$name];
  			$this->colModel[$rowid]->classes=$classStr;
		}
  	}
  	function BeforeSelectRow($jsmethod){
  		$this->beforeSelectRow=$jsmethod;
  	}  
	function show($srcJquerySelector=""){
		 //$this->GetJson();jQuery("#bigset").jqGrid('navGrid','#pagerb',{edit:false,add:false,del:false,reloadtext:"Reload",searchtext:" Search&nbsp;"},{},{},{},{sopt:['cn','bw','eq','ne','lt','gt','ew']});
		if($this->ShowReloadButtonInTitle || $this->ShowDownloadButtonInTitle){
			$this->hidecaption=false;
		}
		if(empty($this->DownloadFileName)){
			global $pageTitle;
			$this->DownloadFileName=!empty($this->caption)?$this->caption:"download_";
		}		
		if($this->IsColAutoWidth){
			foreach ($this->colModel as &$cmodel){				
				$cmodel->shrinktofit=true;
			}
		}
		
		 $tableId=$this->GridId;
		 $addedSpanEnd=false;
		 if(!empty($this->ShowReloadButtonInTitle) || !empty($this->ShowDownloadButtonInTitle)){
		 	$reload=$this->ShowReloadButtonInTitle?'<a onclick="'.($this->ReloadMethod()).'()" class="btn btn-xs btn-primary" ><i class="fa fa-refresh"></i> '.$this->TextReloadButtonInTitle.'</a> ':"";
		 	$download=$this->ShowDownloadButtonInTitle?'<a onclick="'.($this->DownloadCSVMethod()).'()" class="btn btn-xs btn-success" ><i class="fa fa-download"></i> '.$this->TextwDownloadButtonInTitle.'</a>':"";
		 
			$this->caption.='</span><span style="margin-left: 20px; float: left;" class="gridtitle left">'.$this->leftButtons." ".$reload.'</span>';
			//$this->AddTitleRightHtml($reload);
			$this->AddTitleRightHtml($download);
			$addedSpanEnd=true;
		 }elseif(!empty($this->leftButtons)){
		 	$this->caption.='</span><span style="margin-left: 20px; float: left;" class="gridtitle left">'.$this->leftButtons.'</span>';		 	
		 }
		 $this->AddTitleRightHtml('<span data-gridid="mc_'.$tableId.'" class="full-screen btn btn-info btn-xs"><i class="fa fa-expand "></i></span>');
		 if(!empty($this->TitleRightHtml)){
		 	if(!$addedSpanEnd){
		 		$this->caption.='</span>';
		 	}
	 		$this->caption.='<span class="gridtitle text-right ">&nbsp;'.$this->TitleRightHtml;
	 	
		}	
		 $srcDivId="src_$tableId";
		 $this->pager="#pager_".$tableId;
		 if(!empty($srcJquerySelector)){
		 	$this->searchbtn=$srcJquerySelector;
		 }
		 if($this->CustomSearchOnTopGrid){
			$this->GetCustomSearch();
		 }
		 ?>
<script type="text/javascript">
		 	var sbtnclick_<?php echo $tableId;?>=false;
		 	var minwidth_<?php echo $tableId;?>=<?php echo $this->minWidth;?>;
		 	jQuery(function ($){
			 
		 	var srcDivId="#<?php echo $srcDivId?>";		 	
		 	jQuery("#<?php echo $srcDivId?> .srcSelectValue").change(function(){
			 	if(jQuery("#autosearch_<?php echo $tableId?>").is(':checked')){
			 		Grid_<?php echo $tableId?>_custom_reload();
			 	}
			});
		 	var timeoutHnd_<?php echo $tableId?>=null;		 	
			jQuery("#<?php echo $srcDivId?> .srcTextValue").keydown(function(e){	
				var s=jQuery(this).val();
				var code = (e.keyCode ? e.keyCode : e.which);				
				if((s.length==1 && code==8)||jQuery("#autosearch_<?php echo $tableId?>").is(':checked')){			 					 	
			 		if(timeoutHnd_<?php echo $tableId?>)clearTimeout(timeoutHnd_<?php echo $tableId?>); 
			 		timeoutHnd_<?php echo $tableId?> = setTimeout(Grid_<?php echo $tableId?>_reload,500); 
		 		}else if(code==13){
		 			Grid_<?php echo $tableId?>_custom_reload();
		 		}
			});
		 	
		 	
			jQuery("#autosearch_<?php echo $tableId;?>").click(function(){
				if(jQuery("#autosearch_<?php echo $tableId?>").is(':checked')){
					jQuery("#<?php echo $srcDivId?> .srcButton").hide();
			 		Grid_<?php echo $tableId?>_reload();
			 	}else{
			 		jQuery("#<?php echo $srcDivId?> .srcButton").show();
			 	}
			});
			 
		 	jQuery("#<?php echo $srcDivId?> .srcOptionList").change(function(e){			 	
		 		SetSearchOption_<?php echo $srcDivId?>();			 	
			 });
		 	 jQuery(".gs-jq-grid").on("click",".full-screen:not(.exit-full-screen)",function(e){
				 e.preventDefault();
				 //alert("ok");
				 $(this).find(".fa-expand").removeClass("fa-expand").addClass("fa-compress");
				 //fa-compress
				 try{
				 jQuery("<?php echo $this->container;?>").addClass('grid-full-screen');
				 }catch(e){}
				 var panelid=$(this).data("gridid");
				 var gridh=jQuery("#<?php echo $tableId;?>").getGridParam("height");
				 $(this).attr("lasth",gridh);
				 $("#"+panelid).addClass("grid-panel-full-screen");
				 $(this).addClass("exit-full-screen");
				 var wheight=$(window).height();
				 var wwidth=$(window).width();	
				 var offset= jQuery("<?php echo $this->pager;?>").height();				
				 if(offset<=0){
					 offset=130;
				 }else{
					 offset+=75;
				 }						
				 jQuery("#<?php echo $tableId;?>").setGridWidth(wwidth);
				 jQuery("#<?php echo $tableId;?>").setGridHeight(wheight-offset);
				
				// requestFullScreen(document.getElementById(panelid));
				 
				 
			 });
			 jQuery(".gs-jq-grid").on("click",".exit-full-screen",function(e){
				 e.preventDefault();
				 $(this).find(".fa-compress").removeClass("fa-compress").addClass("fa-expand");	
				 var panelid=$(this).data("gridid");
				 $("#"+panelid).removeClass("grid-panel-full-screen");			 
				 $(this).removeClass("exit-full-screen");
				 var lastheight= $(this).attr("lasth");
				 $(this).removeAttr("lasth");
				 jQuery("#<?php echo $tableId;?>").setGridHeight(lastheight);
				// requestFullScreen(document.getElementById(panelid));
				 try{
					jQuery("<?php echo $this->container;?>").removeClass('grid-full-screen');
				 }catch(e){}
				 <?php echo $tableId;?>_ResizeGrid();
				 
			 });
			<?php if($this->CustomSearchOnTopGrid){?>
		 			SetSearchOption_<?php echo $srcDivId?>();
				<?php } ?>	
		 	});
		 	function SetSearchOption_<?php echo $srcDivId?>(){

		 		var stype=jQuery("#<?php echo $srcDivId?> .srcOptionList option:selected").attr("stype");	
			 	if(stype!="date"){
			 		jQuery("#<?php echo $srcDivId?>_from").addClass("hidden");
			 		jQuery("#<?php echo $srcDivId?>_to").addClass("hidden");
			 		jQuery("#<?php echo $srcDivId?>_text").removeClass("hidden");
			 	}		 	
			 	if(stype=="select"){
			 		jQuery("#<?php echo $srcDivId?> .srcTextValue").hide();
			 		var selectOption=jQuery("#<?php echo $srcDivId?> .srcOptionList option:selected").attr("data");			 		
			 		selectOption=jQuery.parseJSON(selectOption);
			 		jQuery("#<?php echo $srcDivId?> .srcSelectValue option").remove();
			 		for(var i in selectOption){
			 			jQuery("#<?php echo $srcDivId?> .srcSelectValue").append("<option value='"+i+"'>"+selectOption[i]+"</option>");			 	
			 		}			 		
			 		jQuery("#<?php echo $srcDivId?> .srcSelectValue").show();
			 	}else if(stype=="date"){
			 		jQuery("#<?php echo $srcDivId?>_text").addClass("hidden");
			 		jQuery("#<?php echo $srcDivId?>_from").removeClass("hidden");
			 		jQuery("#<?php echo $srcDivId?>_to").removeClass("hidden");
			 		jQuery("#<?php echo $srcDivId?> .srcTextValue").show();
			 		jQuery("#<?php echo $srcDivId?> .srcSelectValue").hide();	
			 		try{
			 			SetDateGridPicker();
			 		}catch(e){
				 		gcl(e.message);
				 	}		 		
			 	
			 	}else{
			 		jQuery("#<?php echo $srcDivId?> .srcTextValue").show();
			 		jQuery("#<?php echo $srcDivId?> .srcSelectValue").hide();
			 	}
			 	if(jQuery("#autosearch_<?php echo $tableId?>").is(':checked')){
			 		Grid_<?php echo $tableId?>_custom_reload();
			 	}
			 	
		 	}
		 	
		 	function <?php echo $this->DownloadCSVMethod()?>(){
		 		 	var stype=jQuery("#<?php echo $srcDivId?> .srcOptionList option:selected").attr("stype");
		 			var data = jQuery("<?php echo $this->GetGridId();?>").jqGrid("getGridParam", "postData");		 			
		 			data.download_csv = true;					
					data.searchOper = "eq";
					if(stype=="select"){
						data.searchString = jQuery("#<?php echo $srcDivId?> .srcSelectValue").val();
					}else if(stype=="date"){						
						data.searchString = ""+jQuery("#<?php echo $srcDivId?>_from .srcFrom").val();
						data.toString = ""+jQuery("#<?php echo $srcDivId?>_to .srcTo").val();
						data.searchOper = "bt";
					}else{	
						data.searchString = jQuery("#<?php echo $srcDivId?> .srcTextValue").val();
						data.searchOper = "eq";
					}		
					data.searchField = jQuery("#<?php echo $srcDivId?> .srcOptionList").val();
					data._search = true;					
					data.searchString=(typeof (data.searchString)=="undefined")?"":data.searchString;	
					data.searchField = jQuery("#<?php echo $srcDivId?> .srcOptionList").val();
					data.searchField=(typeof (data.searchField)=="undefined")?"":data.searchField;
					data._search = true;
					
			 		if(jQuery("#difrm").length==0){
				 		jQuery("body").append("<iframe id='difrm' style='border:none;height:0;width:0'></iframe>");
			 		}
			 		serialize = function(obj) {
			 			  var str = [];
			 			  for(var p in obj)
			 			    if (obj.hasOwnProperty(p)) {
			 			      str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
			 			    }
			 			  return str.join("&");
			 			}
		 			<?php 
		 			$cols=array();
		 			foreach ($this->colModel as $col){	
						if(!empty($col->hidden))continue;
		 				$cols[$col->name]=$col->Title;	
					}?>	
					data.cols="<?php echo urlencode(json_encode($cols));?>";
					<?php
						$filename=$this->DownloadFileName;
						$filename=preg_replace('#<(.*?)>(.*?)</(.*?)>#', '_',$filename);
						$filename=preg_replace('/<.*?>/', '_',$filename);
						$filename=preg_replace('#_.*?#', '',$filename);
						$p=@strpos($filename, "_");						
						if($p>=0){
							//$filename=substr($filename, 0,$p);
						}
						
						//$filename=str_replace(array(" ","&nbsp;"), array("_","_"), $filename) ;
					?>
					data.filename="<?php echo $filename;?>";				
			 		var durl="<?php echo $this->url.(strpos($this->url,"?")?"&":"?");?>"+serialize(data);			 		
			 		jQuery("#difrm").attr("src",durl);			 		
		 	}
		 	function Grid_<?php echo $tableId?>_custom_reload(){
		 		var IsMultiSearch=<?php echo $this->multisearch?"true":"false";?>;	
		 		var data = jQuery("<?php echo $this->GetGridId();?>").jqGrid("getGridParam", "postData");				
		 		data.first=true;data.download_csv = false;	
	 			data.isMultiSearch=IsMultiSearch;
		 		if(IsMultiSearch){		 			
		 			data.ms=jQuery("#ms_<?php echo $tableId;?>").serialize();
		 		}
				jQuery("<?php echo $this->GetGridId();?>").jqGrid("setGridParam", { "postData": data });
		 		Grid_<?php echo $tableId?>_reload();
		 		sbtnclick_<?php echo $tableId;?>=false;
		 		//alert("Test");
		 	}
		 	function Grid_<?php echo $tableId?>_reset_custom_reload(){
		 		jQuery("#ms_<?php echo $tableId;?>")[0].reset();
		 		Grid_<?php echo $tableId?>_custom_reload();
		 	}
			function Grid_<?php echo $tableId?>_advance_search(){
				jQuery("<?php echo $this->GetGridId();?>").jqGrid('searchGrid');	
				$("body > .ui-widget-overlay").prependTo(".gs-jq-grid ");
				$("#searchhdfbox_<?php echo $this->GetGridId(true);?>").addClass("alert-info");
				$("#searchmodfbox_<?php echo $this->GetGridId(true);?>").addClass("jqgrid-input");
				$("#searchmodfbox_<?php echo $this->GetGridId(true);?> .ui-jqdialog-title").html('<i class="fa fa-search"></i> Advance Search');
				$("#searchmodfbox_<?php echo $this->GetGridId(true);?>").prependTo(".gs-jq-grid ").css("display","block");
				

				
				
			}
			 function Grid_<?php echo $tableId?>_reload(){
				 var stype=jQuery("#<?php echo $srcDivId?> .srcOptionList option:selected").attr("stype");					
					var data = jQuery("<?php echo $this->GetGridId();?>").jqGrid("getGridParam", "postData");
					if(stype=="select"){
						data.searchString = jQuery("#<?php echo $srcDivId?> .srcSelectValue").val();
					}else if(stype=="date"){						
						data.searchString = ""+jQuery("#<?php echo $srcDivId?>_from .srcFrom").val();
						data.toString = ""+jQuery("#<?php echo $srcDivId?>_to .srcTo").val();
						data.searchOper = "bt";
					}else{	
						data.searchString = jQuery("#<?php echo $srcDivId?> .srcTextValue").val();
						data.searchOper = "eq";
					}		
				data.searchField = jQuery("#<?php echo $srcDivId?> .srcOptionList").val();
				data._search = true;					
					
				jQuery("<?php echo $this->GetGridId();?>").jqGrid("setGridParam", { "postData": data });							
				 jQuery("<?php echo $this->GetGridId();?>").trigger("reloadGrid");
				 data.first=false;
				 jQuery("<?php echo $this->GetGridId();?>").jqGrid("setGridParam", { "postData": data });
				
			 }	
		var config_<?php echo $tableId?>=<?php echo $this->GetJson();?>;	
		jQuery(function($){
			try{
				SetDateGridPicker();
			}catch(e){}
			<?php if( $this->width=="auto" && empty($this->container)){$this->autowidth=true;}?>
		
			config_<?php echo $tableId?>.afterInsertRow=eval(config_<?php echo $tableId?>.afterInsertRow);
			config_<?php echo $tableId?>.loadComplete=function(e){ SetLightBox();<?php echo $this->loadComplete?>(e); 
			<?php echo $tableId;?>_resize_height(e);
			<?php if($this->isShowNoRecordMsg){?>
			jQuery("#gview_<?php echo $tableId;?> .ui-jqgrid-bdiv .gridnorecord").hide().remove();
			 if (jQuery("#<?php echo $tableId;?>").getGridParam("records")==0) {				
				 jQuery("#gview_<?php echo $tableId;?> .ui-jqgrid-bdiv").append('<div class="gridnorecord" id="gridnorecord">'+jQuery("#<?php echo $tableId;?>").getGridParam("emptySetText")+'</div>');
			 }
			 <?php }?>
			};
			config_<?php echo $tableId?>.onSelectAll=function(aRowids,status){
				<?php
				if(!empty($this->OnSelectAll)){	 echo "return  ".$this->OnSelectAll?>(aRowids,status); <?php }?>
				 
			}
			
				
			<?php if(!empty($this->container)){?>
				if(config_<?php echo $tableId?>.width=="auto"){
					config_<?php echo $tableId?>.width=jQuery("<?php echo $this->container; ?>").width();
					if(config_<?php echo $tableId?>.width<minwidth_<?php echo $tableId;?>){
						config_<?php echo $tableId?>.width=minwidth_<?php echo $tableId;?>;
					}
					config_<?php echo $tableId?>.width-=<?php echo $this->rightPadding;?>;
				}			
			<?php }?>
			<?php 
				foreach ($this->CustomPostArray['jsf'] as $key=>$value){
					?>
					config_<?php echo $tableId?>.<?php echo $key;?>=<?php echo $value; ?>;
					<?php 
				}
			?>
			<?php 			
			foreach ($this->custom_searchoption as $keyy=>$value){
				$key=$this->tempIndex[$keyy];
				?>
				
				config_<?php echo $tableId?>.colModel[<?php echo $key;?>]= $.extend({}, config_<?php echo $tableId?>.colModel[<?php echo $key;?>], <?php echo $value;?>);
				<?php 
			}
			
			?>					
			jQuery("#<?php echo $tableId;?>").jqGrid(config_<?php echo $tableId?>);
			jQuery("#<?php echo $tableId;?>").jqGrid('navGrid','<?php echo $this->pager;?>',{edit:false,add:false,del:false <?php if(!$this->ShowDefaultSearch){?>,search:false<?php }?>,reloadtext:"Reload",searchtext:" Search&nbsp;"},{},{},{},{sopt:['cn','bw','eq','ne','lt','gt','ew']} <?php if($this->multisearch){?> ,{multipleSearch:true}<?php }?>);
			$("#<?php echo "pager_".$tableId;?>").after(jQuery("#alertmod_<?php echo $tableId;?>"));
			<?php if($this->toolbar[0] && !empty($this->toolbarControl)){?>
			jQuery("#t_<?php echo $tableId;?>").append("<?php echo addslashes($this->toolbarControl);?>");
				<?php if($this->toolbarHeight){?>
					jQuery("#t_<?php echo $tableId;?>").height(<?php echo (int)$this->toolbarHeight;?>)
				<?php }?>			
				jQuery(".smtoolbar").hover(function(){$(this).addClass("ui-state-hover")},function(){$(this).removeClass("ui-state-hover")});
				<?php if(!empty($this->toolbarCSS)){ ?>
				    var oldS=jQuery("#t_<?php echo $tableId;?>").attr("style");
					jQuery("#t_<?php echo $tableId;?>").attr("style",oldS+" <?php echo $this->toolbarCSS;?>");
				<?php }?>
			<?php } if(false && !empty($this->multisearch)){?>	
				jQuery("<?php echo $this->GetGridId();?>").jqGrid('navGrid','#pager_<?php echo $tableId?>',{add:false,del:false,search:true,refresh:false},{},{},{},{multipleSearch:true});
			<?php 
			}
			if($this->ShowDownloadButtonInBottom){
			?>
			var dlbutton='<td style="width:4px;" class="ui-pg-button ui-state-disabled"><span class="ui-separator"></span></td><td class="ui-pg-button ui-corner-all" title="Download CSV" id=""><div class="ui-pg-div"><a onclick="<?php echo $this->DownloadCSVMethod();?>();" class="grid-btn-footer btn btn-success btn-xs"><i class="fa fa-download "></i> Download CSV</a></div></td>';
			jQuery("#refresh_<?php echo $tableId?>").after(dlbutton);
			<?php 
			}
			if(!empty($this->beforeSelectRow)){?>			
			jQuery("<?php echo $this->GetGridId();?>").jqGrid('setGridParam',{beforeSelectRow:function(rowid, e) {
				return <?php echo $this->beforeSelectRow?>(rowid, e);
			}});				
			<?php }?>
			<?php if(!empty($this->searchbtn)){?>
				jQuery("<?php echo $this->searchbtn;?>").click(function(e){ 
					e.preventDefault();	
					jQuery("#<?php echo $tableId;?>").jqGrid('searchGrid', {sopt:['bw','cn']} ); 
				});
			<?php }?>
		
			<?php if($this->width=="auto" && !empty($this->container)){?>
			jQuery(window).bind('resize', function() {
				<?php echo $tableId;?>_ResizeGrid();	
			}).trigger('resize');	
			try{				
			jQuery('body').resize(function() {
				<?php echo $tableId;?>_ResizeGrid();				
			});
			}catch(e){}
			<?php }?>	
			try{
				AddOnPageResize(<?php echo $tableId;?>_ResizeGrid);
			}catch(e){
			}
			 var applyClassesToHeaders = function (grid) {
			        // Use the passed in grid as context, 
			        // in case we have more than one table on the page.
			        var trHead = jQuery("thead:first tr", grid.hdiv);
			        var colModel = grid.getGridParam("colModel");					
			        for (var iCol = 0; iCol < colModel.length; iCol++) {
			            var columnInfo = colModel[iCol];			         
			            if (columnInfo.thclasses) { 
			                var headDiv = jQuery("th:eq(" + iCol + ")", trHead);			              
			                headDiv.addClass(columnInfo.thclasses);
			            }
			        }
			  };
			  try{
			  applyClassesToHeaders(jQuery("#<?php echo $tableId;?>"));
			 }catch(e){}

			 <?php $this->DisplayTooltip();?>
		});
		function <?php echo $tableId;?>_resize_height(e){
			if(jQuery("<?php echo $this->container;?>").hasClass('grid-full-screen')){
				return;
			}
			try{
				if(config_<?php echo $tableId?>.height=="auto"){
					return;
				}
				var data= config_<?php echo $tableId?>.auto_height_records;			
				if(e.records<data){
					jQuery("#<?php echo $tableId;?>").setGridHeight('auto');
				}else{
					jQuery("#<?php echo $tableId;?>").setGridHeight(config_<?php echo $tableId?>.height);
				}
				//console.log(config_<?php echo $tableId?>.height);
			}catch(e){}
		}
		function <?php echo $tableId;?>_ResizeGrid(){
			if(jQuery("<?php echo $this->container;?>").hasClass('grid-full-screen')){
				return;
			}
			var c_minwidth_<?php echo $tableId;?>=jQuery("<?php echo $this->container;?>").width();
			if(c_minwidth_<?php echo $tableId;?><=minwidth_<?php echo $tableId;?>){
				c_minwidth_<?php echo $tableId;?>=minwidth_<?php echo $tableId;?>;
			}
			<?php if($this->rightPadding>0){?>
				c_minwidth_<?php echo $tableId;?>-=<?php echo $this->rightPadding;?>;
			<?php }else{ ?>
				c_minwidth_<?php echo $tableId;?>-=5;
			<?php }?>
			jQuery("#<?php echo $tableId;?>").setGridWidth(c_minwidth_<?php echo $tableId;?>);
			var windowWidth=jQuery(window).width();
			if(windowWidth<=768){
				<?php foreach ($this->hidecols['xs'] as $hcol){?>
				jQuery("#<?php echo $tableId;?>").hideCol("<?php echo $hcol;?>");
				<?php }?>
				<?php foreach ($this->hidecols['sm'] as $hcol){?>
				jQuery("#<?php echo $tableId;?>").hideCol("<?php echo $hcol;?>");
			<?php }?>
			}else{
				<?php foreach ($this->hidecols['xs'] as $hcol){?>
				jQuery("#<?php echo $tableId;?>").showCol("<?php echo $hcol;?>");
				<?php }?>
				<?php foreach ($this->hidecols['sm'] as $hcol){?>
				jQuery("#<?php echo $tableId;?>").showCol("<?php echo $hcol;?>");
				<?php }?>
			}
			if(windowWidth<=991){
				<?php foreach ($this->hidecols['xs'] as $hcol){?>
					jQuery("#<?php echo $tableId;?>").hideCol("<?php echo $hcol;?>");
				<?php }?>
				
			}else{
				<?php foreach ($this->hidecols['xs'] as $hcol){?>
					jQuery("#<?php echo $tableId;?>").showCol("<?php echo $hcol;?>");
				<?php }?>
				
			}
		
		}
		</script>
<div id="mc_<?php echo $tableId?>" class="gs-jq-grid ">
	<table id="<?php echo $tableId?>"></table>
	<div id="<?php echo "pager_".$tableId;?>"></div>
</div>

<?php 
	}
	function RowIndex($id){	
			$this->AddCustomModel(array("search"=>false,"sortable"=>false,"hidden"=>true,"key"=>true,"index"=>$id,"name"=>$id,"viewable"=>false));	
						
	}	
	function AddModelHidden($id){	
			$this->AddCustomModel(array("search"=>false,"sortable"=>false,"hidden"=>true,"index"=>$id,"name"=>$id,"viewable"=>false));	
						
	}
	
	
	function AddSearchProperty($title,$index_id,$search_type="",$searctionObtionValue=array()){
		//$this->AddModel($title, $index_id, $width,$align,"","","",true,$search_type,$searctionObtionValue,$isSortable);
		$searchoptions=null;
		$extraparam="";
		if(is_array($searctionObtionValue) && $search_type=="select" && (count($searctionObtionValue)>0)){
			$searchoptions=new stdClass();
			$searchoptions->value=new stdClass();
			foreach ($searctionObtionValue as $key=>$val){
				$searchoptions->value->$key=$val;
			}
		}elseif (is_string($searctionObtionValue)){
			$extraparam=$searctionObtionValue;
		}	
			
		$this->AddCustomModel(
						array(  "Title"=>$title,
								"search"=>true,
								"sortable"=>false,
								"hidden"=>true,
								"index"=>$index_id,
								"name"=>$index_id,
								"viewable"=>false,
								"stype"=>"$search_type",
								"searchoptions"=>$searchoptions,
								"ExtraParam"=>$extraparam
		));
		
			
	}
	function AddHiddenProperty($index_id){
		//$this->AddModel($title, $index_id, $width,$align,"","","",true,$search_type,$searctionObtionValue,$isSortable);
		
		$this->AddCustomModel(
				array(  "Title"=>$index_id,
						"search"=>false,
						"sortable"=>false,
						"hidden"=>true,
						"index"=>$index_id,
						"name"=>$index_id,
						"viewable"=>false						
				));
			
	}
	function AddModelCustomSearchable($title,$index_id,$width ,$align="left",$search_type="",$searctionObtionValue=array(),$isSortable=true){
		$this->AddModel($title, $index_id, $width,$align,"","","",true,$search_type,$searctionObtionValue,$isSortable);
	}
	function AddModelNonSearchable($title,$index_id,$width ,$align="left",$formatter="",$isSortable=false){
		$this->AddModel($title, $index_id, $width,$align,$formatter,"","",false,'','',$isSortable);
	}
	function AddCustomModel($properties=array()){
		if(empty($properties["index"])){
			return;
		}
		$Model=new GridModel();
		foreach ($properties as $key=>$property){
			$Model->$key=$property;
		}
		$keyy=$properties["index"];
		$this->tempIndex[$keyy]=count($this->colModel);
		array_push($this->colModel,$Model);
	}	
	function AddSortableModel($title,$index_id,$width ,$align="left",$formatter="",$srcformat="",$newformat="",$isSearchable=true,$stype="",$serchoption="",$isSortable=true){
		$this->AddModel($title,$index_id,$width ,$align,$formatter,$srcformat,$newformat,$isSearchable,$stype,$serchoption,$isSortable);
	}
  	function AddModel($title,$index_id,$width ,$align="left",$formatter="",$srcformat="",$newformat="",$isSearchable=true,$stype="",$serchoption="",$isSortable=false){
  		$Model=new GridModel();
  		$Model->Title=$title;
		$Model->name=$index_id;
		$Model->width=$width;
		$Model->index=$index_id;
		$Model->align=$align;
		$Model->sortable=$isSortable;		
		if(!$isSearchable){
			$Model->search=false;
		}
		if(!empty($stype)){
			$Model->stype=$stype;
		}
		if(is_array($serchoption) && $stype=="select" && (count($serchoption)>0)){
			$Model->searchoptions=new stdClass();
			$Model->searchoptions->value=new stdClass();
			foreach ($serchoption as $key=>$val){
				$Model->searchoptions->value->$key=$val;
			}
		}elseif(is_string($serchoption)){
			$Model->ExtraParam=$serchoption;
		}
		/*if(!empty($custom_search)){	
			$lastIndex=count($this->colModel);		
			$this->custom_searchoption[$lastIndex]="{editable: true,stype: 'select',searchoptions:{value:{1:'One',2:'Two'}},search:true }";
		}*/
  		if(!empty($formatter)){
  			$Model->formatter=$formatter;			
		}
		$Model->formatoptions=new stdClass();
		if(!empty($srcformat)){			
			$Model->formatoptions->srcformat=$srcformat;
		}
  		if(!empty($newformat)){
  			$Model->formatoptions->newformat=$newformat;			
		}
		$this->tempIndex[$index_id]=count($this->colModel);
		array_push($this->colModel,$Model);
		$this->TotalColumn++;
  	}
  	/* for Toolbar*/
	function SetToolBarPosition($position="top"){
		$this->toolbar=array(true,$position);
	}
	function AddToolbarContent($content){
		$this->toolbarControl.='<div class="ui-pg-div smtoolbar">'.$content.'</div>';
	}
	function AddToolbarButton($btnId,$btnText,$iconClass,$onClickMethod=""){
		$this->toolbarControl.='<div id="'.$btnId.'" onclick="'.$onClickMethod.'();" class="ui-pg-div ui-corner-all smtoolbar toolButton"><span class="'.$iconClass.'"></span>'.$btnText.'</div>';
	}
	
	/**
	 * Set Toolbar Height ...
	 * @param integer $heightInt
	 */
	function SetToolbarHeight($heightInt){
		$this->toolbarHeight=$heightInt;
	}
	/**
	 * Enter description here ...
	 * @param intger $top in px
	 * @param integer $bottom in px
	 */
	function SetToolbarPadding($top,$bottom=0){	
		$this->toolbarCSS.="padding:".$top."px 0px ".$bottom."px 0px;";
	}
  	/* end toolbar*/
function GetCustomSearch(){
  		$tableId=$this->GridId;	
		 $srcDivId="src_$tableId";	
		 $srcMFromId="ms_$tableId";
		 ob_start();
		 if(!$this->multisearch){		 
		?>		
		<div class="grid-search-panel">
<div class="gs-grid-serach row form-horizontal" id="<?php echo $srcDivId;?>"	style="padding: 5px;">
	<div class="col-xs-4 ">
		<div class="form-group">
			<label for="selectpropery" class="control-label first-label col-sm-6 hidden-xs"><span class="hidden-sm"><?php _e("Select"); ?></span> <?php _e("Property"); ?></label>
			<div class="col-sm-6 row">
			<select class="input-sm srcOptionList form-control">
			 	<?php 
			 	$already=array();
			 	foreach ($this->colModel as $model){
					if(in_array($model->name, $already)){continue;}	
			 		if(!isset($model->search) ||$model->search){
			 			$datatest="";
			 			array_push($already, $model->name);
			 			if(!empty($model->searchoptions)){
			 				if(!empty($model->searchoptions->value) && count($model->searchoptions->value)>0){
			 					$datatest="data='".json_encode($model->searchoptions->value)."'";
			 				}
			 			}
			 			echo "<option stype='".(!empty($model->stype)?$model->stype:"")."' $datatest  value='$model->name'>$model->Title</option>";
			 		}
			 		?>		 		
			 	<?php }?>
			 	</select>
			 	</div>
		</div>
	</div>
	<div class="col-xs-8 ">	
	<form id="<?php echo $srcMFromId;?>" onsubmit="return false;">
	<div class="row">	
	<div id="<?php echo  $srcDivId."_text"?>" class="col-xs-8">
		<div class="form-group">
			<label for="srcText" class="control-label col-sm-6 hidden-xs"><span class="hidden-sm"><?php _e("Select"); ?></span> <?php _e("Value"); ?></label>
			<div class="col-sm-6">			
				<input autocomplete="off" class="srcTextValue form-control input-sm"
					type="text" name="srcText" value="" /> <select
					class="input-sm srcSelectValue form-control" style="display: none;"
					name="srcText">					

				</select>
			</div>
		</div>
	</div>	
	<div id="<?php echo  $srcDivId."_from"?>" class="col-xs-4 hidden">
		<div class="form-group">
			<label for="srcText" class="control-label col-sm-2">From</label>
			<div class="col-sm-10">
				<div class="input-group date gs-date-picker-grid-options">
					<input autocomplete="off" class="input-xs srcTextValue form-control srcFrom input-sm" 	type="text" name="srcFrom" value="" /> 
					<span class="input-group-addon" style="height: 24px !important; padding:6px 3px 0px 1px!important; line-height: 4px !important;"><span style="font-size: 8px !important;" class="fa fa-calendar"></span></span>
				</div>
			</div>
		</div>
	</div>
	<div id="<?php echo $srcDivId."_to"?>" class="col-xs-4 hidden">
		<div class="form-group">
			<label for="srcText" class="control-label col-sm-2"><?php _e("To"); ?></label>
			<div class="col-sm-10">
				<div class="input-group date gs-date-picker-grid-options" data-date-format="YYYY-MM-DD" >
				<input autocomplete="off" class="srcTextValue form-control  srcTo input-sm"  	type="text" name="srcTo" value="" />
				<span class="input-group-addon" style="height: 24px !important; padding:6px 3px 0px 1px!important; line-height: 4px !important;"><span style="font-size: 8px !important;" class="fa fa-calendar"></span></span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-4">
		<?php /*?>		
		<span class="hidden-xs hidden-sm"><input class="gs-icheck " id="autosearch_<?php echo $tableId;?>"
			type="checkbox"></span>
		<label class="text-xs hidden-xs hidden-sm"	for="autosearch_<?php echo $tableId;?>"><?php _e("Auto Search") ; ?></label>
		<?php // */?>
		
		<a class="btn btn-xs btn-warning"
			onclick="javascript:Grid_<?php echo $tableId?>_custom_reload();"><i
			class="fa fa-search"></i><?php _e("Search") ; ?></a>
			<a class="btn btn-xs btn-danger" onclick="javascript:Grid_<?php echo $tableId?>_reset_custom_reload();"><i class="fa fa-times"> </i> <?php _e("Reset") ; ?></a>
			<?php if($this->ShowAdvanceSearch){?>
			<a class="btn btn-xs btn-warning"
			onclick="javascript:Grid_<?php echo $tableId?>_advance_search();"><i
			class="fa fa-search"></i><?php _e("Advance Search") ; ?></a>				
			<?php }?>	
				
		 <?php if($this->IsCSVDownload){?>
		  &nbsp;<a class="btn btn-sm btn-warning"
			onclick="javascript:Grid_<?php echo $tableId?>_reload();"><i
			class="fa fa-download"></i>CSV Download</a>
		 <?php }?>
	</div>
	
	</div>	
	</form>
	</div>
	<div class="clear"></div>
</div>
</div>

<?php 
}else{
	$already=array();	
	?>
	<div class="grid-search-panel">
	<div class="gs-grid-serach row form-horizontal" id="<?php echo $srcDivId;?>"	style="padding: 5px;">
		<div class="col-xs-12 ">		
			<div class="panel panel-default">
			  <div class="src-heading panel-heading"><?php _e("Search"); ?>			  	
			  	 <a class="pull-right btn btn-xs btn-warning" onclick="javascript:Grid_<?php echo $tableId?>_custom_reload();"><i class="fa fa-search"> </i> <?php _e("Search") ; ?></a>
			  	 <a class="pull-right btn btn-xs btn-danger" onclick="javascript:Grid_<?php echo $tableId?>_reset_custom_reload();"><i class="fa fa-times"> </i> <?php _e("Reset Search") ; ?></a>
			  </div>
			  
			  <div class="panel-body p-l-zero p-r-zero">
			  <form id="<?php echo $srcMFromId;?>" onsubmit="return false;">
			  	<?php 
			  	$leftCol="";
			  	$rightCol="";
			  	$mi=1;			  
			  	foreach ($this->colModel as $model){
					if(in_array($model->name, $already)){continue;}
				  	if(!isset($model->search) ||$model->search){			
						array_push($already, $model->name);
				  		$datatest="";
				  
							ob_start();
							?>
							<div class="form-group ">
				      		    <label class="col-sm-2 col-md-4 control-label" for="name"><?php echo $model->Title; ?></label>
				      		    <?php if(empty($model->stype) ||$model->stype=="text" ){?>
				      		    <div class="col-sm-10 col-md-8">	
					      		   	<?php if(in_array($model->name,$this->MultiSearchOperator)){?> 
					      		   	 <div class="input-group input-group-sm">					      		     
	      								<div class="input-group-addon operator">
	      									<select name="op[<?php echo $model->name;?>]" class="">
	      										<option value="eq">=</option>
	      										<option value="gr">></option>
	      										<option value="lg"><</option>
	      									</select>
	      								</div>	
	      								<?php }?>	      										      		    	
					      		    	<input type="text" value="<?php echo $model->dvalue;?>" class="form-control input-sm" id="<?php echo $model->name;?>" name="ms[<?php echo $model->name;?>]" placeholder="<?php echo $model->Title; ?>"></input>
					      		 			<?php if(in_array($model->name,$this->MultiSearchOperator)){?> 
					      		 	</div>
					      		 	<?php }?>
				      		 	</div>
				      		 	<?php }elseif(strtolower($model->stype)=="date"||strtolower($model->stype)=="dateonly" || strtolower($model->stype)=="datetime"){
				      		 		$maintype=strtolower($model->stype);
				      		 		$placeholder=__("Form"); 
				      		 		$custom="";
				      		 		if($maintype=='dateonly'){
				      		 			$model->stype="date";				      		 			
				      		 			$placeholder=$model->Title;
				      		 		}
				      		 		if(!empty($model->ExtraParam) && is_string($model->ExtraParam)){
				      		 			$custom="-custom";
				      		 		}
				      		 		if( strtolower($model->stype)=="datetime"){
				      		 			$model->dvalue=!empty($model->dvalue)?date('Y-m-d H:i',strtotime($model->dvalue)):"";
				      		 			$model->dvalue2=!empty($model->dvalue2)?date('Y-m-d H:i',strtotime($model->dvalue2)):"";
				      		 		}
				      		 	?>
				      		 	 <div class="col-sm-<?php echo $maintype=="dateonly"?10:5;?> col-md-<?php echo $maintype=="dateonly"?8:4;?>">
				      		 		 <div class="input-group <?php echo strtolower($model->stype)?> gs-<?php echo strtolower($model->stype).$custom;?>-picker-grid-options"  >
										<input autocomplete="off" class="srcTextValue form-control srcMFrom" 	type="text" name="ms[<?php echo $model->name;?>]<?php if($maintype!="dateonly"){?>[from]<?php }?>" value="<?php echo $model->dvalue;?>" placeholder="<?php echo $placeholder;?>"  <?php echo !empty($custom) ? ' data-format="'.$model->ExtraParam.'"' :'';?>  /> 
										<span class="input-group-addon" style="height: 24px !important; padding:2px 2px 0px 1px ; line-height: 4px !important;"><span style="font-size: 12px !important;" class="fa <?php echo strtolower($model->stype)=="date"?' fa-calendar ':' fa-clock-o '?>"></span></span>
									</div>
				      		 	 </div>
				      		 	  <?php if($maintype!="dateonly"){?>
				      		 	 <div class="col-sm-5 col-md-4">
				      		 	 	 <div class="input-group <?php echo strtolower($model->stype)?>  gs-<?php echo strtolower($model->stype).$custom;?>-picker-grid-options" >
										<input autocomplete="off" class="srcTextValue form-control srcMFrom" 	type="text" name="ms[<?php echo $model->name;?>][to]" value="<?php echo $model->dvalue2;?>"  placeholder="<?php _e("To"); ?>"   <?php echo !empty($custom) ? ' data-format="'.$model->ExtraParam.'"' :'';?>  />										
										<span class="input-group-addon" style="height: 24px !important; padding:2px 2px 0px 1px ; line-height: 4px !important;"><span style="font-size: 12px !important;" class="fa <?php echo strtolower($model->stype)=="date"?' fa-calendar ':' fa-clock-o '?>"></span></span>										
									</div>
				      		 	 </div>
				      		 	 <?php }?>
				      		 	<?php }elseif(strtolower($model->stype)=="select"){
				      		 		
				      		 	?>
				      		 	 	<div class="col-sm-10 col-md-8">				      		 	 					      		    	
				      		    		<select class="form-control input-sm" id="<?php echo $model->name;?>" name="ms[<?php echo $model->name;?>]">
				      		    			<?php
				      		    			if(!empty($model->searchoptions->value) && count($model->searchoptions->value)>0){											
				      		    				foreach ($model->searchoptions->value as  $value=>$title){
													?>
													<option <?php echo $model->dvalue==$value?' selected="selected" ':'';?> value="<?php echo $value?>"><?php echo $title;?></option>
													<?php 
												}	
				      		    			} 
				      		    			?>
				      		    		</select>
				      		 		</div>
				      		 	<?php }?>
			      		 	</div>			      		 	
							<?php 
							if($mi==1){
								$leftCol.=ob_get_clean();
								$mi=0;
							}else{
								$rightCol.=ob_get_clean();
								$mi=1;
							}
							
						
					}
				}
			  	?>
			      <div class="col-md-6 form form-horizontal">
			      		<?php echo $leftCol;?>
			      </div>
			      <div class="col-md-6">
			      		<?php echo $rightCol;?>
			      </div>
			      </form>
			  </div>
			</div>
		</div>
	</div>
	</div>
	<?php 
}
		 $output = ob_get_contents();
		 ob_end_clean();
	
		echo $output;
  	}
}
if(!class_exists("GridModel")){
	class GridModel{
		public $Title;
		public $objectName;
		public $width;
		public $name;
	  	public $index;
	  	public $formater="number";
	  	public $sopt;
	  	public $sortable;
	  	public $dvalue="";
	  	public $dvalue2="";
	  	public $ExtraParam;
	}
}
if(!function_exists("_e")){
    function _e($string, $parameter = null, $_ = null)
    {
        $args=func_get_args();
        echo call_user_func_array("sprintf",$args);            
    }
}
