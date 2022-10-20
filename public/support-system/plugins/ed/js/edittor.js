var edittor_img_upload_url=base_url+"image/upload-img";
var edittor_img_files_url=base_url+"image/file-list";

jQuery(function($){
	$("textarea.app-html-editor").froalaEditor({
		 heightMin: 200,
		 defaultImageWidth: '100%'
	});
});