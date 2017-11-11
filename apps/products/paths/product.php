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

/*  		$payload=$this->af->product['product_id'].'|'.$this->af->product['product_category_name'].'|'.$this->af->product['price'].'|'.$this->af->product['image_url'];
 			$this->response->content->set(array('foo' => 'bar', 'baz' => 'dib')); */
 			
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