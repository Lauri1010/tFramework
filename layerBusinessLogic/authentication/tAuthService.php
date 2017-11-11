<?php
namespace tFramework;
use Aura\Auth;
use Aura\Session;
use Aura\Web\WebFactory;

class tAuthService{
	
	protected $session;
	protected $auth;
	protected $authFactory;
	protected $sessionFactory;
	protected $resumeService;
	
	public function __construct()
	{
		$this->sessionFactory = new \Aura\Session\SessionFactory;
		$this->session = $this->sessionFactory->newInstance($_COOKIE);
	
		$this->session->setCookieParams(array('lifetime' => '1209600'));
	
		$this->authFactory = new \Aura\Auth\AuthFactory($_COOKIE);
		$this->auth = $this->authFactory->newInstance();
	
		// create the resume service
		$this->resumeService = $this->authFactory->newResumeService();
	
		// use the service to resume any previously-existing session
		$this->resumeService->resume($this->auth);
	
		// $_SESSION has now been repopulated, if a session was started previously,
		// meaning the $auth object is now populated with its previous values, if any
	
	
	}
	
	public function authenticate($username,$password,$userTable='user',$usernameColumnName='user_id',$usernameColumnName='email',$pwColumnName='password'){
	
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
	
	
	
}