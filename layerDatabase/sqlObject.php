<?php
namespace tFramework;

class sqlObject{
	
	protected $binds;
	public $tableKeys=array();
	public $errorMessages=array();
	
	function __construct() {
		$this->binds=array();
	}
	
	public function setQueryKeys($table){
		if(is_string($table)){
			if(!in_array($value, $this->tableKeys)){
				$this->tableKeys[]=$table;
			}
		}
	}
	
	protected function validate($table,$binds){
		if(is_string($table) && is_array($binds)){
			$this->setSchema($table);
			$schemaName='schema_'.$table;
			
			foreach($binds as $column =>$bindValue){
				
				if(is_string($column)){
					$vName=$column.'_validation';
					$rules=$this->$schemaName->$vName;
					if(is_array($rules)){
						return $this->getValidations($rules,$column,$bindValue);
					}else{
						trigger_error("Table validation has to be an array! Check the schema generator for errors", E_USER_ERROR);
					}
					
				}

			}

		}else{
			trigger_error("table needs to be string and binds an array ", E_USER_ERROR);
		}

	}
	
	protected function getValidations($rules,$column,$value,$insert=false,$validate=true){
	
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
					}
	
				}else if($rule=='intiger'){
						
					if(is_int($value)){
							
					}else{
							
						if(!ctype_digit($value)){
							$errorMessages[]=$column.' has to be an integer: ';
						}
	
					}
						
				}else if($rule=='decimal'){
	
					// echo '<p>Decimal column '.$column.$this->is_decimal($value).'    </p>';
						
					if(is_int($value)){
						// Intiger value is okay here
					}else{
	
						if(!is_numeric($value) && !floor($value)!=$value){
							$errorMessages[]=$column.' has to be a decimal ';

						}
	
					}
						
						
				}else if($rule=='string'){
	
					if(!is_string($value)){
						$errorMessages[]=$column.' has to be a string ';

					}
						
				}else if($rule=='date'){  // TODO: test this and impelent a view conversion
	
					$date = DateTime::createFromFormat('Y-d-m', $value);
					$dateErrors = DateTime::getLastErrors();
						
					if ($dateErrors['warning_count'] + $dateErrors['error_count'] > 0) {
						$errorMessages[] = $column.' needs to be a valid date! ';
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
	
				if($lenght>=$max){
					$errorMessages[] = ' The maximum lenght for '. $column.' is '.$max.', current lenght is '.$lenght;
						
				}
	
			}
			
			return $errorMessages;
				
		}

	}
	
	protected function setSchema($table){
	
		try{
	
			$schemaName='schema_'.$table;
			$schemaCallClass='tFramework\\'.$schemaName;
	
			if(!isset($this->$schemaName)){
	
				$rt=DBFOLDER.$schemaName.'.php';
					
				if(is_file($rt)){
					require $rt;
					$this->{$schemaName}=new $schemaCallClass();
				}else{
					trigger_error("Class does not exist with path ".$rt, E_USER_ERROR);
				}
	
			}
	
		}catch (Exception $e) {
			trigger_error("Error in setting helper", E_USER_ERROR);
		}
	
	}
	
	
}