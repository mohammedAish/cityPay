
		<div id="open-src" class="card card-default app-panel-box app-panel-box-hlight hidden animated">
			<div class="card-header"><?php _e("Suggested Knowledge"); ?></div>
		  <div class="card-body p-0">
		      	
		      	
		  </div>
		</div>
		
		<?php echo $this->getModule("categories");
		      echo $this->getModule("popular_knowledge");
		?>
		
		
		
<script type="text/javascript">
jQuery(function(){
	
	$("#title").keyup(function(e) {
		 var va=$(this).val();
		 //console.log(va);
		 if(va.length>2){
			var data={src:va};
			
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
				        	app_open_src_list(rdata);
				        },
				        complete: function(jqXHR, textStatus) {
				        	
				        }
				    });
			   }, 600 );
		 }
	});
	
});
var search_delay = (function(){
	  var timer = 0;
	  return function(callback, ms){
	    clearTimeout (timer);
	    timer = setTimeout(callback, ms);
	  };
	})();
function app_open_src_list(items){
	//gcl(items.length);
	if(items.total>0){
		var htmltext=gen_app_src_ul(items);
		$("#open-src .card-body").removeClass("text-center").html(htmltext);
	}else{
		$("#open-src .card-body").addClass("text-center").html("<p><?php _e("No Suggested Knowledge found"); ?></p>");
	}
	if(!$("#open-src").hasClass('hidden')){
		if(items.total>0){
    		if($("#open-src").hasClass('bounceIn')){
    			$("#open-src").removeClass("bounceIn")
    			$("#open-src").addClass("shake");
    		}else{
    			  $("#open-src").toggleClass("shake");
    		}
		}
		
	}else{
		$("#open-src").removeClass("hidden").addClass("bounceIn");
	}
}
function gen_app_src_ul(items){	
	if(items.total>0){
    	var ulstr='<ul class="kn-list ctg-list">';
        for(var i=0; i<items.data.length;i++){
        	ulstr+='<li class=" p-10  ">\
    		<div class="kn-title">\
    			<h5 class="m-0">\
    			<a href="'+items.data[i].href+'">'+items.data[i].title+'</a>\
    				<span class="kn-like ab-rt-1 text-success"><i class="fa fa-thumbs-up "></i> '+items.data[i].l_count+'</span>\
    		</h5>\
    		</div>\
    	</li>'; 
        } 
        if(items.total>items.data.length){
            ulstr+='<li class=" p-2  text-center"><a href="'+items.full_url+'">Total Result ('+items.total+')</a></li>';
        }	
        ulstr+='</ul>';
    	return ulstr;
	}else{
		return '';
	}
}
</script>	