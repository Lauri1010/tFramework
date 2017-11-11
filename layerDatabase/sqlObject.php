<?php
namespace tFramework;

class sqlObject{
	
	protected $binds;
	public $tableKeys=array();
	
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
	
	protected function validate($table,&$binds){
		if(is_string($table) && is_array($binds)){
			$this->setSchema($table);
			$schemaName='schema_'.$table;
			
			foreach($binds as $column =>$bindValue){
				
				if(is_string($column)){
					$vName=$column.'_validation';
					$vald=$this->$schemaName->$vName;
					
					
					
				}

			}

		}else{
			trigger_error("table needs to be string and binds an array ", E_USER_ERROR);
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