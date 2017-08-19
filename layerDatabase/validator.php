<?php
/**
 * Note: to use this validator the forms have to use a naming convention.
 * Each form input field is to be named after the model ones.
 * There are no view form generators (as of yet). 
 * 
 */
namespace tFramework;
class validator{
	
	public function executeInsertRequest($modelName){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			if(isset($_POST)){

				$requiredModel= ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'model_'.$modelName;
				
				if(is_file($requiredModel)){
					
					require $requiredModel;
					
					$callableModel='model_'.$modelName;
					
					$model=new $callableModel();
					
					$validations=get_object_vars($model);
	
 					foreach ($_POST as $tableColumn => $tableName) {

							$validationRule=$validations[$tableColumn];
 						
 						
							
					} 

				}
				

			}else{
				
				return false;
				
			}

			
		}else{
			
			return false;
			
			
		}
	}
	
	public function formValidationRules($model){
		
		
		
	}
	
	
	public function insert($modelName){
		
		$message=$this->executeInsertRequest($modelName);
			
		if($message){
			// TODO: translation can be used
			return "Only post insert requests allowed!";
			
		}else{
			
			return $message;
			
		}

	}

}
?>