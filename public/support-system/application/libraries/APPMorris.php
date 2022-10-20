<?php
/**
 * @author Sarwar Hasan
 *
 */
class APPMorris{
	const TYPE_AREA="Area";
	const TYPE_BAR="Bar";
	const TYPE_LINE="Line";
	const TYPE_DONUT="Donut";
	private $chartType="Line";
	/**
	 * @var APPMorisConfig
	 */
	public $config;
	
	private  $jsmethods=array('formatter');
	private  $jsevents=array();
	private  $ajaxurl="";
	private  $ajaxdata=array();
	private  $element_class="app-mchart-container";	
	private $cssttyle="";
	private $minheight="";
	private $isLiveData=false;
	private $LiveInterval=5000;
	private $reload_button_icon="";
	private static $updateFunctionPrinted=false;
	private static $elemcounter=1;
	private static $isLoadedCSSJS=false;
	private $filterForm="";
	function __construct($type=""){
		if(!empty($type)){
			$this->chartType=$type;
		}
		$this->config=new stdClass();
		$this->config->element="mem".self::$elemcounter++;
		$this->config->data=NULL;
		$this->config->xkey=NULL;
		$this->config->labels=NULL;
		$this->config->resize=true;
		$this->set_css("height", 400);
		
		if(!self::$isLoadedCSSJS){
			if(function_exists("add_js")){
				add_js('//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js');
				//add_js('//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js');
				/* Local*/				
				add_js("plugins/morris/morris.min.js");
			}
			
			if(function_exists("add_css")){
				//add_css('//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css');
				add_css('plugins/morris/morris.css');					
		
			}
			self::$isLoadedCSSJS=true;
		}
			
	}
	function set_live_data_interval($inSecond){
		$this->isLiveData=true;
		$this->LiveInterval=$inSecond*1000;
	}
	function show_reload_button($icon="fa fa-refresh"){
		$this->reload_button_icon=$icon;	
	}
	function set_data_url($value,$minheight="",$minwidth=""){		
		$this->ajaxurl=$value;
		//$this->set_data(NULL);
		if(!empty($minwidth)){
			$this->set_css("min-width", $minwidth);
		}
		if(!empty($minheight)){
			$this->set_css("min-height", $minheight);
		}
	}
	function set_filter_form($form_html_id){
		$this->filterForm=$form_html_id;
	}
	function set_request_data($key,$value){
		$this->ajaxdata[$key]=$value;
	}
	function set_css($property,$value){
		$this->cssttyle="{$property}:{$value};";
	}
	function set_element_class($value){
		$this->element_class=$value;
	}
	function set_custom_element($key,$value){
		$this->config->$key=$value;
	}
	function set_element($value){
		$this->config->element=$value;
	}
	function set_data($value){
		if(true || empty($this->ajaxurl)){
			$this->config->data=$value;
		}else{
			$this->config->data=array();
		}
	}

	function set_xkey($value){
		$this->config->xkey=$value;
	}
	function set_formatter($value){
		$this->config->formatter=$value;
	}

	function set_ykeys($value){
		$this->config->ykeys=$value;
	}

	function set_labels($value){
		$this->config->labels=$value;
	}

	function set_lineWidth($value){
		$this->config->lineWidth=$value;
	}

	function set_pointSize($value){
		$this->config->pointSize=$value;
	}

	function set_lineColors($value){
		$this->config->lineColors=$value;
	}

	function set_pointStrokeWidths($value){
		$this->config->pointStrokeWidths=$value;
	}

	function set_pointStrokeColors($value){
		$this->config->pointStrokeColors=$value;
	}

	function set_pointFillColors($value){
		$this->config->pointFillColors=$value;
	}

	function set_smooth($value){
		$this->config->smooth=$value;
	}

	function set_xLabels($value){
		$this->config->xLabels=$value;
	}

	function set_xLabelFormat($value){
		$this->config->xLabelFormat=$value;
	}

	function set_xLabelMargin($value){
		$this->config->xLabelMargin=$value;
	}

	function set_hideHover($value){
		$this->config->hideHover=$value;
	}

	function set_ymax($value){
		$this->config->ymax=$value;
	}

	function set_ymin($value){
		$this->config->ymin=$value;
	}

	function set_hoverCallback($value){
		$this->config->hoverCallback=$value;
	}

	function set_parseTime($value){
		$this->config->parseTime=$value;
	}

	function set_units($value){
		$this->config->units=$value;
	}

	function set_postUnits($value){
		$this->config->postUnits=$value;
	}

	function set_preUnits($value){
		$this->config->preUnits=$value;
	}

	function set_dateFormat($value){
		$this->config->dateFormat=$value;
	}

	function set_xLabelAngle($value){
		$this->config->xLabelAngle=$value;
	}

	function set_yLabelFormat($value){
		$this->config->yLabelFormat=$value;
	}

	function set_goals($value){
		$this->config->goals=$value;
	}

	function set_goalStrokeWidth($value){
		$this->config->goalStrokeWidth=$value;
	}

	function set_goalLineColors($value){
		$this->config->goalLineColors=$value;
	}

	function set_events($value){
		$this->config->events=$value;
	}

	function set_eventStrokeWidth($value){
		$this->config->eventStrokeWidth=$value;
	}

	function set_eventLineColors($value){
		$this->config->eventLineColors=$value;
	}

	function set_continuousLine($value){
		$this->config->continuousLine=$value;
	}

	function set_axes($value){
		$this->config->axes=$value;
	}

	function set_grid($value){
		$this->config->grid=$value;
	}

	function set_gridTextColor($value){
		$this->config->gridTextColor=$value;
	}

	function set_gridTextSize($value){
		$this->config->gridTextSize=$value;
	}

	function set_gridTextFamily($value){
		$this->config->gridTextFamily=$value;
	}

