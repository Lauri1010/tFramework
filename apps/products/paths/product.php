<?php
namespace tFramework;
require FRPATH.'layerPages'.DS.'baseFunctions.php';

class product extends baseFunctions{
	
	private $calledAction;

	function __construct() {
		$this->type='product';
	
	}

	public function product($language=null,$parameters=array()){
		
		$this->getLogic($this->type,__FUNCTION__);
 		if($this->af->getProduct($language,$parameters)){
 			require $this->getView($this->type,'index');
 		}else{
 			
 		}
	}
	
	public function productCart($language=null,$parameters=array()){
		$this->getLogic($this->type,__FUNCTION__);
 		if($this->af->getProductCart($language,$parameters)){
 			require $this->getView($this->type,'cart');
 		}else{
 			
 		}
	}
	

	
}