<?php
namespace tFramework;


/**
 * @author Lauri Turunen
 * 
 * This can be used to store business logic that you want to use
 * Note: as a best practice do not bloat this class with functionality 
 * Instead use functions with calls to other classes in lib or other folders using getFunctionality
 */
 

class backend{
	
	public $request;
	public $ds;
	public $rMethod;
	protected $view;
	public $data;
	protected $behaviours;
	private $authService;
	
	public function __construct(){
		$this->initiateDatabaseService();
		$this->rMethod = $_SERVER['REQUEST_METHOD'];

	}
	
	public function main(){
		
		
		
	}

	
	/**
	 * Get a behaviour from a set of defined behaviours
	 * 
	 * @param String $behaviourName
	 */
	
	public function getBehaviour($behaviourName){
		
		
		
		
	}
	
	public function getFunctionality($functionalityName){
		
		
		
	}
	
	
	/* Change in php7, temporarily commented out
	public function bLogin($username,$password,$userTable='user',$usernameColumnName='user_id',$usernameColumnName='email',$pwColumnName='password'){

		$this->ds->q($userTable,null,array($usernameColumnName,$usernameColumnName,$pwColumnName));
		$this->ds->where($userTable, $usernameColumnName, '=',$username);
		$this->ds->setLimitAndOffset(1);
		
		$userResult=$this->ds->qd();
		
		$dbUsername=$userResult[0][$usernameColumnName];
		$dbPassword=$userResult[0][$pwColumnName];
		
		if($password==$dbPassword){

			if(empty($this->authService)){
				require ROOT.DS.FRFOLDER.DS.'layerBusinessLogic'.DS.'authentication'.DS.'tAuthService.php';
				$this->authService=new tAuthService();
			
			}

			$this->authService->login($username,$password,$userTable,$usernameColumnName,$usernameColumnName,$pwColumnName);
			
		}else{
			
			return 'Password is wrong';
			
			
		}

		
		
	} */
	
	
	public function isLoggedIn(){
		
		if(empty($this->authService)){
			require ROOT.DS.FRFOLDER.DS.'layerBusinessLogic'.DS.'authentication'.DS.'tAuthService.php';
			$this->authService=new tAuthService();
				
		}
		
		echo $this->authService->getStatus();
		
	}
	
	
	public function initiateDatabaseService(){
		
		if(empty($this->ds)){	

			try {

				$requiredFile=ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.DB_NAME.DS.'Sql_service_'.DB_NAME.'.php';
				
				if(is_file($requiredFile)){
					
					require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.DB_NAME.DS.'Sql_service_'.DB_NAME.'.php';
					
				}else{
					
					trigger_error($requiredFile."is not a file ", E_USER_ERROR);
					
				}
	
				$dsName='tFramework\\Sql_service_'.DB_NAME;
				
				$this->ds=new $dsName();
			
			}catch (Exception $e) {
				trigger_error($e, E_USER_ERROR);
			}
		}

	}
	
	
	
	/**
	 * Getting html based on the language
	 * 
	 * @param unknown $language
	 */
	public function getHtmlBasedOnLanguage($language){
		
		
	}
	
	
	public function redirect($url, $permanent = false)
	{
		header('Location: ' . $url, true, $permanent ? 301 : 302);
	
		exit();
	}

	
	
}
?>