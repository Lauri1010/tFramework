<?php
namespace tFramework;
/***
 * Used as a class for manipulating model as an instance. 
 * 
 */

require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'sql_service_base.php';

class model extends Sql_service_base{
	
	protected $sql_update;
	protected $sql_insert;
	protected $joins;
	
	protected function update(){
		
		if(isset($this->columns)){
			
			
		}else{
			trigger_error("This function can only be invoked by a child class inheriting this function!", E_USER_ERROR);
			
		}
		
	}
	
	
	protected function insert(){
		
		
		
	}
	
	protected function query($dbName,$dataObject){
		
		$sql="SELECT ";
		$as=0;
		
		if(isset($dataObject)){
	
			$cl=$this->columns.length;
			for($i=0;$i<$cl;$i++){
					if(isset($this->$this->columns[i])){
						$sql.=$this->$this->columns[i]+" ";
						$as++;
					}
					if($i!=($cl-1)){
						$sql.=",";
					}
			}
			
			if($as>0){
				
				$sql.="FROM ".$this->table_name;
				
				if($joins!==null && isset($joins) && is_array($joins)){
					
					for($i=0;$i<$joins.length;$i++){
						
						$j='';
						
						// TODO: Create functionality for this for other types of joins
						if(isset($joins[$i][1])){
							
							if(is_string($joins[$i][1])){
								$j=$joins.$joins[$i][1]."_sql";
							}else{
								trigger_error("Join command not a string", E_USER_ERROR);
							}
		
						}else if(isset($joins[$i])){
							$j=$joins."_join_sql";
						}
						
							if(strlen($j)>0){
								
								if(isset($this->$j)){
									$sql.=$this->$j.' ';
								}else{
									
									$helper=$this->getHelper($joins[$i]);
									
									if(isset($helper->$j)){
										
										if(is_string($helper->$j)){
											$sql.=$helper->$j.' ';
										}else{
											trigger_error("join is not set in model ".$joins[$i], E_USER_ERROR);
										}
										

									}else{
										trigger_error("join is not set in model ".$joins[$i], E_USER_ERROR);
									}
								
								}
								
								if(isset($where)){
									if(is_array($where)){
								
										$sql.+'WHERE';
								
										for($i=0;$i<$where.length;$i++){
											if(isset($where[$i][0]) && isset($where[$i][1])){
												$sql.+' '+$where[$i][0];
											}
												
										}
								
										if(isset($where[])){
												
										}
									}
								}
								
	
							}else{
								trigger_error("String length ", E_USER_ERROR);
							}
						
					}

					
				}else{
					if(!is_array($joins)){
						trigger_error("Joins not an array", E_USER_ERROR);
					}

				}
				
				
				
			}else{
				trigger_error("Nothing added to the select, you need to set values to the model fields", E_USER_ERROR);
			}
			
		}else{
			trigger_error("This is impossible? Columns not generated in model class", E_USER_ERROR);
		}


	}
	
	protected function getHelper($dbName,$helperName){
		$helperPath=ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.$dbName.DS.$helperName;
		
		if(is_file($helperPath)){
			require $helperPath;
			return new $helperName();
			
		}else{
			trigger_error("Helper does not exist!", E_USER_ERROR);
		}
		
	}
	
	
	
	/**
		This can only be caled from data services when it confirmed that the model exists in database
	 */
	
	protected function generateUpdateSql(){

		if(isset($this->columns)){
				
			$sqlUpdate;
			
			if(isset($this->update_base_sql)){
				
				$this->sql_update=$this->update_base_sql;
				
			}else{
				trigger_error("update base statement must existin the child class!", E_USER_ERROR);
			
			}

			$fr=false;
			
			foreach($this->columns as $column){
				if(isset($this->$column)){
						
					$updateColumn='update_'.$column.'sql';
					
					if(isset($this->$updateColumn)){
						if($fr){
							$this->sql_update.=' '.$this->$updateColumn;
							$fr=false;
						}else{
							$this->sql_update.=','.$this->$updateColumn.' ';
						}
	
			
					}else{
						trigger_error("This class can only be used in parent classes!", E_USER_ERROR);
						
					}
				}
			}

				
		}

	
	}
	
	
}