<?php
namespace tFramework;
/**
 * Router. Note: is case sensetive
 * @author Lauri Turunen
 * 
 */
$_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$pageNameEnd='.php';
$functionStartName='action';

$lang=null;

if(isset($_GET['lang'])){
	$lang=$_GET['lang'];
	
}

$q=null;

if(isset($pRequest)){
	$path=explode(',', $pRequest);
}else{

	if (strpos($url, '?') !== false) {
	    $url=explode("?", $url, 2)[0];
	}
	
	if($url=='/'){
		$path=array('site');
	}else{
		$path=array();
		$item='';
		$srLen=strlen($url);
		for ($i = 0; $i < $srLen; $i++){
			if($i>0){
				$char=mb_substr($url,$i,1);
				if($char=='/'){
					$path[]=$item;
					$item='';
				}else{
					$item.=$char;
				}
				
			}

		}
		// Save is no cutoff
		if(!empty($item)){
			$path[]=$item;
		}		
	}
}

// Used to determine the call to the right path class. Naming conventions handles by caller
$pathStart=strtolower($path[0]);
$callClassName=ucfirst($path[0]);
if(is_array($path)){
	$sPath=sizeof($path);
	$pLe=$sPath-1;
	appdata::set('path', $path);
	appdata::set('lastPath', $path[$pLe]);
	$rq=PATHSFOLDER.$pathStart.$pageNameEnd;
	$callClass='tFramework\\'.$callClassName;
	
	if(!is_file($rq)){
		$rq=PATHSFOLDER.'site.php';
		$callClass='tFramework\\site';	
	}
	
	require $rq;
	$pB=new $callClass();
	$pB->processUrl($path,$lang);

}else{
	
	trigger_error("Array not returned!", E_USER_ERROR);
	
}

function pageNotFound(){
	
	
	header("HTTP/1.0 404 Not Found");
	
}

?>