<?php
namespace tFramework;

/***
	Start of the applocation logic

 */

require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'baseFunctions.php';

class product extends baseFunctions{
	
	private $calledAction;
	
	
	function __construct() {
		$this->type='product';

	}
	
	public function product($language=null){
		
		$this->getLogic($this->type);

		$this->af->getProducts();
		
		require $this->getInternalPath(array('layerPages','views','product','index.php'));

	}
	
	public function productTestTesting(){
		
		$this->getLogic($this->type);
		
		require $this->getInternalPath(array('layerPages','views','product','test.php'));
		
	}
	
	public function testing($language=null){
		
		$this->getLogic($this->type,__FUNCTION__);
		
		require $this->getInternalPath(array('layerPages','views','product','test.php'));
	
	}
	
	public function update(){
		
/* 		$this->ds->set_product('product_id',10);
		$this->ds->set_product('product_name','Scarf');
		$this->ds->set_product('price',100);
		$this->ds->set_product('product_type_ref',1);
		$this->ds->set_product('product_store_ref',5);
		$this->ds->set_product('discount_price',55);
		$this->ds->set_product('image_url','url.jpeg');
		
		if($this->ds->save('product','product_id')){
			echo 'Success!';
		}else{
			
			var_dump($this->ds->validation_errors); exit;
			
			
		} */
		
/* 		if(is_array($message)){
			
			foreach(){
				
				
				
			}
			
		} */
		
	}
	
	
	public function test($language=null){
				
/* 		require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tproduct.php';
		
		$tProduct=new tProduct();
		
		$selectAllSql="SELECT $tProduct->selectColumns FROM $tProduct->tableName";
		
		$this->pdo->prepare($selectAllSql);
		
		$pResults=$this->pdo->resultset();
		
		foreach($pResults as $row){
			
			echo $row['product_name'];
			
		} */
		
	}
	
	public function secondJoinTest($language=null){

		// $this->projectdatabaseService();
		
/* 		$this->ds->q('product',array('product_name','price'));
		$this->ds->q('store',array('store_name'),'product');
		$this->ds->q('store_type',array('store_type_name'),'store');
		$this->ds->q('product_type',array('product_type_description'),'product');

		// $this->projectDatabase->setLimitAndOffset(2);

		$this->ds->where('product', 'price', ">15 AND");
		$this->ds->where('store', 'store_name', "='Ponkes'");
		
		$this->ds->orderBy('product', 'price', "ASC");
		 */
/*    	$this->ds->setSqlStatement();
		echo $this->ds->sqlQuery; */   

		
  		// $data=$this->ds->qd();

		// var_dump($s->sqlQuery);
		
  		// require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'views'.DS.'productList.php';

		// echo $s->test();
		
	}
	
	
	public function pants($language=null){
		
/* 		if($language!=null){
				
			$callHtml='HtmlPants'.$language;
				
			echo $this->$callHtml();
				
		}else{
			
			$callHtml='HtmlPantsEn';
			
			echo $this->$callHtml();
		
				
		} */
		
	}
	
// 	public function paginator($language=null){
	
// /* 		$lo=$this->paginator();
		
// 		// var_dump($lo); exit;
	
// 		require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'projectdatabase'.DS.'sql_service_projectdatabase.php';
		
// 		$s=new sql_service_projectdatabase();
		
// 		$s->q('product');
// 		$s->setLimitAndOffset($lo[0],$lo[1]); */
		
// /* 		$s->setSqlStatement();
// 		echo $s->sqlQuery; exit; */
		
// /* 		$pResults=$s->qd();
		
// 		foreach($pResults as $results){
			
// 			echo $results['product_name'].'<br/><br/>';
			
// 		} */
		
		
// 	}
	
	public function PaginatorPantsShorts($language=null){
	
		// echo 'Paginator for shorts';
	
	}
	
	
	
	
}