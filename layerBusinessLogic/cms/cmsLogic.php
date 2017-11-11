<?php
namespace tFramework;
use Aura\Auth;
use Aura\Session;

require ROOT.DS.FRFOLDER.DS.'layerBusinessLogic'.DS.'backend.php';

class cmsLogic extends backend{
	
	protected $session;
	protected $auth;
	protected $authFactory;
	protected $sessionFactory;
	protected $resumeService;
	protected $uValues;
	
	public function main(){
		$this->initiateAuthFactory();
	
	}
	
	public function initiateAuthFactory(){
		
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
	
		if(empty($this->ds->pdo)){
			$this->initiatePdo();
		}
		
		$this->ds->prepare('SELECT username, password, email FROM user WHERE user_id = :userId');
		
		$db->bind(':fname', 'Jenny');
		
		$row = $db->single();
		
		
		$userResult=$this->ds->qd();

		$dbUsername=$userResult[$usernameColumnName];
		$dbPassword=$userResult[$pwColumnName];
	
		if($password==$dbPassword){
			
			$loginService = $this->authFactory->newLoginService();
			
			// use the service to force $auth to a logged-in state
			// Note username has to be unique !
			
			$userdata = array(
					'username'=>$username,
			);
			
			$loginService->forceLogin($this->auth, $username, $userdata);
			
			$status=$this->auth->getStatus();
			
			if($status=='VALID'){
			
				return true;
			
			}else{

				trigger_error("Error in setting login status: ".$status, E_USER_ERROR);
				
			}
			
		}else{
			
			return false;
			
		}
		
	
	}
	
	public function isLoggedIn(){
	
		return $this->auth->getStatus();

	}

	
	public function generateInputElement($tableName,$tableColumn,$type,$cols=null,$rows=null){
	
		// TODO: refactored, update
		$getService='get_'.$tableName.'_model_value';
		$validationRow=$tableColumn.'_validation';
	
		$rules=$this->ds->$getService($validationRow);
	
		// var_dump($this->uValues);
		
		$html='';
	
		$isInteger=false;
		$isDecimal=false;
		$max=false;
		$min=false;
		$isText=false;
		$required=false;
		$intiger=false;
		$maxLenght;
		$minLenght;
	
		if(isset($rules['max'])){
	
			$maxLenght=$rules['max'];
	
		}
			
		if(isset($rules['min'])){
	
			$minLenght=$rules['min'];
	
		}
	
		foreach($rules as $indexOrArrayIndex => $rule){
				
			// echo 'Index: '.$indexOrArrayIndex.' '.$rule.'<br/>';
				
			if($rule=='required'){
					
				$required=true;
					
			}
	
			if($rule=='intiger'){
					
				$intiger=true;
	
				if($type=='textArea'){
	
					die('Textarea not allowed for an intiger column');
						
				}
	
					
			}
	
			if($rule=='decimal'){
					
				$isDecimal=true;
	
				if($type=='textArea'){
	
					die('Textarea not allowed for a decimal column');
						
				}
	
					
			}
				
			if($rule=='string'){
	
				$isText=true;
	
	
			}
				
				
		}
	
	
		if($type=='inputField'){
	
			$html.='<input name="'.$tableColumn.'" ';
	
			if(!empty($this->uValues)){
				
				$html.=" value=\"{$this->uValues[$tableColumn]}\" ";
				
			}
			
		}else if($type=='dropDown'){
				
				
				
		}else if($type=='textArea'){
				
			if(isset($rows) && isset($cols)){
	
				$html.='<textarea rows="'.$rows.'" cols="'.$cols.'" name="'.$tableColumn.'" ';
	
			}else{
	
				$html.='<textarea name="'.$tableColumn.'" ';
	
			}
		
	
			if($isInteger){
	
				die('text areas can only be set for text fields!');
	
			}
	
		}else if($type=='checkBox'){
				

			if($this->uValues[$tableColumn]==1 || $this->uValues[$tableColumn]=="1"){
				
				$html.='<input type="checkbox" name="'.$tableColumn.'" value="0" checked ';
				
			}else if($this->uValues[$tableColumn]==0 || $this->uValues[$tableColumn]=="0"){
				
				$html.='<input type="checkbox" name="'.$tableColumn.'" value="1"';
				
			}else{
				
				$html.='<input type="checkbox" name="'.$tableColumn.'" value="1" ';
				
			}

				
		}else if($type=='fileUpload'){
				
				
				
		}
		
		// var_dump($isDecimal);
	
		if(($isInteger || $isDecimal) && $type!='textArea' && $type!='checkBox' && $type!='dropDown'){
				
			$html.=' type="number" ';
				
			// Note min has to be always set
			// if(!empty($maxLenght) && !empty($minLenght)){
			if(!empty($maxLenght)){
					
				$html.=' maxlength="'.$maxLenght.'"';
	
			}
				
			if($isDecimal){
				$html.=' step="any" ';
	
			}
				
		}
	
	
	
		if($isText && $type!='textArea' && $type!='checkBox' && $type!='dropDown'){
				
			$html.=' type="text" ';
	
			// Note min has to be always set
			if(!empty($maxLenght)){
	
				$html.=' maxlength="'.$maxLenght.'"';
					
			}
				
		}
	
		if($isText && $type=='textArea'){
	
			// Note min has to be always set
			if(!empty($maxLenght)){
	
				$html.=' maxlength="'.$maxLenght.'" ';
					
			}
	
		}
	
		if(isset($_POST[$tableColumn])){
				
			if($type!='textArea'){
				$html.=' value='.$_POST[$tableColumn].' ';
	
			}
	
		}
	
		if($required){
			$html.=' required ';
	
		}
	
		// Close
	
		if($type=='textArea'){
				
			$html.='>';
			if(isset($_POST[$tableColumn])){
				$html.=$_POST[$tableColumn].' ';
					
			}
			
			if(isset($this->uValues[$tableColumn])){
			
				if(!empty($this->uValues[$tableColumn])){
					
					$html.=$this->uValues[$tableColumn];
				}
			
			}
			
			$html.='</textarea>';
				
		}else{
				
			$html.='>';
				
		}
	
	
	
		return $html;
	
	
	}
	
	
	public function inputField($tableName,$tableColumn){
	
		return $this->generateInputElement($tableName,$tableColumn,'inputField');
	
	}
	
