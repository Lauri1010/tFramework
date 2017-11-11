<?php
namespace tFramework;
/**
 * @author Lauri Turunen
 *
 */
class Sql_service_base{
	
	public $pdo;

	public $select='';
	public $join;
	public $condition;
	public $conditionBindList;
	public $limitAndOffset;
	public $groupBy;
	public $orderBy;
	public $limit;
	public $offset;
	public $sqlQuery;
	public $sqlUpdate;
	public $validation_errors;
	public $validation_errors_exists;
	protected $aBindCount;
	protected $previousTable;
	
	// The first row of column selection
	protected $firstRow;

	function __construct($ipdo=false) {
		
		if($ipdo){
			$this->initiatePdo();
		}
		
		$this->validation_errors_exists=false;

		$this->previousTable=null;
		$this->firstRow=true;
		$this->validation_errors=array();
		$this->aBindCount=0;
	}
	
	public function getSqlQueryObject(){
		
		$className='sqlQueryObject';
		$fullClassName='tFramework\\'.$className;

			$rt=ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.$className.'.php';
				
			if(is_file($rt)){
				require $rt;
				return new $fullClassName();
			}else{
				trigger_error("Class does not exist with path ".$rt, E_USER_ERROR);
			}
	
	}
	
	public function getFromAPCu($key){
		
		if(is_string($key)){
			
			if(extension_loaded('apcu')){
				
				if (apcu_exists($key)) {
					return apcu_fetch($key);
				} else {
					return false;
				}
					
			}

		}else{
			trigger_error("Key has to be a string", E_USER_ERROR);
		}
		
	}
	
	public function setToAPCu($key,$value,$update=false){
	
		if(is_string($key)){
				
			if(extension_loaded('apcu')){
				if($update){
					if(apcu_exists($key)){
						apcu_delete($key);
					}
				}
				return apcu_store($key, $value);
			}
	
		}else{
			trigger_error("Key has to be a string", E_USER_ERROR);
		}
	
	}
	
	public function ifInAPCu($key){
		
		if(extension_loaded('apcu')){
			return apcu_exists($key);
			
		}else{
			return false;
		}
		
		
	}
	
	/**
	 * When updating the database the updating function will call this and set empty arrays for isUpdated function, 
	 * which is called in logic functions
	 * 
	 * @param array $tables
	 */
	
	public function setUpdated($tables){
		if(is_array($tables)){
			foreach($tables as $table){
				if(is_string($table)){
					$dc=array();
					$this->setToAPCu($table,$dc);
				}
			}
		}
	}
	
	/***
	 * Checking if the tables have been updated. Updated is determined by an empty array for the key
	 * Update propagated for the key already: there is a key (value 1) in the table array
	 * 
	 * @param array $tables
	 * @param string $key
	 * @return boolean
	 */
	
	public function isUpdated($tables,$key){
		if(is_array($tables) && is_string($key)){
			$result=false;
			foreach($tables as $table){
				$updated=$this->getFromAPCu($table);
				if(is_array($updated)){
					if(isset($updated[$key])){
						$result=true;
					}else{
						// This update has been done for the spesified cache key. When update is done again. the key is removed
						$updated[$key]=1;
						$result=$this->setToAPCu($table,$updated,true);
					}
				}

			}
			return $result;
		}
	}
	

	
/* 	private function connectDatabase($dbName,$dbHost,$dbName,$dbUser=null,$dbPassword=null){
		
		if(is_string($dbName)){
			DB_NAME=$dbName;
		}
		
		
		
	} */
	
	
	protected function initiatePdo(){
	
		if(empty($this->pdo)){
			require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'database.php';
			$this->pdo=new database();
			$this->pdo->conncect();
	
		}
	
	}
	
	public function queryDo(&$sqlObject,$sq=false){
	
		if($sqlObject instanceof sqlQueryObject){
	
			if(empty($this->pdo)){
				$this->initiatePdo();
			}
			$sql=$sqlObject->getQuerySql();
			$binds=$sqlObject->getBinds();
	
			if(!empty($sql)){
				
				$this->pdo->prepare($sql);
				if(!empty($binds)){
					if(sizeof($binds)>0){
					
						foreach($binds as $bKey => $bValue){
					
							$this->pdo->bind($bKey,$bValue);
					
						}
					
					}
				}
				unset($sqlObject);
				if($sq){
					return $this->pdo->single();
				}else{
					return $this->pdo->resultset();
				}

			}else{
				trigger_error("Sql data object does not contain data!", E_USER_ERROR);
			}
			
	
		}else{
			trigger_error("Improper data set", E_USER_ERROR);
		}
	
	}

