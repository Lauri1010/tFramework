<?php
namespace tFramework;

require FRPATH.'layerBusinessLogic'.DS.'backend.php';

class siteLogic extends Backend{
	
	public function main(){
		
		
	}
	
	// TODO: Pending thorough testing of the feature
	public function getProducts($lang='en',$parameters=array(),$key=__FUNCTION__){
		
		$key="gethProducts";
		
 		if($this->ds->ifInAPCu($key)){
			$this->products=$this->ds->getFromAPCu($key);
		}{ 
			$qo=$this->ds->getSqlQueryObject();
			$qo->selectColumns('product');
			$qo->setLimit('5');
			$this->products=$this->ds->queryDo($qo);
			$this->ds->setToAPCu($key,$this->products);
			
		}

	}

}