	function set_gridTextWeight($value){
		$this->config->gridTextWeight=$value;
	}

	function set_fillOpacity($value){
		$this->config->fillOpacity=$value;
	}

	function set_resize($value){
		$this->config->resize=$value;
	}

	function set_barColors($value){
		$this->config->barColors=$value;
	}

	function set_stacked($value){
		$this->config->stacked=$value;
	}
	function set_event($evtname,$jsfnname){
		$this->jsevents[$evtname]=$jsfnname;
	}
	function ReloadMethod(){
		return  'load_mchart_'.$this->config->element;
	}
	
	function show(){
		//GPrint($this->config);
		?>
		<div id="<?php echo $this->config->element;?>_container" class="app-full-mchart-container <?php echo $this->element_class;?>">
		<div class="chart-title"> Title </div>
		<?php if(!empty($this->ajaxurl)){?>
			<?php if(!$this->isLiveData && !empty($this->reload_button_icon)){?>
				<button class="chart-reloader-loader btn btn-xs btn-default" type="button"><i class=" <?php echo $this->reload_button_icon?>"></i>	</button>
						 
			<?php } ?>
			<div class="loader-container">
				<i class="chart-loader fa fa-spinner fa-spin"></i>
			</div>
		<?php }?>
		<div style="<?php echo $this->cssttyle;?>" class="app-mchart-container <?php echo $this->element_class;?>" id="<?php echo $this->config->element;?>">
		
		
		</div>
		</div>
		<script type="text/javascript">
		var chartobj_<?php echo $this->config->element;?>=null;
		function show_mchart_<?php echo $this->config->element;?>($){			
			<?php if(empty($this->ajaxurl)){?>	
				var mchrt=<?php echo json_encode($this->config);?>;
				<?php foreach ($this->jsmethods as $jsm){
				if(!empty($this->config->$jsm)){?>mchrt.<?php echo $jsm;?>=<?php echo $this->config->$jsm?>;<?php }	}?>			
				
				var mainobj=Morris.<?php echo $this->chartType;?>(mchrt);
				<?php foreach ($this->jsevents as $jsevt=>$fnname){?>
				mainobj.on('<?php echo $jsevt;?>',<?php echo $fnname;?>);
				<?php }	?>
				return mainobj;
			<?php }else{?>				
				load_mchart_<?php echo $this->config->element;?>(true);
				<?php if($this->isLiveData){?>
					setInterval(function(){						
						if(chartobj_<?php echo $this->config->element;?>){
							load_mchart_<?php echo $this->config->element;?>(false);
						}
					},<?php echo $this->LiveInterval;?>);
				<?php }elseif(!empty($this->reload_button_icon)){?>
					jQuery("#<?php echo $this->config->element;?>_container .chart-reloader-loader").click(function(e){
						e.preventDefault();
						$("#<?php echo $this->config->element;?>_container .loader-container").show();
						load_mchart_<?php echo $this->config->element;?>(false);
					});
					
				<?php }
				 if(!empty($this->filterForm)){?>
					 jQuery("#<?php echo $this->filterForm; ?>").submit(function(e){
						 e.preventDefault();
						 $("#<?php echo $this->config->element;?>_container .loader-container").show();
						 load_mchart_<?php echo $this->config->element;?>(false);
						});  
				 <?php }
								
				 }?>
		}

		
		<?php if(!empty($this->ajaxurl)){?>		
		function load_mchart_<?php echo $this->config->element;?>(isFirstLoad){
			if(typeof(isFirstLoad)=="undefined"){
				isFirstLoad=false;
			}			   
			var mchrt=<?php echo json_encode($this->config);?>;
			<?php foreach ($this->jsmethods as $jsm){
			if(!empty($this->config->$jsm)){?>mchrt.<?php echo $jsm;?>=<?php echo $this->config->$jsm?>;<?php }	}?>			 
			jQuery.ajax({
				url : '<?php echo $this->ajaxurl.(!empty($this->ajaxdata)?"?".http_build_query($this->ajaxdata):"");?>',             
			<?php if(!empty($this->filterForm)){?>
		        data : jQuery("#<?php echo $this->filterForm; ?>").serialize(),  
		        <?php }?>                 
		        type : "POST", 
		        scriptCharset: "utf-8",
		        dataType :"json",
				beforeSend: function() {
					if(isFirstLoad){
						$("#<?php echo $this->config->element;?>_container .loader-container").show();
					}
			    },		   
			    success: function(rdata){
				    //return;
				    if(isFirstLoad){
					    try{
						  // return;
					    	mchrt.data=rdata;
					    	chartobj_<?php echo $this->config->element;?>=Morris.<?php echo $this->chartType;?>(mchrt);
							<?php foreach ($this->jsevents as $jsevt=>$fnname){?>
							chartobj_<?php echo $this->config->element;?>.on('<?php echo $jsevt;?>',<?php echo $fnname;?>);
							<?php }?>
							
					    }catch(e){
						    console.log(e.message);
						}
				    }else{
				    	$("#<?php echo $this->config->element;?>_container .loader-container").show();							
				    	try{				    		
							
				    		chartobj_<?php echo $this->config->element;?>.setData(rdata);
				    	}catch(e){
				    		console.log(e.message);
					    }
				    	$("#<?php echo $this->config->element;?>_container .loader-container").hide();
				    }
			    },  
			    complete:function(jqXHR, textStatus){
			    	if(isFirstLoad){
			    		$("#<?php echo $this->config->element;?>_container .loader-container").hide();
			    	}
			    }
			});
		}					
		<?php }?>		
		jQuery(function($){		
			show_mchart_<?php echo $this->config->element;?>(jQuery);
		});
			
		</script>
		<?php 
	}
	/*
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	 */	
}
