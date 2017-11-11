<?php
namespace tFramework;

require ROOT.DS.FRFOLDER.DS.'layerBusinessLogic'.DS.'backend.php';

class productLogic extends Backend{
	
	public $product;
	public $cartProduct;

	public function main(){
		
		
	}

	// TODO: Pending thorough testing of the feature
	public function getProduct($lang='en',$parameters=array(),$key=__FUNCTION__){
		if(isset($parameters['r'])){
			$id=$parameters['r'];

 			if($this->ds->ifInAPCu($key)){
				$this->product=$this->ds->getFromAPCu($key);
			}{ 
				$qo=$this->ds->getSqlQueryObject();
				$qo->selectColumns('product');
				$qo->selectColumns('product_category',array('product_category_name'));
				$qo->joinFrom('product','JOIN','product_category');
				$qo->where('product','product_id',array('=',$id));
				$this->product=$this->ds->queryDo($qo,true);
				
				if(sizeof($this->product)>0){
					
					$this->ds->setToAPCu($key,$this->product);
					return true;
				}else{
					return false;
				}
			}

 		}else{
			return false;
		} 

	}
	
	// TODO: Pending thorough testing of the feature
	public function getProductCart($lang='en',$parameters=array(),$key=__FUNCTION__){
			if(isset($parameters['r'])){
				$id=$parameters['r'];
	
	 			if($this->ds->ifInAPCu($key)){
					$this->cartProduct=$this->ds->getFromAPCu($key);
				}{ 
					$qo=$this->ds->getSqlQueryObject();
					$qo->selectColumns('product');
					$qo->where('product','product_id',array('=',$id));
					$this->cartProduct=$this->ds->queryDo($qo,true);
					
					if(sizeof($this->cartProduct)>0){
						$this->ds->setToAPCu($key,$this->product);
						return true;
					}else{
						return false;
					}
			}
				
 			return true;
				
		}else{
			return false;
		} 
	
	}
	
	
	
	
}