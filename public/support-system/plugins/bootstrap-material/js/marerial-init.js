 $(function () {	
	 AddOnInitialized(SetMaterialInit);
	 AddOnLoadPopupMethod(SetMaterialInit);	 	
	 AddOnGridLoadComplete(SetMaterialInit);
 }); 
 function SetMaterialInit(){
	 try{
	 $.material.init({"validate": false,
	      "input": false,
	      "ripples": true,
	      "checkbox": true,
	      "togglebutton": true,
	      "radio": true,
	      "arrive": true,
	      "autofill": false});
	 }catch(e){}
	 try{
		 $(".btn:not(.added-ripples)").addClass('added-ripples').ripples();
	 }catch(e){}
 }
 