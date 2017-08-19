<?php

/**
 * Router. Note: is case sensetive
 * 
 * 
 */

namespace tFramework;

$pageNameEnd='.php';
$functionStartName='action';

$lang=null;

if(isset($_GET['lang'])){
	$lang=$_GET['lang'];
	
}

$q=null;

$path=explode(',', $pRequest);

// Used to determine the call to the right path class. Naming conventions handles by caller
$pathStart=strtolower($path[0]);
$callClassName=ucfirst($path[0]);

if(is_array($path)){
	
	$pl=count($path);
	
	// Used to call the exact function in the path class
	$pathFunction=$pathStart;
	
	for ($i = 0; $i < $pl; $i++) {
		// Naming conventions handles by caller
		
		if($i>0){
			$pathFunction.=ucfirst(ucfirst($path[$i]));
		}

	}
	
	$rq=dirname(__DIR__).DS.'layerPages'.DS.'paths'.DS.$pathStart.$pageNameEnd;
	$callClass='tFramework\\'.$callClassName;
	
	if(is_file($rq)){
			
			require $rq;
			$pB=new $callClass();	
			$pB->$pathFunction($lang);
			
		}else{
			
			pageNotFound();
			
		}

	
	
}else{
	
	trigger_error("Array not returned!", E_USER_ERROR);
	
}

function pageNotFound(){
	
	
	header("HTTP/1.0 404 Not Found");
	
}

?>