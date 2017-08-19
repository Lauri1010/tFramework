<?php
namespace tFramework;

    function generateHead($title,$useAsyncLoader=false){
    	
    	echo getHeadElement($title);

    	echo getHeadElementEnd($beforeEnd=null,$useAsyncLoader=false);
    	
    	if(!$useAsyncLoader){
    		echo getBodyStart(getFrameWorkScripts());
    	}else{
    		echo getBodyStart();
    	}
    	
    }
    
    function generateBottom($scriptsToBottom=false){
    	
    	if($scriptsToBottom){
    		echo getFrameWorkScripts();  
    	}
    	echo getBodyEnd();
    	
    }
    

	function getHeadElement($title){
		
		return "<!DOCTYPE html>
		<html>
		<head>
		<meta charset=\"UTF-8\">
		<title>$title</title>";
		
	}
	
	function getHeadElementForms($title){
	
		return "<!DOCTYPE html>
		<html>
		<head>
		<meta charset=\"UTF-8\">
		<title>$title</title>";
	
	}
	
	function setCss($urlPath){
		
		return '<link rel="stylesheet" type="text/css" href="'.$urlPath.'">';
		
	}
	
	function getFrameWorkScripts($minimized=true){
		
		$scripts='';
		
		if($minimized){
			return '<script src="\js\jquery-1.12.1.js"></script>
				 	<script src="\js\tFramework.min.js" async defer></script>';
	
		}else{
			return '<script src="\js\jquery-1.12.1.js"></script>
					<script src="\js\tFramework.js" async defer></script>';
			
		}
		
		
	}
	
	/**
	 * Dynamic script loader
	 * NOTE: This is incomplete ! It does not ensure that scripts are loaded in the correct order !
	 * TODO: Change this to a script loader or change so that scripts are loaded in the right order. 
	 */
	function getHeadElementEnd($beforeEnd=null,$loadScripts=true,$production=false){
		
		
		if($loadScripts){
			
			$loadedScriptsDev=array(
					'/js/jquery-1.12.1.js',
					'/js/tFramework.js'
			);
			
			$loadedScriptsProduction=array(
					'/js/jquery-1.12.1.min.js',
					'/js/tFramework.min.js'
			);

			$asyncLoader="<script>
			var getUrl = window.location;
			var baseUrl = getUrl .protocol + \"//\" + getUrl.host;
					
			function loadScript(src)
			{
			  var s,
			      r,
			      t;
			  r = false;
			  s = document.createElement('script');
			  s.type = 'text/javascript';
			  s.src = src;
			  s.async = true;
			  s.onload = s.onreadystatechange = function() {
			    // console.log( this.readyState ); //uncomment this line to see which ready states are called.
					
			    if ( !r && (!this.readyState || this.readyState == 'complete') )
			    {
			      r = true;
			    }
			  };
			  t = document.getElementsByTagName('script')[0];
			  t.parentNode.insertBefore(s, t);
			}\n";
			if($production){

				
				foreach($loadedScriptsProduction as $url){
					
					$asyncLoader.="loadScript(baseUrl+'".$url."'); \n";
					
				}
				
			}else{
				foreach($loadedScriptsDev as $url){
						
					$asyncLoader.="loadScript(baseUrl+'".$url."'); \n";
						
				}
			}
			
			$asyncLoader.="</script>";
		
		}else{
			
			$asyncLoader='';
			
		}
		
		if($beforeEnd==null){
			
			return  $asyncLoader.'</head>';
			
		}else{
			
			return  $asyncLoader.$beforeEnd.'</head>';
			
		}
	
	}

	function getBodyStart($afterBodyStart=null){
		
		if($afterBodyStart==null){
				
			return "<body>";
				
		}else{
				
			return "<body>".$afterBodyStart;
				
		}
		
	}
	
	function getBodyEnd($beforeBodyEnd=null){
		
		if($beforeBodyEnd==null){
		
			return "</body></html>";
		
		}else{
		
			return $beforeBodyEnd."</body></html>";
		
		}
		
	}
/* 	
	function generateForm($url,$formClass=null){
		
		if($formClass==null){
			

			return "<form></form>";
			
		}

		
	} */
	


?>