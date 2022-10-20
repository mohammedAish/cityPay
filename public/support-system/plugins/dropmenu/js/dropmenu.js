(function ( $ ) {
 
    $.fn.appdropdown = function( options ) {
 
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
			container: "body",
			buttonClass:"",
			submenuClass:"",
            onSelect:function(){},
            onOpen:function(){},
            onClose:function(){}
        }, options );
 
        // Greenify the collection based on the settings variable.
       /* return this.css({
            color: settings.color,
            backgroundColor: settings.backgroundColor
        });*/
      
        this.each( function() { 
        	var mainContainer=$(this);
        	var elemselector=$(this).data("content");   
			var elem=$(elemselector);
			//$(elemselector+".app-sub-menu").remove();		
			elem.addClass("app-sub-menu").addClass("app-dropdownmenu");
			if(settings.submenuClass!=""){
				elem.addClass(settings.submenuClass);
			}	
			if(settings.buttonClass!=""){
				mainContainer.addClass(settings.buttonClass);
			}		
        	elem.detach().appendTo(settings.container);
        	elem.hide();
            mainContainer.on("click",function(e){
            	e.stopPropagation();
            	//e.preventDefault();
            	var offset=mainContainer.offset();
            	var left=offset.left-elem.width();            	
            	if(left<0){
            		left=offset.left;
            	}else{
            		left+=10+mainContainer.width();
				}
				var top=offset.top+5+mainContainer.height();
				
				var windowBottom=$(window).height();
				var subcontainerHeight=elem.height();
				if(top+subcontainerHeight>windowBottom){
					top-=(subcontainerHeight+10+mainContainer.height());
				}
            	elem.css({top:top,left:left});            	
            	if($(this).hasClass("app-drop-open")){
            		$(this).removeClass("app-drop-open");
            		elem.fadeOut('fast');
            	}else{
					$(".app-drop-open").removeClass("app-drop-open");
					$(".app-sub-menu").fadeOut('fast');
            		$(this).addClass("app-drop-open");
					elem.fadeIn();
					
            	}
            	
            });
            elem.on("click",function(e){
            	//e.stopPropagation(); //it creating the problem of confirmAjaxWR
            	//e.preventDefault();
            	mainContainer.removeClass("app-drop-open");
        		elem.fadeOut('fast');
            });
            $(document).on("click",function(e){            	
            	mainContainer.removeClass("app-drop-open");
        		elem.fadeOut('fast');
            });
        });
       
    };
 
}( jQuery ));
