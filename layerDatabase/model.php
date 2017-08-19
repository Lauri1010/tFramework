<?php
/***
 * Used as a class for manipulating model as an instance. 
 * 
 */

require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'sql_service_base.php';

class model{
	
	public $sql_update;
	public $sql_insert;
	
	public function update(){
		
		if(isset($this->columns)){
			
			
		}else{
			trigger_error("This function can only be invoked by a child class inheriting this function!", E_USER_ERROR);
			
		}
		
	}
	
	
	public function insert(){
		
		
		
	}
	
	// public function 
	
	
	// public function update
	
	/**
		This can only be caled from data services when it confirmed that the model exists in database
	 */
	
	public function generateUpdateSql(){

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
	
	public function generateInsertSql(){
		
		
		
	}
	
	
}