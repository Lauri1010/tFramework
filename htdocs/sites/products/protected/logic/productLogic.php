<?php
namespace tFramework;

require ROOT.DS.FRFOLDER.DS.'layerBusinessLogic'.DS.'backend.php';

class productLogic extends Backend{
	
	public $products;
	
	public function main(){
		
		
		
	}
	// TODO: Pending thorough testing of the feature
	public function getProducts(){
		
		// TODO A faster and easier way to create select statement.
		// TODO: make this faster so no generation occurs, saving to temporary storage
		$select="product.product_id.(AND,=,2),
				 product.product_name,
				 product.price,
				 product.join.product_category,
				 product_category.name,
				 product.join.product_vendor,
				 product_vendor.vendor_name,
				 product_vendor.join.product_vendor_financials,
				 product_vendor.balance.(AND,=,2),
				 limit.10
				 "; 
		
		
		
		// This would not be used directly, but the above query language would be translated to this and then ultimately to SQL
		$this->products=$this->ds->query(
				array(
					'product'=>array(
									'columns'=>array(
										'product_id'=>array(
												'AND',
												'=',
												'2'
										),
										'product_name',
										'price'
									),
									'join'=>array(
											'product_category'=>array(
												'columns'=>array(
														'product_category_name'
												),
												'join_type'=>'1'
											),
											'product_vendor'=>array(
												'columns'=>array(
															'vendor_name'
												),
												'join_type'=>'1',
												'join'=>array(
														'product_vendor_financials'=>array(
																'columns'=>array(
																		'balance'=>array(
																					'AND',
																					'>',
																					'20'
																		)
																),
																'join_type'=>'1'
												)
											)
													
										)
									)
									
					),
							
				),
			    '10',
			    null
			);
		
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