	public function queryRs($sql,$binds=array()){
	
		if(is_sring($sql) && strlen($sql)>0 && is_array($binds)){

			if(empty($this->pdo)){
				$this->initiatePdo();
			}
				
			$this->pdo->prepare($sql);
	
			if(sizeof($binds)>0){
	
				foreach($binds as $bKey => $bValue){
	
					$this->pdo->bind($bKey,$bValue);
	
				}
	
			}
	
			return $this->pdo->resultset();
				
		}else{
			trigger_error("Sql needs to be set", E_USER_ERROR);
		}
	
	}


	/***
	 * $model: the model name to use for inserting or updating
	 * 
	 * 
	 */
	
	public function save($model,$idColumn){

		$this->validation_errors=array();
		
		if(empty($this->$model)){
			
			trigger_error('The model is empty, the model has to be set before calling this function!', E_USER_ERROR);
			
		}else{

				$from_table=$this->$model->table_name;
				$idColumnValue=$this->$model->$idColumn;

				$modelResult=null;
				
				if(!empty($idColumnValue)){
	
					$findTableSql="SELECT $idColumn FROM $from_table WHERE $idColumn=$idColumnValue";
				
					$this->pdo->prepare($findTableSql);
					
					$modelResult=$this->pdo->resultset();
					
				}

				if(empty($this->$model)){

					trigger_error('The model '.$model.' has not been properly initialized', E_USER_ERROR);
					
				}

				if($modelResult){

					$updateSql=$this->$model->update_base_sql;
		
						$fr=true;
		
						// Save the set values
						foreach($this->$model->columns as $column){
						
							if(isset($this->$model->$column)){
	
								$value=$this->$model->$column;
								
								$updateColumn='update_'.$column.'_sql';
								
								if($fr){

									$updateSql.=$this->$model->$updateColumn;
									$fr=false;
									
								}else{
									
									$updateSql.=','.$this->$model->$updateColumn;
									
								}
	
								$vRulesBase=$column.'_validation';
								
								$vRules=$this->$model->$vRulesBase;
								
								$this->validation_errors[]=$this->validate($vRules,$column,$value);
	
							}
								
						
						}

						if(!$this->validation_errors_exists){

							$updateSql.=" WHERE $idColumn=$idColumnValue ";
							
							$this->pdo->prepare($updateSql);
							
							foreach($this->$model->columns as $column){
		
								if(isset($this->$model->$column)){
							
									$columnValue=$this->$model->$column;

									$this->pdo->bind(':'.$column, $columnValue);
										
								}
			
							}
							
							$this->pdo->execute();
							
							// Set the model to null so it can be reused. 
							$this->$model=null;
							
							return true;
						
						}else{
							
							return false;
							
						}
						
					
					}else{
						
							$mColumns=$this->$model->columns;
	
							foreach($mColumns as $column){
					
								if(isset($this->$model->$column)){
					
									$cValue=$this->$model->$column;
			
									$validation_name=$column.'_validation';
		
									$rules=$this->$model->$validation_name;
									
									$this->validation_errors[]=$this->validate($rules,$column,$cValue,true);

								}else{
					
									$cValue=$this->$model->$column;
									
									$validation_name=$column.'_validation';
		
									$rules=$this->$model->$validation_name;
									
									$this->validation_errors[]=$this->validate($rules,$column,$cValue,true);
									
									
								}
							}
							
							
							if(!$this->validation_errors_exists){
								
								$insertStatement=$this->$model->insert_into_sql;
								
								$this->pdo->prepare($insertStatement);
								
								foreach($mColumns as $column){
										
									if(isset($this->$model->$column)){
											
										$cValue=$this->$model->$column;
											
										$this->pdo->bind(':'.$column,$cValue);
											
									}else{
											
										// Some value still needs to be bound, binding null
										$this->pdo->bind(':'.$column,null);
									}
										
								}
								
								$this->$model=null;
								
								return $this->pdo->execute();
								
							}
								


					}


		}
		
	}
	
	
	public function validate($rules,$column,$value,$insert=false,$validate=true){
		
		$errorMessages=array();
		
		if($insert){
			
			if(in_array('primary',$rules)){
				$validate=false;
				
			}
			
		}

		if($validate){

			foreach($rules as $rule){

					if($rule=='required'){
							
						if(empty($value)){
							$errorMessages[]=$column.' is required ';
							$this->validation_errors_exists=true;
						}
				
					}else if($rule=='intiger'){
							
						if(is_int($value)){
							
						}else{
							
							if(!ctype_digit($value)){
								$errorMessages[]=$column.' has to be an integer: ';
								$this->validation_errors_exists=true;
							}
						
						}
							
					}else if($rule=='decimal'){
	
						// echo '<p>Decimal column '.$column.$this->is_decimal($value).'    </p>';
			
						if(is_int($value)){
								// Intiger value is okay here
						}else{
						
							if(!is_numeric($value) && !floor($value)!=$value){
				
								$errorMessages[]=$column.' has to be a decimal ';
								$this->validation_errors_exists=true;
	
							}
				
						}
							
							
					}else if($rule=='string'){
				
						if(!is_string($value)){
							$errorMessages[]=$column.' has to be a string ';
							$this->validation_errors_exists=true;
				
						}
							
					}else if($rule=='date'){  // TODO: test this and impelent a view conversion
				
						$date = DateTime::createFromFormat('Y-d-m', $value);
						$dateErrors = DateTime::getLastErrors();
							
						if ($dateErrors['warning_count'] + $dateErrors['error_count'] > 0) {
							$errorMessages[] = $column.' needs to be a valid date! ';
							$this->validation_errors_exists=true;
						}
							
					}
				
				}
			
	
				
				if(isset($rules['max']) && isset($rules['min'])){
				
					$max=$rules['max'];
				
					$min=$rules['min'];
				
					if(is_string($value)){
						$lenght=strlen($value);
							
					}else{
						$lenght=strlen((string)$value);
					}
				
					// echo $column.' '.$max.' size: '.$lenght.' <br/><br/> ';
				
					if($lenght>=$max){
							
						$errorMessages[] = ' The maximum lenght for '. $column.' is '.$max.', current lenght is '.$lenght;
						$this->validation_errors_exists=true;
							
					}
				
				}
			
			}
		
		
		
		
		return $errorMessages;
		
	}
	
	

