<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('array_to_html_attr'))
{
	function array_to_html_attr($attrs=array()){
		$rstr="";
		foreach ($attrs as $attr=>$value){
			if(is_bool($value)){
				$value=$value?'true':'false';
			}
			$rstr.=$attr.'="'.$value.'" ';
			
		}
		return $rstr;
	}
}
if ( ! function_exists('bs3_form_group'))
{
	function bs3_hr_form_group($label,$name,$value,$label_col=5,$input_col=7,$input_type="text",$attr=array(),$group_type="sm")
	{
		if(empty($attr['placeholder'])){$attr['placeholder']=$label;}
		?>
		 <div class="form-group form-group-<?php echo $group_type;?>">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="res_id"><?php _e("Res Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<?php if(in_array($input_type, array('text','email','number'))){
		      			bs3_text_input($name, $value,$attr,$input_type);
		      		}?>
		      	</div>
		  </div> 
		<?php 
	}
}
if ( ! function_exists('bs3_form_group'))
{
	function bs3_text_input($name,$value,$attr=array(),$type="text")
	{
		$clsses="";$id=$name;
		if(!empty($attr['class'])){
			$clsses=$attr['class'];
			unset($attr['class']);
		}
		if(!empty($attr['id'])){
			$id=$attr['id'];
			unset($attr['id']);
		}		
		?>
		 <input id="<?php echo $id;?>" name="<?php echo $name;?>"  type="<?php echo $type;?>"   value="<?php echo $value;?>" class="form-control <?php echo $clsses;?>" <?php echo array_to_html_attr($attr);?>>		
		<?php 
	}
}

