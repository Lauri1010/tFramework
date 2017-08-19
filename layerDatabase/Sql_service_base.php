<?php
namespace tFramework;

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
	
	protected $previousTable;
	
	// The first row of column selection
	protected $firstRow;

	function __construct($ipdo=true) {
		
		if($ipdo){
			$this->initiatePdo();
		}
		
		$this->validation_errors_exists=false;

		$this->previousTable=null;
		$this->firstRow=true;
		$this->validation_errors=array();
	}
	
	public function test(){
		

		
	}
	
	
	public function initiatePdo(){
	
		if(empty($this->pdo)){
				
			require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'database.php';
	
			$this->pdo=new database();
	
		}
	
	}
	
	/**
	 * Function to build the sql queries and joins
	 * 
	 * @param unknown $table
	 * @param string $columns
	 * @param string $joinType
	 */
	
	public function q($table,$joinTable=null,$columns=null,$joinType='JOIN'){
	
		if(empty($this->select)){
			$this->select='SELECT ';
			$this->firstRow=true;
		}

		$getParameterService='get_'.$table.'_model_value';

		if(method_exists($this,$getParameterService)){

			if($columns==null){
			
				if($this->firstRow){
					
					$this->select.=' '.$this->$getParameterService("select_columns_sql");
					
				}else{
					
					$this->select.=' ,'.$this->$getParameterService("select_columns_sql");
					
				}
			
			}else{
				
				if(is_array($columns)){
					
					foreach($columns as $index => $column){
						
						$getColumnSql=$column.'_sql';
						
						if($index>0){
							
							$this->select.=', '.$this->$getParameterService($getColumnSql);

						}else{
							
							if($this->firstRow){
								$this->select.=' '.$this->$getParameterService($getColumnSql);
							}else{
								$this->select.=', '.$this->$getParameterService($getColumnSql);
							}
	
						}

					}
	
				}
	
			}
			
		}else{

			trigger_error("Cannot get the helper class ".$getParameterService, E_USER_ERROR); 
			
		}
		
		// Forming the join statements
		
		
		if(empty($this->join) && $this->firstRow){
			
			if(isset($this->$table)){
				
				$this->firstRow=false;
				
				$alias=$this->$table->table_alias;
				
				$this->join=" FROM $table $alias ";
				
				$this->previousTable=$table;
				
			}else{
					
				// Create new (above) 
					
				trigger_error("Table helper $table should be initiated in join function", E_USER_ERROR);
					
			}
			
		}else{
			
			if($joinTable!=null){

				$jStatement=$table.'_join_sql';
				
				$joinFromService='get_'.$joinTable.'_model_value';
				
				$this->join.=" ".$joinType." ".$this->$joinFromService($jStatement);

			}else{
				
				trigger_error("From which table to join is empty ".$this->join, E_USER_ERROR);
				
			}

			
		}
		
	
	}
	
	
	/**
	 * @param unknown $table
	 * @param unknown $column
	 * @param unknown $condition the actual SQL of the condition
	 */
	
	public function where($table,$column,$conditionType,$condition){
		
		$getParameterService='get_'.$table.'_model_value';
		
		if(method_exists($this,$getParameterService)){
			
			$conditionColumn=$this->$getParameterService($column.'_sql');
		
			if(empty($this->condition)){
				$this->condition=' WHERE ';
			}
			
			$bindedAlias=':'.$column;
			
			$this->condition.=$conditionColumn.' '.$conditionType.' '.$bindedAlias;

			if(!isset($this->conditionBindList)){
				
				$this->conditionBindList=array();

			}

			$this->conditionBindList[]=array($bindedAlias,$condition);
	
		}
		
		
	}

	public function setLimitAndOffset($limit,$offset=null){

		if(is_numeric($limit)){

			if(empty($offset)){

					$this->limit=$limit;
				
					$this->limitAndOffset=" LIMIT :limit ";

			}else{

				if(is_numeric($offset)){
					
					$this->limit=$limit;
					$this->offset=$offset;
					
					$this->limitAndOffset=" LIMIT :limit OFFSET :offset";
					
				}else{
	
					trigger_error("Limit and offset have to be numeric ", E_USER_ERROR);

				}

			}

			
		}else{
			
			trigger_error("Limit has to be numeric ", E_USER_ERROR);
			
		}
	
		
	}
	
	/**
	 * 
	 * @param unknown $table
	 * @param unknown $column
	 * @param unknown $orderByType ASC or DESC
	 */
	public function orderBy($table,$column,$orderByType){
	
		$getParameterService='get_'.$table.'_model_value';
	
		if(method_exists($this,$getParameterService)){
				
			$conditionColumn=$this->$getParameterService($column.'_sql');
	
			if(empty($this->orderBy)){
				$this->orderBy=' ORDER BY ';
			}
				
			$this->orderBy.=$conditionColumn.' '.$orderByType;
				
		}

	}
	
	
	public function qd(){
		$this->setSqlStatement();
		return $this->getResultSet();
		
	}
	

	public function setSqlStatement(){
		
		
/* 		if(isset($this->conditionBindList)){
			
			if(is_array($this->conditionBindList)){
				
				foreach($this->conditionBindList as $cArray){
						
					$column=$cArray[0];
					$conditionType=$cArray[1];
					$condition=$cArray[2];
		
					$this->condition.=$column.' '.$conditionType;
					
				}
				
			}
			
		}
		 */

		$this->sqlQuery=$this->select.$this->join.$this->condition.$this->groupBy.$this->orderBy.$this->limitAndOffset;
		

	}
	
	public function resetSqlStatement(){
		
		$this->sqlQuery='';
		$this->select='';
		$this->join='';
		$this->condition='';
		$this->groupBy='';
		$this->orderBy='';
		$this->limitAndOffset='';
		$this->limit='';
		$this->offset='';
	}
	
	public function getResultSet(){
		
		if(!empty($this->sqlQuery)){

			$this->initiatePdo();
			
			$this->pdo->prepare($this->sqlQuery);

			if(!empty($this->conditionBindList)){
				
				foreach($this->conditionBindList as $bItem){

					$this->pdo->bind($bItem[0], $bItem[1]);
	
				}

			}
			
			if(!empty($this->limit)){
				
				$this->pdo->bind(':limit', $this->limit);
				
			}
			
			if(!empty($this->offset)){
				
				$this->pdo->bind(':offset', $this->offset);
				
				
			}

			if($this->limit==1){

				$this->resetSqlStatement();
				return $this->pdo->single();
				
			}else{

				$this->resetSqlStatement();
				return $this->pdo->resultset();

			}


			
		}else{
			
			trigger_error("The sql query is empty. ", E_USER_ERROR);

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