	/***
	 * Note: only use this after validation
	 * 
	 */
	
	
	public function insert($modelName,$redirect='index'){
		
		$getModelService='get_'.$modelName.'_model_value';
		
		if(method_exists($this,$getModelService)){
			
			$insertStatement=$this->$getModelService('insert_into_sql');
			
			$this->pdo->prepare($insertStatement);
			
			if(isset($_POST)){
			
				$mColumns=$this->$getModelService('columns');

				foreach($mColumns as $column){
				
					if(isset($_POST[$column])){
						
						$cValue=$_POST[$column];
	
						$this->pdo->bind(':'.$column,$cValue);
						
					}else{
						
						// Some value still needs to be bound, binding null
						$this->pdo->bind(':'.$column,null);
					}
		
				}
				
				$this->pdo->execute();
				
/* 				header('Location: ' . $redirect, true, $permanent ? 301 : 302);
				exit; */
				
			}else{
				
				trigger_error('Updating only allowed for post in this function', E_USER_ERROR);
				
			}

		
		}else{
			
			trigger_error('The model '.$modelName.' does not exist!', E_USER_ERROR);
			
		}
		
	}
	// TODO: undergoing refactoring!
	public function update($modelName,$updateIdColumn,$updateId,$redirect='index'){
		
		$getModelService='get_'.$modelName.'_model_value';

		if(method_exists($this,$getModelService)){
				
			$updateStatement=$this->$getModelService('update_base_sql');
			$binds=array();	
			$ue=false;

			// POST has to be defined
			if(isset($_POST)){
					
				$mColumns=$this->$getModelService('columns');
		
				foreach($mColumns as $index => $column){
		
					$d=' ';
					
					if($index > 0){
						$d=' , ';
							
					}
		
					if(isset($_POST[$column])){
		
						$cValue=$_POST[$column];
		
						$updateStatement.=$d.$this->$getModelService('update_'.$column.'_sql');
				
						if($updateIdColumn!=$column){
						
							$binds[]=array(':'.$column,$cValue);
						
						}
			
					}else{
		
						
						
						$getValidation=$column.'_validation';
						
						$v=$this->$getModelService($getValidation);
		
						if($v[0]=='required' || $v[0]=='unique'){
							
							trigger_error('The '.$column.' is required ', E_USER_ERROR);
							exit;
						}
		
						$updateStatement.=$d.$this->$getModelService('update_'.$column.'_sql');
						
						if($updateIdColumn!=$column){

							$binds[]=array(':'.$column,null);
			
						}
	
					}
		
				}
		
				$updateStatement.=" WHERE ".$updateIdColumn." = :".$updateIdColumn;

				$this->pdo->prepare($updateStatement);
				
				$this->pdo->bind(':'.$updateIdColumn,$updateId);
				
				foreach($binds as $bArray){
					
					// echo $bArray[0].':'.$bArray[1].'   ';
					$this->pdo->bind($bArray[0], $bArray[1]);
					
				}

				
				$this->pdo->execute();
				
	
				/* 				header('Location: ' . $redirect, true, $permanent ? 301 : 302);
				 exit; */
		
			}else{
		
				trigger_error('Updating only allowed for post in this function', E_USER_ERROR);
		
			}
		
		
		}else{
				
			trigger_error('The model '.$modelName.' does not exist!', E_USER_ERROR);
				
		}
		
		
	}
	
	
	/** Resets all the values
	 */
	public function reset(){
		
		
		
	}
	



}