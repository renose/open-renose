<?php 
class FckHelper extends Helper { 

    var $helpers = Array('Html', 'Javascript'); 

    function load($id) { 
        $did = ''; 
        foreach (explode('.', $id) as $v) { 
            $did .= ucfirst($v); 
        }  

        $code = "CKEDITOR.replace( '".$did."' );"; 
        return $this->Javascript->codeBlock($code);  
    } 
} 
?>