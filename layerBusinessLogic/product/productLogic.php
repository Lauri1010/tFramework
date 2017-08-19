<?php
namespace tFramework;

require ROOT.DS.FRFOLDER.DS.'layerBusinessLogic'.DS.'backend.php';

class productLogic extends Backend{
	
	public $products;
	
	public function main(){
		
		
		
	}
	
	public function getProducts(){
		
		$this->ds->q('product',null,array('product_id','product_name','price'));
		$this->ds->q('product_category','product',array('product_category_name'));
		
		$this->ds->where('product', 'product_name', '=' , "Levis");
		
		$this->ds->setLimitAndOffset(10);
		
		$this->products=$this->ds->qd();
		
		
	}
	
	// public function 
	
	
	public function getRecentPosts(){
		
/* 		$this->ds->q('blog_post');
		$this->posts=$this->ds->qd(); */
		
	}
	
	public function getActors(){
		
/* 		$this->ds->q('film');
		$this->ds->q('film_actor','film');
		$this->ds->q('actor','film_actor');
		
		$this->ds->where('actor', 'first_name', "='PENELOPE'");
		
		$this->ds->setLimitAndOffset(10);
		
		$this->films=$this->ds->qd(); */

	}
	
	
}