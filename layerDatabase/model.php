<?php
namespace tFramework;
/***
 * Used as a class for manipulating model as an instance. 
 * 
 */

class model{
	
	protected $type;
	protected $isQuery;
	protected $isUpdate;
	protected $isInsert;
	
	function __construct($type,$type='query') {
	
		if(is_string($type)){
			
			$this->$type=$type;
			
			if($type=='query'){
				$this->isQuery=true;
			}
			
		}

	}
	

	
	
	
	
}