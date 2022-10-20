 $(function () {	
	 AddOnInitialized(SetIconPicker);
	 AddOnLoadPopupMethod(SetIconPicker);	 	
	 AddOnGridLoadComplete(SetIconPicker);
 }); 
 function SetIconPicker(){	
	 try{
		 $('.app-iconpicker:not(.added-ip)').iconpicker({hideOnSelect:true});
	 }catch(e){}
	 try{
		 $(".btn:not(.added-ip)").addClass('added-ip');
	 }catch(e){}
 }