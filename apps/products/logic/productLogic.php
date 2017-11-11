<?php
namespace tFramework;

require ROOT.DS.FRFOLDER.DS.'layerBusinessLogic'.DS.'backend.php';

class productLogic extends Backend{
	
	public $product;
	public $cartProduct;

	public function main(){
		
		
	}

	public function getProduct($lang='en',$parameters=array(),$key=__FUNCTION__){
		if(isset($parameters['r'])){
			
				$id=$parameters['r'];
				$key.=$id;
				$data=$this->ds->getFromAPCu($key);
				
				// Simulate an update to a database with spesific tables
				// $this->ds->setUpdated(array('product','product_category')); exit;
				
				if($this->ds->isUpdated(array('product','product_category'),$key) || empty($data)){
					$qo=$this->ds->getSqlQueryObject();
					$qo->selectColumns('product');
					$qo->selectColumns('product_category',array('product_category_name'));
					$qo->joinFrom('product','JOIN','product_category');
					$qo->where('product','product_id',array('=',$id));
					$this->product=$this->ds->queryDo($qo,true);
					$this->ds->setToAPCu($key,$this->product);
				}else if(!empty($data)){
					$this->product=$data;	
				}else{
					trigger_error("Error in APCu caching", E_USER_ERROR);
				}

				return true;
				
 		}else{
			return false;
		} 

	}

	public function getProductCart($lang='en',$parameters=array(),$key=__FUNCTION__){
			if(isset($parameters['r'])){
				$id=$parameters['r'];
				$key.=$id;
				$data=$this->ds->getFromAPCu($key);
				
				if($this->ds->isUpdated(array('product'),$key) || empty($data)){
					$qo=$this->ds->getSqlQueryObject();
					$qo->selectColumns('product');
					$qo->where('product','product_id',array('=',$id));
					$this->cartProduct=$this->ds->queryDo($qo,true);
					$this->ds->setToAPCu($key,$this->cartProduct);
				}else if(!empty($data)){
					$this->cartProduct=$data;
				}else{
					trigger_error("Error in APCu caching", E_USER_ERROR);
				}
				
				return true;
				
			
			}else{
				return false;
			}

	}
	
	
	
	
}