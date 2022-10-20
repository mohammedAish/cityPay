function clipboard_init(){
var clipboard=new Clipboard('.app-copy-btn');
	clipboard.on('success', function(e) {		
	     e.clearSelection();
	     try{
	     var options = {
    	     'title': 'Copied',
    	      style: 'success',
    	      theme:'right-bottom.css',
    	      timeout: 5000,
    		 'message': '<small>'+e.text+"</small>"
		 };
	     var n = new notify(options);
	     n.show();	   
	     }catch(e){}
});
}

$(function () {	
	 AddOnInitialized(clipboard_init);
	 AddOnLoadPopupMethod(SetMaterialInit);	 	
	 AddOnGridLoadComplete(SetMaterialInit);
});