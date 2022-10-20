<?php
require_once 'APPChartConfig.php';
class APPChartJS{
    /**
     * @var APPChartConfig
     */
    public $chartConfig;
    public $height;
    public $chartid;
    public $data=null;
    public $url="";
    public $isAjax=false;
    private $data_form="";
    private $data_params=array();
    private $title="";
    public $IsShowReloadButton=true;
    public $IsLineBarSelectorn=true;
    private static $isAddedJs=false;
    private static $chartcounter=1;
    public $isReloadOnClose=false;
    public $beforeProcess=null;
    public $loaderMethod=null;
    public $loadComplete=null;
    function __construct(){
    	if(!self::$isAddedJs){
    		if(function_exists("add_js")){
    			self::$isAddedJs=true;
    			add_js("plugins/chartjs/Chart.bundle.js");
    		}
    	}
        $this->chartConfig=new APPChartConfig();
        $this->chartid="app_chart_".self::$chartcounter;
        self::$chartcounter++;
    }
    function add_param($key,$value){
        $this->data_params[$key]=$value;
    }
    function add_param_array($params){
       $this->data_params=array_merge($params,$this->data_params);
    }
    function add_chart_filter_form($html_form){
        $this->data_form=$html_form;
    }
    static function ShowByAjaxData($url,$height,$data_form="",$data_params=array(),$isReloadOnClose=false,$beforeProcess=null,$loaderMethod=null,$loadComplete=""){    	
    	$chart=new self();
    	$chart->height=$height;
    	$chart->isAjax=true;
    	$chart->url=$url;
    	$chart->data_form=$data_form;
    	$chart->data_params=$data_params;
    	$chart->isReloadOnClose=$isReloadOnClose;
    	$chart->beforeProcess=$beforeProcess;
    	$chart->loaderMethod=$loaderMethod;
    	$chart->loadComplete=$loadComplete;
    	$chart->show();
    }
    static function ShowChartByData($data,$height,$loaderMethod=null){
    	$chart=new self();
    	$chart->height=$height;
    	$chart->isAjax=false;
    	$chart->data=$data;    	
    	$chart->loaderMethod=$loaderMethod;    	
    	$chart->show();
    }
    function show(){
    	$height=is_numeric($this->height)?$this->height."px":$this->height;
        ?>
        <div id="ccontainer_<?php echo $this->chartid;?>" style="position: relative;">
        	<div class="chart-loader" style="display:none; position:absolute; left:0; right: 0;bottom: 0;top: 0;background: rgba(255, 255, 255, 0.82);z-index: 99;">
        		<div style="position: absolute; top: 45%; left: 0px; right: 0px; text-align: center; font-weight: bold; color: #635F5F; font-size: 20px;"><i class="fa fa-spinner fa-spin fa-fw"></i>Loading</div>
        	</div>
        	<?php if(true || !empty($this->title) || $this->IsShowReloadButton || $this->IsLineBarSelectorn){?>
            <div class="chart-header" style="visibility: hidden; min-height: 22px;">
                  <?php if($this->IsLineBarSelectorn){?>
                <div style="position: absolute;top:0;left:8px">                
                <select class="line-bar" style="border-radius: 3px; height:22px; border: 1px solid rgba(6, 6, 6, 0.04); color: rgb(255, 255, 255); background: rgb(51, 124, 183) none repeat scroll 0px 0px;">
                    <option value="line">Line</option>
                    <option value="bar">Bar</option>
                </select>
                </div>
                <?php }?>
                <div class="chart-title" style="text-align: center; font-size: 14px;"><?php echo $this->title;?></div>
                <?php if($this->IsShowReloadButton){?>
                <button style="position: absolute;top:0;right:10px;" class="reload-btn btn btn-xs btn-primary" type="button"><i class="fa fa-refresh"></i> Reload</button>
                <?php }?>
            </div>
            <?php }?>
            <canvas class="" id="<?php echo $this->chartid;?>" style="" height="<?php echo $height;?>">
            
            </canvas>
        </div>
        <script type="text/javascript">  
        <?php if(!empty($this->loaderMethod)){
        	echo "var {$this->loaderMethod}=null;";
        };?>      
        (function () {       	 
        	"use strict";
        	$("body").addClass("app-chart-loading");
          
         	var config=null;
         	<?php if(!$this->isAjax && !empty($this->data)){?>
         	config=<?php echo json_encode($this->data); ?>;
         	<?php };
            if((!empty($this->data_params) && is_array($this->data_params)|| is_object($this->data_params))&& count($this->data_params)>0){
         	?>
         	var param=<?php echo json_encode($this->data_params);?>;
         	<?php }else{ ?>
         	var param={};
         	<?php } ?>         	
         	var form_element=<?php echo !empty($this->data_form)?"'{$this->data_form}';":"null;";?>;
        	var app_ctx = jQuery("#<?php echo $this->chartid;?>");   
        	var chart_container = jQuery("#ccontainer_<?php echo $this->chartid;?>");   
        	var chartobject= null;
        	var last_type_selected="";
         	function LoadData(){  
         		<?php if(!$this->isAjax){?>
         		chartobject= new Chart(app_ctx, config);
    	    	if(config.type=="bar" || config.type=="line"){
    	    		chart_container.find("> .chart-header .reload-btn").hide();
    	    		chart_container.find("> .chart-header").css("visibility","visible");
    	    		chart_container.find("> .chart-header .line-bar").show();
    	    		chart_container.find("> .chart-header .chart-title").html(config.title);
    	    		var selectobj=chart_container.find(".line-bar");
    	    		selectobj.unbind("change");            	    		
    	    		selectobj.val(config.type);
    	    		selectobj.bind("change",function(e){
    	    			config.type=$(this).val();
    	    			last_type_selected=config.type;            	    			
    	    			clear_chart();
    	    			chartobject= new Chart(app_ctx, config);
 	    			});
 	    			
    	    	}else{
    	    		chart_container.find("> .chart-header .line-bar").hide();
    	    	}
                $("body").removeClass("app-chart-loading");
				<?php } else{ ?>
         		var obj = {};
         		if(form_element){         			
             	    $.each( jQuery(form_element).serializeArray(), function(i,o){
             	        var n = o.name,
             	        v = o.value;             	          
             	        obj[n] = obj[n] === undefined ? v: $.isArray( obj[n] ) ? obj[n].concat( v ): [ obj[n], v ];
             	    });  
         		} 
         		
             	var final_post_param=jQuery.extend(param,obj);    
             	
             	try{
             		final_post_param=set_csrf_param(final_post_param);
             	} catch(e){}   
             	
             	jQuery.ajax({             		
            		url : "<?php echo $this->url;?>",              
                    data : final_post_param,                   
                    type : "POST", 
                    scriptCharset: "utf-8",
                    dataType :"json",                   
            		beforeSend: function(){                		
            			chart_container.find("> .chart-loader").show();
                		
                	},		   
            	    success: function(rdata){	
            	    	var pos = $(document).scrollTop();
                	    <?php if(!empty($this->beforeProcess)){
                	    	echo $this->beforeProcess."(rdata);";
                	    }?>  	                	   
                	    config=rdata;
            	    	if(last_type_selected!=""){
            	    		config.type=last_type_selected;
            	    	}
            	    	
            	    	clear_chart();
            	    	try{
            	    		if(typeof config.title !== "undefined" && config.title!=""){	            	    		
            	    			chart_container.find("> .chart-header .chart-title").html(config.title);
            	    		}
            	    	}catch(e){}
            	    	
            	    	chartobject= new Chart(app_ctx, config);
            	    	$(document).scrollTop(pos);            	    	
            	    	if(config.type=="bar" || config.type=="line"){
            	    		chart_container.find("> .chart-header .line-bar").show();
            	    		var selectobj=chart_container.find(".line-bar");
            	    		selectobj.unbind("change");            	    		
            	    		selectobj.val(config.type);
            	    		selectobj.bind("change",function(e){
            	    			config.type=$(this).val();
            	    			last_type_selected=config.type;            	    			
            	    			clear_chart();
            	    			chartobject= new Chart(app_ctx, config);
         	    			});
         	    			
            	    	}else{
            	    		chart_container.find("> .chart-header .line-bar").hide();
            	    	}
            	    	<?php if(!empty($this->loadComplete)){?>
                	    	setTimeout(<?php echo $this->loadComplete;?>,1000);
                	    <?php }?>
            	    	
            	    	//console.log(config);
            	    },  
            	    complete:function(jqXHR, textStatus){
            	    	chart_container.find("> .chart-header").css("visibility","visible");
            	    	chart_container.find("> .chart-loader").fadeOut();
                        $("body").removeClass("app-chart-loading");
                	}
            	   
            	});
            	 <?php }?>
         	}
         	function clear_chart(){
         		if(chartobject){
    	    		chartobject.clear();
    	    		chartobject.destroy();
    	    		
        	    }
         	}
         	function type_change(param){
         		config.type=param;
         		chartobject= new Chart(app_ctx, config);
         	}
         	jQuery(function($){ 
         		chart_container.find("> .chart-header").css("visibility","hidden"); 
        		 <?php if(!empty($this->loaderMethod)){
                  	echo "{$this->loaderMethod}=function(){LoadData();}\n";
                  }else{?>      		    		
        		 LoadData();
        		 <?php }?>
        		 if(form_element){
        			 jQuery(form_element).submit(function(e){
        				 e.preventDefault();
            			 //alert("ok");
            			 LoadData();
         			 });
        		 }
        		 chart_container.find(".reload-btn").on("click",function(e){
        			 e.preventDefault();
        			 LoadData();
        		 });
        		 <?php if($this->isReloadOnClose){?>
        		 try{
        		 	AddOnCloseMethod(LoadData);
        		 }catch(e){}
        		 <?php }?>
            });
         
        }()); 
        </script>
        <?php 
    }
    
}
