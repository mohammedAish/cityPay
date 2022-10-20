/**
 * 
 */


var msgids=[];
jQuery(function($){
	//alert("ok");
	
	function loadChatMessage(listurl,charbox){
		$.getJSON( listurl, function( data ) {
			try{				
				populatemsg(data.data,charbox);				
			}catch(e){

			}
			
	    });
	}
	function populatemsg(data,charbox){
		if(data.length>0){		
			for(var i=data.length-1; i>=0;i--){							
				if(msgids.indexOf(data[i].chat_id)==-1){					
					addChatMsg(data[i],charbox);
					msgids.push(data[i].chat_id);					
				}
				
			}
		}
	}
	function addChatMsg(item,charbox){		
		var msg='<div class="direct-chat-msg '+(item.user_type=="A"?"right":"")+'">\
              <div class="direct-chat-info clearfix">\
                <span class="direct-chat-name pull-right">'+item.user_name+'</span>\
                <span class="direct-chat-timestamp pull-left">'+item.entry_time_str+'</span>\
              </div>\
              <img class="direct-chat-img" src="'+item.user_img+'" alt="'+(item.user_type=="A"?"Admin":"User")+'">\
              <div class="direct-chat-text">\
                '+item.msg+'\
              </div>\
            </div>\
           ';
		   if(msgids.length==0){charbox.find(".no-chat-msg")	.addClass("hidden")	 ;}
		   var msgobj=$(msg);		
		   var mbox=charbox.find(".direct-chat-messages");
		 	mbox.append(msgobj);
		  try{
			if(charbox.find("#is-auto-scroll").is(":checked")){
				mbox.scrollTop(mbox[0].scrollHeight);
		   }
		  }catch(e){
			  console.log(e);
		  } 
		   return msgobj;
	}
	$(".app-chat-box").each(function(){
		
		var mainobj=$(this);
		var listurl=mainobj.data('list-url');
		loadChatMessage(listurl,mainobj);
		setInterval(function(){
			loadChatMessage(listurl,mainobj);
		},2000);
		var formsender=mainobj.find(".chat-sender-form");
		formsender.on("submit",function(e){
			e.preventDefault();
			 $.ajax({
				   type: "POST",
				   url: formsender.attr('action'),		  
				   data: formsender.serialize(),
				   cache:false,	
				   dataType :'json',
				   beforeSend:function() {
					
						formsender.find(".chat-send-loader").removeClass('hidden');
				    },		   	  
				   success: function(rdata){
					  console.log(rdata);
					  if(rdata.status){
						  	formsender[0].reset();
							formsender.find(".chat-sender-input").focus();
							populatemsg(rdata.data,mainobj);
					  }
				    		
				   },
				   complete:function(){
					  formsender.find(".chat-send-loader").addClass('hidden');
				   }
		        });
		});
		
		
	});
});

