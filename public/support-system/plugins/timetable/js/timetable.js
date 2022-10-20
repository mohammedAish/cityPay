/**
 * 
 */
(function($) {
	String.prototype.padLeft= function(len, c){
    	var s= this, c= c || '0';
    	while(s.length< len) s= c+ s;
    	return s;
	}
    $.fn.apptimetable = function( options ) {		
        // Establish our default settings
        var settings = $.extend({
            startWeekDay : 'sun',
            data        : null,
			minpx		:1,
			onResize:function(){},
			onInit:function(){}, 
			beforeTimeAdd:function(element,data){}, 
			afterTimeAdd:function(element,data){},
			finishTimeAdd:function(element){}
        }, options);
		var mainObject=$(this);
		var weekend=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];	
        return this.each( function() {
            // We'll get back to this in a moment
			$(this).addClass("app-time-table");
			$.extend($.fn, {
					addTimeData:function(data){
						var data = $.extend({
						content:'',
						day : '',
						cssClass:"",
						startTime : '00:00',
						endTime   : '01:00'          
					}, data);
					try{settings.beforeTimeAdd(mainObject,data);}catch(e){}					
					if(data.day!=''){	
						data.day=data.day.substr(0,3).toLowerCase();
						try{data.startTime=data.startTime.substr(0,5);}catch(e){}
						try{data.endTime=data.endTime.substr(0,5);}catch(e){}
						data.startTime+=":00";
						data.endTime+=":00";
						var startTime = new Date('1970-01-01T' + data.startTime + 'Z').getTime() / (1000*60);
						var endTime = new Date('1970-01-01T' + data.endTime + 'Z').getTime() / (1000*60);					
						
						var dataObj=$("#w-"+data.day);
						var post=dataObj.position();
						var topoffset=dataObj.parent().height();
						var width=dataObj.width();	
						var left=post.left+4;
						var top=post.top+topoffset;
						var timeSpan=(endTime-startTime)*settings.minpx;
						top+=startTime*settings.minpx;
						if (/chrom(e|ium)/.test(navigator.userAgent.toLowerCase())) {
							width+=10;
						}else{
							width+=8;
						}						
						$(this).append('<div data-day-id="#w-'+data.day+'" style="top:'+top+'px;left:'+left+'px;width:'+width+'px; height:'+timeSpan+'px;" class="app-week-time-span '+data.cssClass+'">'+data.content+'</div>');
						try{settings.afterTimeAdd(mainObject,data);}catch(e){}	
					}
				},
				resizeAppTimeTable:function(){
					$(mainObject).find(".app-week-time-span").each(function(){
						var dayid=$(this).data("day-id");
						var dataObj=$(dayid);
						var post=dataObj.position();
						var topoffset=dataObj.parent().height();
						var width=dataObj.width();	
						var left=post.left+4;
						if (/chrom(e|ium)/.test(navigator.userAgent.toLowerCase())) {
							width+=10;
						}else{
							width+=8;
						}
						$(this).width(width);
						$(this).css("left",left);
					});
				}
			});	
			var startWeekDayIndex=0;
			for(var i in weekend){
				if(weekend[i].substr(0,3).toLowerCase()==settings.startWeekDay.substr(0,3).toLowerCase()){
					startWeekDayIndex=parseInt(i);
				}
			}
			var table=$('<table class="table table-bordered table-responsive"></table>');
			var thead=$('<thead>');
			var tbody=$('<tbody>');		
			table.append(thead)	;
			table.append(tbody)	;
			tbody.addClass("x"+settings.minpx);
			var htr=$("<tr>");
			htr.append("<th>Time</th>");
			thead.append(htr);
			for(var w=0;w<=6;w++){
				var weekIndex=w+startWeekDayIndex;				
				if(weekIndex>6){
					weekIndex=(weekIndex%6)-1;
				}
				htr.append('<th id="w-'+(weekend[weekIndex].substr(0,3).toLowerCase())+'" class="">'+weekend[weekIndex]+'</th>');
				//$(this).append(weekend[weekIndex]+",");
			}
			
			//now body	
			for(var h=0;h<=23;h++){	
				var btr=$("<tr>");			
				btr.append('<th width="9%" class="">'+(h.toString().padLeft(2))+':00 </th>');
				btr.append('<td width="13%">');
				btr.append('<td width="13%">');
				btr.append('<td width="13%">');
				btr.append('<td width="13%">');
				btr.append('<td width="13%">');
				btr.append('<td width="13%">');
				btr.append('<td width="13%">');
				tbody.append(btr);	
							
			}
			$(this).html(table);
			//height=60*settings.minpx;			
			//tbody.find("th,td").height(height);
			if(settings.data && settings.data.length>0){
				for(var i in settings.data){
					$(this).addTimeData(settings.data[i]);
				}
			}	
			mainObject.bind('resize', function(){
            	mainObject.resizeAppTimeTable();
			});

			$(window).resize(function(){
				mainObject.resizeAppTimeTable();
			});
			//$(this).

        });

    }

}(jQuery));