<div class="row">
<div class="text-center">
<div class="col-md-12  src-main-container" style="position: relative;z-index: 999;">
    <div class="form-group form-group-lg m-t-5" style="z-index: 99;">
       <div class="input-group">	
          <span class="input-group-addon"><i class="fa fa-search faa-tada"></i></span>		 
    	  <input class="form-control auto-complete-off-processed src-input" name="item_search" id="app-src-input" placeholder="<?php _e("Search"); ?>" autocomplete="off" type="search"> 
    	   
       </div>
   </div>
   
   <div id="app-src-container" class="row src-container text-left" style="z-index: 90;">
        <div class="" style="margin-top: -11px;position: absolute;left: 0;right: 0;top: 0;">
            <div class="panel panel-default">             
              <div class="panel-body" style="padding-top: 58px;">
              	<div class="app-loader bar-black sm-loader m-t-15">
                    <div class="bar1"></div><div class="bar2"></div><div class="bar3"></div><div class="bar4"></div><div class="bar5"></div><div class="bar6"></div>
                </div>
                <div class=" app-src-list-content" >
                
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
jQuery(function(){
	$("#app-src-input").focusin(function() {
		$("#app-src-container").show();
	});
	$("#app-src-input").focusout(function() {
		close_src_panel();
	});
	$("#app-src-input").keyup(function(e) {
		 var va=$(this).val();
		 //console.log(va);
		 if(va.length>2){
			var data={src:va};
			showSrcLoader();
			 search_delay(function(){
				 $.ajax({
				        url: appGlobalLang.src_url,
				        data: set_csrf_param(data),
				        type: "POST",
				        scriptCharset: "utf-8",
				        dataType: "json",
				        beforeSend: function() {
				        		        	 
				        },
				        success: function(rdata) {
				        	app_set_src_list(rdata);
				        },
				        complete: function(jqXHR, textStatus) {
				        	showSrcLoader(true);
				        }
				    });
			   }, 600 );
		 }else{
			 //close_src_panel();
		 }
	});
	$("body").on("click",function(e){
		close_src_panel(true);
	});
	$(".src-main-container").on("click",function(e){
		e.stopPropagation();
	});
});
function showSrcLoader(is_hide){
	if(typeof is_hide =="undefined"){
		is_hide=false;
	}
	if(is_hide){		
		$("#app-src-container .app-loader").hide();
	}else{
		$("#app-src-container .app-src-list-content").hide();
		$("#app-src-container .app-loader").fadeIn();
	}		
}
function close_src_panel(is_force){
	if(typeof is_force =="undefined"){
		is_force=false;
	}
	if(is_force || !$("#app-src-container").hasClass("app-srced")){		
		$("#app-src-container").removeClass("app-srced").hide();
		$("#app-src-container .app-loader").fadeOut();
		
	}
}
var search_delay = (function(){
	  var timer = 0;
	  return function(callback, ms){
	    clearTimeout (timer);
	    timer = setTimeout(callback, ms);
	  };
	})();
function app_set_src_list(items){
	//gcl(items.length);
	if(items.total>0){
		var htmltext=gen_app_src_ul(items);
		$("#app-src-container .app-src-list-content").removeClass("text-center").html(htmltext);
	}else{
		$("#app-src-container .app-src-list-content").addClass("text-center").html("<?php _e("No search result found") ?>");
	}
	$("#app-src-container .app-src-list-content").show();
}
function gen_app_src_ul(items){
	$("#app-src-container").addClass("app-srced");
	if(items.total>0){
    	var ulstr='<ul class="kn-list">';
        for(var i=0; i<items.data.length;i++){         
        	ulstr+='<li class=" p-5  ">\
    		<div class="kn-title">\
    			<h3 class="m-0">\
    			<a href="'+items.data[i].href+'">'+items.data[i].title+'</a>\
    			 <span class="cat-container" >in '+items.data[i].cat_link+'</span>\
    				<span class="kn-like pull-right text-success"><i class="fa fa-thumbs-up "></i> '+items.data[i].l_count+'</span>\
    		</h3>\
    		</div>\
    	</li>'; 
        } 
        if(items.total>items.data.length){
            ulstr+='<li class=" p-5  text-center"><a href="'+items.full_url+'">Total Result ('+items.total+')</a></li>'; 
        }	
        ulstr+='</ul>';
    	return ulstr;
	}else{
		return '';
	}
}
</script>