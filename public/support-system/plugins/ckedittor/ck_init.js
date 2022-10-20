/**
 * 
 */
function set_ck_init(){
	try{
		$( 'textarea.app-html-editor:not(.added-ck)').each(function(){
			var height=$(this).height();
			height+=100;
			var maxLength=$(this).attr("maxlength");
			if(!maxLength){
				maxLength=-1;
			}	
			$(this).addClass(".added-ck").ckeditor({height : height+'px',wordcount :{showParagraphs: false, showWordCount: false,showCharCount: true,countSpacesAsChars: true,countHTML: true,maxWordCount:-1, maxCharCount: maxLength}});
		});
		
	}catch(e){
		gcl(e.message);
	}	
}
$(function(){
	set_ck_init();
	AddOnLoadPopupMethod(set_ck_init);
});
