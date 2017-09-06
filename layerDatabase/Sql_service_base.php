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
	protected $model;
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
		$this->binds=array();
	}
	
/* 	private function connectDatabase($dbName,$dbHost,$dbName,$dbUser=null,$dbPassword=null){
		
		if(is_string($dbName)){
			DB_NAME=$dbName;
		}
		
		
		
	} */
	
	
	public function initiatePdo(){
	
		if(empty($this->pdo)){
				
			require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'database.php';
	
			$this->pdo=new database();
	
		}
	
	}
	
	public function setModel($table){

		try{
			
			$newClass=false;

			$modelName='model_'.$table;
			$modelCallClass='tFramework\\'.$modelName;

			if(!isset($this->$modelName)){
				
				$rt=ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.DB_NAME.DS.$modelName.'.php';
					
				if(is_file($rt)){
					require $rt;
					$this->{$modelName}=new $modelCallClass();
				}else{
					trigger_error("Class does not exist with path ".$rt, E_USER_ERROR);
				}
				
			}
	
		}catch (Exception $e) {
			trigger_error("Error in setting helper", E_USER_ERROR);
		}

		
	}
	
	protected function eBoundQueryRs($sql,$binds){

		if(is_string($sql) && strlen($sql)>0 && is_array($binds)){
			
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
	
	public function createSqlCommandsArray($query){
		
		if(is_string($query)){
			$rQa=explode(',', $query);
			
			foreach($rQa as $row){
				$rowData=explode('.', $row);
				
				if(isset($rowData[0]) && isset($rowData[1])){
					
					if($rowData[1]=='join'){
						
					}else{

						if($rowData[0]=='limit'){
							
						}
						
						if(isset($rowData[2])){
							
						}
						
						$tableName=$rowData[0];
						$tableColumn=$rowData[1];
						
					}

				}else{
					trigger_error("Table data not present or query is malformed", E_USER_ERROR);
				}
				
				
			}
			
			
		}else{
			trigger_error("Query needs to be a string", E_USER_ERROR);
		}
		
	}
	
	public function query($dataObject,$limit=null,$offset=null){
	
		$selectSql="SELECT ";
		$whereSql=" WHERE ";
		$havingSql=" HAVING ";
		$limitSql=" LIMIT ";
		$offsetSql=" OFFSET ";
		$joinSql="";
		$lSql="";
		$sCount=0;
		$wCount=0;
		$hCount=0;
		$jCount=0;
		$as=0;
		$helper;
		$joinObject;
		$binds=array();
	
		if(isset($dataObject)){
			
				if(is_array($dataObject)){
					$table=key($dataObject);
					$dRow=$dataObject[$table];
	
						if(is_array($dRow['columns'])){
							
								$modelName='model_'.$table;
								
								$this->generateJoinStatement($table,null,$joinSql,$jCount);
								$this->generateSelectAndConditions($table,$dRow['columns'],$selectSql,$whereSql,$havingSql,$sCount,$wCount,$hCount,$binds);

								if(isset($dRow['join'])){
									
									$goDeeper=false;
									$dTableObject=$dRow['join'];
									$fromTable=$table;
									$dCount=0;
									$dRowTempData=array();
									$goDeep=false;
								
										do{
											// Goes the fist path horizontally
											foreach($dTableObject as $dTable => $dataRow){
												
													if(isset($dataRow['columns'])){
													
														if(!is_array($dataRow['columns'])){
															trigger_error("Coumns not an array in join element!", E_USER_ERROR);
														}
														
														$this->generateSelectAndConditions($dTable,$dataRow['columns'],$selectSql,$whereSql,$havingSql,$sCount,$wCount,$hCount,$binds);
														$this->generateJoinStatement($fromTable,$dTable,$joinSql,$jCount);
														
													}else{
														
														trigger_error("Columns not an array in join element!", E_USER_ERROR);
													}
													
													// Save vertical joins per table
													if(isset($dataRow['join'])){
														$dRowTempData[]=$dataRow['join'];
														$dRowTempData=$dRowTempData[0];
													}
											}
											
											if(isset($dRowTempData)){
												$dTableObject=$dRowTempData;
												unset($dRowTempData);
												$fromTable=$dTable;
												$goDeep=true;
											}else{
												$goDeep=false;
											}
										
										}while($goDeep);
				
								}
	
						}else{
							trigger_error("Tables and columns not an array!", E_USER_ERROR);
						}
					}
					
					if($wCount==0){
						$whereSql="";
					}
					
					if($jCount==0){
						$joinSql="";
					}
					
					if($hCount==0){
						$havingSql="";
					}
					
					if(is_string($limit)){
						$lSql.=" LIMIT $limit";
						
						if(is_string($offset)){
							$lSql.=" OFFSET $offset";
						}
						
					}

					$sql=$selectSql.$joinSql.$whereSql.$lSql;
		
					return $this->eBoundQueryRs($sql,$binds);
					
			}else{
				trigger_error("Data object is not an array!", E_USER_ERROR);
			}
	
	
	}
	
	private function generateSelectAndConditions($table,$columns,&$selectSql,&$whereSql,&$havingSql,&$sCount,&$wCount,&$hCount,&$binds){
		
		if(is_string($table) 
		&& is_array($columns) 
		&& is_string($whereSql) 
		&& is_string($havingSql)
		&& is_numeric($sCount)
		&& is_array($binds)){
				
				foreach($columns as $index=>$column){
					
					if(is_array($column) || is_string($column)){
		
						$cName="";
						$modelName='model_'.$table;
						
						if(is_array($column)){
						
							if(!(is_string($index) && isset($column[0]) && isset($column[1]) && isset($column[2]))){
								trigger_error("Malformed columns array", E_USER_ERROR);
							}
							
							$cName=$index;
				
							$condition=$column[0];
							$comparison=$column[1];
							$comparisonValue=$column[2];
							
								if(($condition=="AND" || $condition=="OR") &&
									preg_match("/^=$|^>$|^<$|^>=$|^<=$|^<>$|^!=$|^like$/", $comparison) &&
									is_string($comparisonValue)
								){
									
					
									$this->setModel($table);
									$cnSql=$cName.'_sql';
									
									if(isset($this->$modelName->$cnSql)){
									
										$pName=$wCount.$cName;
										$alias=':'.$pName;
										$binds[$alias]=$comparisonValue;
					
										if($wCount>0){
											$whereSql.=' '.$condition.' '.$this->$modelName->$cnSql.' '.$comparison.' '.$alias;
										}else{
											$whereSql.=' '.$this->$modelName->$cnSql.' '.$comparison.' '.$alias;
										}
										$wCount++;
		
									}else{
										trigger_error("Malformed model data", E_USER_ERROR);
									}
							
								}else {
									trigger_error("Malformed columns condition data", E_USER_ERROR);
								}
						}else{
							$cName=$column;
						}
						
								$cs=$cName.'_sql';
						
								$this->setModel($table);
								
								if(isset($this->$modelName->$cs)){
									
									if($sCount>0){
										$selectSql.=','.$this->$modelName->$cs;
									}else if($sCount==0){
										$selectSql.=$this->$modelName->$cs;
									}else{
										trigger_error("Impossible column count!", E_USER_ERROR);
									}
			
									$sCount++;
									
								}else{
									
									trigger_error("Model not properly set", E_USER_ERROR);
								}
	
					}else{
						
						trigger_error("Malformed columns condition data", E_USER_ERROR);
					}


					
				}
				
		}else{
			trigger_error("Table needs to be a string ", E_USER_ERROR);
			
		}
		
	}

	private function generateJoinStatement($fromTable,$joinToTable=null,&$joinSql,&$jCount,$joinType='join'){
		

		if(is_string($joinSql) && is_string($fromTable) && is_numeric($jCount)){

					$modelName='model_'.$fromTable;
			
					if($joinToTable==null){
						
						if(empty($joinSql)){
							$this->setModel($fromTable);
							$alias='table_alias';
							if(isset($this->$modelName->$alias)){
								$joinSql=" FROM ".$fromTable.' '.$this->$modelName->$alias;
							}else{
								trigger_error("Malformed model data", E_USER_ERROR);
							}
						}else{
							trigger_error("Join sql string needs to be empty at this point", E_USER_ERROR);
						}
						

					}else{
			
						$cs=$joinToTable.'_'.$joinType.'_sql';
						$this->setModel($fromTable);
						
						if(isset($this->$modelName->$cs)){
							$joinSql.=' '.$joinType.' '.$this->$modelName->$cs;
							$jCount++;
						}else{
							trigger_error("Malformed model data", E_USER_ERROR);
						}
					
					}


		}else{
			trigger_error("Table needs to be a string ".dbName, E_USER_ERROR);
			
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