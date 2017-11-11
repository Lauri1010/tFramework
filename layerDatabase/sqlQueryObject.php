<?php
namespace tFramework;
require FRPATH.'layerDatabase'.DS.'sqlObject.php';
/**
 * @author Lauri Turunen
 *
 */
class sqlQueryObject extends sqlObject{

	protected $selectSql;
	protected $joinSql;
	protected $whereSql;
	protected $havingSql;
	protected $limitSql;
	protected $offsetSql;
	
	function __construct() {
		$this->selectSql='';
		$this->joinSql='';
		$this->whereSql='';
		$this->havingSql='';
		$this->limitSql='';
		$this->offsetSql='';
	}
	
	public function selectColumns($table,$columns=null){
		if(is_string($table)){
			$this->setSchema($table);
			$schemaName='schema_'.$table;
			$wSql=false;
			if(empty($this->selectSql)){
				$this->selectSql='SELECT';
				if(empty($this->joinSql)){
					$this->joinSql='FROM '.$this->$schemaName->table_name.' '.$this->$schemaName->table_alias;
				}
				$wSql=true;
			}

			if(isset($columns)){
	
				if(is_array($columns)){
						
					foreach($columns as $index=>$column){
	
						if(is_string($column)){
							$cName=$column.'_sql';
							if(isset($this->$schemaName->$cName)){
								if($wSql){
									$this->selectSql.=' '.$this->$schemaName->$cName;
								}else{
									$this->selectSql.=','.$this->$schemaName->$cName;
								}
							}else{
								trigger_error("Malformed table column data given.", E_USER_ERROR);
							}
	
						}
	
					}
						
				}else{
					trigger_error("Malformed table column data given.", E_USER_ERROR);
				}
	
			}else{
	
				$csName='select_columns_sql';
				if(isset($this->$schemaName->$csName)){
					$this->selectSql.=' '.$this->$schemaName->$csName;
				}
	
			}
	
		}else{
			trigger_error("Malformed table data given ", E_USER_ERROR);
		}
	}
	
	public function from($table){
		
		if(is_string($table)){
			
			$this->setSchema($table);
			$schemaName='schema_'.$table;
			
			if(empty($this->joinSql)){
				$this->joinSql.='FROM '.$this->$schemaName->table_name.' '.$this->$schemaName->table_alias;
			}
		}
		
	}
	
	public function joinFrom($table,$joinType,$toTable){
		if(is_string($table) && is_string($toTable) && is_string($joinType)){
	
			if(preg_match("/^join$|^inner join$|^left join$|^right join$|^full outer join$/i", $joinType)){

				$this->setSchema($table);
				$schemaName='schema_'.$table;
				$toJoinSql=$toTable.'_join_sql';
				
				if(empty($this->joinSql)){
					$this->joinSql.='FROM '.$this->$schemaName->table_name.' '.$this->$schemaName->table_alias;
				}
					
				if(isset($this->$schemaName->$toJoinSql)){
					$this->joinSql.=' '.$joinType.$this->$schemaName->$toJoinSql.' ';
				}else{
					trigger_error("No schema set for join ", E_USER_ERROR);
				}
				
			}else{
				trigger_error("Join type not supported ", E_USER_ERROR);
			}

		}else{
			trigger_error("Malformed table data given ", E_USER_ERROR);
		}
	}
	
	public function where($table,$column,$conditions){
	
		if(is_string($table) && is_string($column) && is_array($conditions)){
				
			$wSql=false;
			if(strlen($this->whereSql)==0){
				$wSql=true;
			}
			
			if(
					($wSql && isset($conditions[0]) && isset($conditions[1]))
					||
					(!$wSql && isset($conditions[0]) && isset($conditions[1]) && isset($conditions[2]))
					){
	
							
						if($wSql){
						
							if(
									!preg_match("/^=$|^>$|^<$|^>=$|^<=$|^<>$|^!=$|^like$/", $conditions[0])
									&&
									!(is_string($conditions[1]) || is_numeric($conditions[1]))
									){
										trigger_error("Malformed columns condition data", E_USER_ERROR);
							}
	
	
	
						}else{
	
							if(
									(
											!$conditions[0]=="AND" || !$conditions[0]=="OR")
									&&
									!preg_match("/^=$|^>$|^<$|^>=$|^<=$|^<>$|^!=$|^like$/", $conditions[1])
									&&
									!(is_string($conditions[2]) || is_numeric($conditions[2]))
									){
										trigger_error("Malformed columns condition data", E_USER_ERROR);
							}
	
	
						}
						
						$this->setSchema($table);
						$cnSql=$column.'_sql';
						$schemaName='schema_'.$table;
	
						if(isset($this->$schemaName->$cnSql)){
							$bSize=sizeof($this->binds);
							$alias=':'.$bSize.$column;
								
							if($wSql){
								$this->whereSql.=' WHERE '.$this->$schemaName->$cnSql.' '.$conditions[0].' '.$alias;
								$this->binds[$alias]=$conditions[1];

							}else{
								$this->whereSql.=' '.$conditions[0].' '.$this->$schemaName->$cnSql.' '.$conditions[1].' '.$alias;
								$this->binds[$alias]=$conditions[2];
							}
		
								
						}else{
							trigger_error("Malformed model data", E_USER_ERROR);
						}
		
			}else{
				trigger_error("Malformed data given ", E_USER_ERROR);
			}
				
				
		}else{
			trigger_error("Malformed data given ", E_USER_ERROR);
		}
	
	
	}
	
	public function setLimit($limit){
	
		if(is_string($limit) && is_numeric($limit)){
			$this->limitSql=' LIMIT '.$limit;
		}else{
			trigger_error("Malformed data given ", E_USER_ERROR);
		}
	
	}
	
	public function setOffset($offset){
	
		if(is_string($key) && is_string($offset) && is_numeric($offset)){
			$this->offsetSql=' OFFSET '.$offset;
		}else{
			trigger_error("Malformed data given ", E_USER_ERROR);
		}
	
	}
	
	public function getQuerySql(){
		
		if(!empty($this->selectSql)){
			
			$sql=$this->selectSql;
			
			if(!empty($this->joinSql)){
				$sql.=' '.$this->joinSql;
			}
			
			if(!empty($this->whereSql)){
				$sql.=$this->whereSql;
			}
			if(!empty($this->limitSql)){
				$sql.=$this->limitSql;
			}

			return $sql;
			
		}else{
			trigger_error("Sql not generated properly ", E_USER_ERROR);
		}
		
	}
	
	public function getBinds(){
		return $this->binds;
	}
	
}