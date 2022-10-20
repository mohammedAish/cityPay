function setMask(){
	try{
		$('.CustomMask').each(function(){
			
			var mask=$(this).attr("mask");			
			$(this).mask(mask);
		});
	}catch(e){}
	
	try{
		$('.CustomPhone').each(function(){
			var mask=$(this).attr("phoneformat");			
			$(this).mask(mask);
		});
	}catch(e){}
	$('.number').mask("9999999999999999");
	$('.expdate').mask("9999");
	try{
		 $.jMaskGlobals = {
				    maskElements: 'input,td,span,div',
				    dataMaskAttr: '*[data-mask]',
				    dataMask: true,
				    watchInterval: 300,
				    watchInputs: true,
				    watchDataMask: false,
				    byPassKeys: [9, 16, 17, 18, 36, 37, 38, 39, 40, 91],
				    translation: {				      
				        '9': {pattern: /\d/, optional: true},
				        '#': {pattern: /\d/, recursive: true},
				        'A': {pattern: /[a-zA-Z0-9]/},
				        'S': {pattern: /[a-zA-Z]/}
				    }
		};
		try{
		  var translation= {
		                '0': {pattern: /\d/}, 
		                '9': {pattern: /\d/, optional: true}, 
		                '#': {pattern: /\d/, recursive: true}, 
		                'A': {pattern: /[a-zA-Z0-9]/}, 
		                'S': {pattern: /[a-zA-Z]/},
		                '8': {pattern: /[1-9]/},
		                '2': {pattern: /[2-9]/}
		               
		   }
		  var phonetranslation= {	              
	                'A': {pattern: /[0-9]/},
	                'O': {pattern: /[1-9]/},
	                'Z': {pattern: /[2-9]/}
		  };
		  
		  	$(".phone").each(function(){
		  		var a= $(this).data('bv-phone-country');		  		
		  		if(a){		  			
		  			if(a=="US" || a=="CA"){
		  				$(this).mask('(ZAA) AAA-AAAA', {'translation': phonetranslation});
		  			}else if(a=="AU"){
		  				$(this).mask('0AAA AAAAAA', {'translation': phonetranslation});
		  			}else if(a=="BD"){		  				
		  				$(this).mask('01OAA-AAAAAA', {'translation': phonetranslation,placeholder: "01xxx-xxxxxx"});
		  			}
		  		}else{
		  			$(this).mask('(ZAA) AAA-AAAA', {'translation': phonetranslation});
		  		}
		  	});
			//$('.phone').mask('(299) 999-9999', {'translation': translation});
		  $('.phone').keydown(function(e){
			  var code = e.keyCode || e.which;
			  if(code==32 || code==173){
				  e.preventDefault();
			  }				
		  });
			//$('.phoneLogin').mask(celphoneMask);
			
		}catch(e){
			console.log(e.message);
			//$('.phoneLogin').mask("999 999 9999");
			//$('.phone').mask("999 999 9999");
		}
		
		try{		
			$('.ccard').mask("9999 9999 9999 9999");
			$('.regPhone,.ccard,.phoneLogin,.phone,.CustomPhone,.CustomMask').bind('paste', function(event){
				  $(this).select();			  
			});
	
		}catch(e){}
	}catch(e){}
}
function SetLoginPhoneMask(pF){
	
	try{
		$('.phone').mask(pF);
		$('.phoneLogin').val("");
		$('.phoneLogin').mask(pF);
		
		
	}catch(e){
		
	}

		
}