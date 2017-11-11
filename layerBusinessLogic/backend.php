<?php
namespace tFramework;

/**
 * @author Lauri Turunen
 * https://github.com/auraphp/Aura.Session
 */
class backend{
	
	public $request;
	public $ds;
	public $rMethod;
	protected $view;
	public $data;
	protected $behaviours;
	protected $session;
	protected $auth;
	protected $authFactory;
	protected $sessionFactory;
	protected $resumeService;
	
	public function __construct(){
		$this->initiateDatabaseService();
		$this->rMethod = $_SERVER['REQUEST_METHOD'];

	}
	
	public function authenticate($username,$password,$userTable='user',$usernameColumnName='email',$pwColumnName='password'){
	
		$error;
	
		/* 		$this->ds->q($userTable,null,array($usernameColumnName,$usernameColumnName,$pwColumnName));
			$this->ds->where($userTable, $usernameColumnName, "='{$username}'");
			$this->ds->setLimitAndOffset(1);
	
			$userResult=$this->ds->qd();
	
			$dbUsername=$userResult[0][$usernameColumnName];
			$dbPassword=$userResult[0][$pwColumnName]; */
	
		/* 		if($username==$dbUsername){
	
		if($password==$dbPassword){ */
	
		$loginService = $this->authFactory->newLoginService();
	
		// use the service to force $auth to a logged-in state
		// Note username has to be unique !
	
		$userdata = array(
				'username'=>$username,
		);
	
		$loginService->forceLogin($this->auth, $username, $userdata);
	
		$status=$this->auth->getStatus();
	
		if($status=='VALID'){
	
			// TODO: continue this
			echo $status;
				
		}
	
	
		/* 			}else{
	
		$error.='<p> Incorrect password. </p>';
	
		}
	
		}else{
	
		$error.='<p> Incorrect username. </p>';
	
		} */
	
	
	
	
	}
	
	public function login($username){
	
	
		$loginService = $this->authFactory->newLoginService();
	
		// use the service to force $auth to a logged-in state
		// Note username has to be unique !
	
		$userdata = array(
				'username'=>$username,
		);
	
		$loginService->forceLogin($this->auth, $username, $userdata);
	
		$status=$this->auth->getStatus();
	
		return $status;
	
	}
	
	public function getStatus(){
	
		echo $this->auth->getStatus();
	
	
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
	

	public function bLogin($username,$password,$userTable='user',$usernameColumnName='username',$pwColumnName='password'){

		// TODO: redo this
/* 		$this->ds->q($userTable,null,array($usernameColumnName,$usernameColumnName,$pwColumnName));
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
			
			
		} */

	} 
	
	
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

				$requiredFile=DBFOLDER.'Sql_service_'.DB_NAME.'.php';
				
				if(is_file($requiredFile)){
					require $requiredFile;
				}else{
					trigger_error($requiredFile." is not a file ", E_USER_ERROR);
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