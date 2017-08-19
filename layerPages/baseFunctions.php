<?php
namespace tFramework;

class baseFunctions{
	
	protected $actionStart='Action';
	protected $pageValue;
	protected $ifg;
	protected $itemsPerPage=5;
	protected $page;
	private $calledAction;
	protected $af;
	protected $type;
	private $loggedIn;
	
	public function processUrl($urlElements,$lang=null,$homepage=false,$site=false) {
	
		$firstUrlElement=current($urlElements);
		
		$action=$this->getCallAction($urlElements,$site);
		
		if(method_exists($this, $action)){
	
			$this->$action($lang);
	
		}else{
			
			$this->pageNotFoundAndExit();
			
		}
	
	
	}

	
	
	public function getCallAction($urlElements,$translate=false,$site=false){

		// we will dtermine what is requested based on the actions
		
		$callAction=$this->actionStart;
		
		$actionNotSet=true;
		
		$sizeofUrlElements=sizeof($urlElements);
		$lastElement=$sizeofUrlElements-1;
		
		// Should always start with the type
		$pElementPlace=$urlElements[$lastElement]; 
	
		
		if(is_numeric($pElementPlace)){
		
			$isDigit = ctype_digit((string)$pElementPlace);
		
			if($isDigit){
					
				$callAction.='Paginator';
		
				$this->page=$pElementPlace;
				
			}else{
		
				$this->pageNotFoundAndExit();
					
			}
		
		
		}
		
		// Removing the obvious type ULR part for convenience
		// $urlElements=array_splice($urlElements, 1, 1);

		if(!$site){
			unset($urlElements[0]);
			
		}

		foreach($urlElements as $index => $urlElement){

				if(!is_numeric($urlElement)){
					
					if($actionNotSet){
					
						$callAction.=ucfirst($urlElement);
						$actionNotSet=false;
							
					}else{
					
						$callAction.=ucfirst($urlElement);
							
					}
					
				}

		}

		if (strpos($callAction,'?') !== false) {
			
			$callAction=substr($callAction, 0, strpos($callAction, "?"));
			
		}

		if($callAction==$this->actionStart){
			
			return $callAction.'Index';
			
		}else{
			
			return $callAction;
			
		}
	}
	
	/**
	 * Processing for patterns
	 * 
	 * */
	
	public function getPatterns(){
		
		
		
		
	}
	
	
	/**
	 * Automatically sets limit and offset
	 * 
	 * */
	public function paginator($page=1,$itemsPerPage=null){
		
		$offset=null;
		
		if(isset($this->itemsPerPage) && isset($this->page)){
	
			$limit=$this->itemsPerPage;

			if($this->page>1){
				$offset=($this->page*$this->itemsPerPage)-$this->itemsPerPage;
				
			}

		}else{
			
			die('Page and items per page has to be set!');
			
		}
		

		return array($limit,$offset);
		
	}
	
	
	
	
	/**
	 * URL path = the next level path beign used. 
	 * This feature assumed that pure is used
	 * */
	public function getNextPreviousPageLinks($page,$urlPath,$maxNumberOfPages){
		
		$previousPage=1;
		$nextPreviousPages=array();
		
		if($page==1){
			
			if($maxNumberOfPages==1){
				
				
				
			}else if($maxNumberOfPages>1){
				
				$nextPreviousPages[]="{$urlPath}/2";
				$nextPreviousPages[]="{$urlPath}/1";
				
			}
			
		}else if($page==2){

			// Next page path
			
			if($maxNumberOfPages==2){

				$nextPreviousPages[]="{$urlPath}/2";
			
			}
			
			


			
		}
		
		
		
		
	}
		

/* 	public function getPhpResource($requireType='require',$folder='lib'){
	
		if(empty($requireType)){
				
			die('require was empty!');
				
		}else{
			
			$requiredfile=ROOT.DS.FRFOLDER.DS.$folder.DS.'baseFunctions.php';
			
			if(is_file($requirePage)){
				
				if($requireType=='require'){
				
					$requiredfile=ROOT.DS.FRFOLDER.DS.$folder.DS.'baseFunctions.php';
				
				}else if($requireType=='require once'){
				
				
				}else if($requireType=='include'){
				
				
				}else if($requireType=='include once'){
				
				
				}
				
			}else{
			
				die('Cannot find the required file at base functions');
			
			}
			

				
		}
	
	} */
	

	public function getInternalPath($pathParts){
	
		$iPath=ROOT.DS.FRFOLDER;
	
		if(is_array($pathParts)){
				
			foreach($pathParts as $part){
	
				$iPath.=DS.$part;
	
			}
				
		}else{
			die('Path parts has to be an array!');
				
				
		}
	
		return $iPath;
	}
	
	public function getLogic($type,$callMainFunction=true,$mainFunction='main'){

		$logicName=$type.'Logic';
		
		$classPath=strtolower($type);
		
		$ra=ROOT.DS.FRFOLDER.DS.'layerBusinessLogic'.DS.$classPath.DS.$type.'Logic.php';

		if(is_file($ra)){
			
			require $ra;
			
			$cc='tFramework\\'.$logicName;
			
			$this->af=new $cc;
			
			if($callMainFunction){
				$this->af->$mainFunction();
			}
	
		}else{
			die('Logic not found: '.$ra);
			
			
		}

		
	}
	

	public function pageNotFound(){
		
		header("HTTP/1.0 404 Page not found");
		echo "<html><head></head>
					<body><h1>Page not found</h1>
					</body>
					</html>";

		
	}
	
	public function pageNotFoundAndExit(){
	
		header("HTTP/1.0 404 Page not found");
		echo "<html><head></head>
					<body><h1>Page not found</h1>
					</body>
					</html>";
	
		exit;
	
	}
	
	
	
}

