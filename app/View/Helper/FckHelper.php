<?php 
class FckHelper extends Helper { 

	var $helpers = Array('Html', 'Js'); 

	function load($id, $tollbar="MyToolbar"){

		$options = array( 
        	'language'=>'pt-br', 
            'uiColor'=>'#7E9DCC', 
            'toolbar'=>$tollbar, 
        );
        
        if(!empty($options_)) {
        	array_merge($options,$options_); 
        }
        
        $did = ''; 
        
        foreach (explode('.', $id) as $v) { 
            $did .= Inflector::camelize($v); 
        } 
        $did = Inflector::humanize($did); 
         
        $code = " if (CKEDITOR.instances['".$did."']) { 
                    CKEDITOR.remove(CKEDITOR.instances['".$did."']); 
                    cckeditor".$did.".destroy(); 
                    cckeditor".$did." = null; 
                 }\n"; 
        $code .= " cckeditor".$did." = CKEDITOR.replace( '".$did."',".$this->Js->object($options).");\n"; 
        
        return $this->Html->scriptBlock($code); 
	}
} 
?>