	public function textArea($tableName,$tableColumn,$rows=5,$cols=50){
	
		return $this->generateInputElement($tableName,$tableColumn,'textArea',$rows=25,$cols=10);
	
	}
	
	/**
	 * Helper function to create a dropdown.
	 *
	 * */
	// TODO: refactored, update
	public function dropDown($currentTableName,$currentTableColumnRef,$refTable,$refColumnId,$refColumnName,$inputClass=null){
	
		
		$getService='get_'.$currentTableName.'_model_value';
		$validationRow=$currentTableColumnRef.'_validation';
	
		// TODO: Right now nothing is beign done with the rules.. Perhaps not needed
		$rules=$this->ds->$getService($validationRow);
	
		
		
		if(is_array($rules)){
	
			if(($refTable!=null) && ($refColumnName!=null)){
					
				$getSql='SELECT DISTINCT '.$refColumnId.','.$refColumnName.' FROM '.$refTable;
	
				$this->ds->pdo->prepare($getSql);
	
				$ddResults=$this->ds->pdo->resultset();
					
				$htmlBeginning='<select name="'.$currentTableColumnRef.'"> ';
					
				foreach($ddResults as $result){
						
					$refIndex=$result[$refColumnId];
					$refCText=$result[$refColumnName];
						
					if(!empty($this->uValues)){
						
						if($this->uValues[$currentTableColumnRef]==$refIndex){
							
							$htmlBeginning.=' <option value="'.$refIndex.'" selected>'.$refCText.'</option> ';
							
						}else{

							$htmlBeginning.=' <option value="'.$refIndex.'">'.$refCText.'</option> ';
	
						}
		
					}else{
		
						$htmlBeginning.=' <option value="'.$refIndex.'">'.$refCText.'</option> ';
			
					}

						
				}
					
				$htmlEnd='</select>';
					
				return $htmlBeginning.$htmlEnd;
					
			}else{
					
				die('Dropdown improperly formatted');
					
			}
	
		}
	
	}
	
	public function checkBox($tableName,$tableColumn){
	
		return $this->generateInputElement($tableName,$tableColumn,'checkBox');
	
	
	}
	
	public function processSubmit($table,$type='create',$updateIdColumn=null,$updateId=null){

		if (!empty($_POST)){
				
			$insertSql='';
			$errorMessages=array();
			$rRules=array();
			
			
			foreach($_POST as $column => $value) {
	
				$getService='get_'.$table.'_model_value';
				$validationRow=$column.'_validation';
				$rules=$this->ds->$getService($validationRow);
	
				
				if(empty($rules)){
						
					die('Error. No validation rules for the submitted column.');
						
				}else{
						
					$errorMessages[]=$this->ds->validate($rules,$column,$value);
						
				}
	
			}

			// check that all required are present
			
			if(!$this->ds->validation_errors_exists){
	
				if($type=='create'){
					$this->ds->insert($table);
				}else if($type=='update'){
					$this->ds->update($table,$updateIdColumn,$updateId);
				}
				
				// TODO: redirect or update to next page
	
			}else{
	
				foreach($errorMessages as $message){
	
					if(!empty($message)){
		
						echo "<p style=\"color:red\">".$message[0]."</p>";
						
					}
		
				}
	
			}
				
	
		}else{
			
			if($type=='update' && is_string($updateIdColumn) && is_string($updateId)){
				// Fetch data from database and append
				
				// $this->ds->
				
				$this->ds->q($table);
	
				$this->ds->where($table,$updateIdColumn,'=',$updateId);
				
				$this->ds->setLimitAndOffset(1);
				
				$this->uValues=$this->ds->qd();
			
				
				if(empty($this->uValues)){

					trigger_error('The data is not found ', E_USER_ERROR);
					
					
				}
			
			}
			
			
		}

	
	}
	
	
	public function imageUpload($tableName,$tableColumn){
	
	
	}
	
	public function fileUpload(){
	
	
	}
	
	public function is_decimal($val)
	{
		return is_numeric($val) && floor($val) != $val;
	}
	
	
	
	
}