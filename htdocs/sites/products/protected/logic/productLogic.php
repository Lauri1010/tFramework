<?php
namespace tFramework;

require ROOT.DS.FRFOLDER.DS.'layerBusinessLogic'.DS.'backend.php';

class productLogic extends Backend{
	
	public $products;
	
	public function main(){
		
		
		
	}
	// TODO: Pending thorough testing of the feature
	public function getProducts(){

		$sql='';
		$this->ds->selectColumns($sql,'product',null,true);
		$this->ds->selectColumns($sql,'product_category',array('product_category_name'));
		$this->ds->selectColumns($sql,'product_vendor',array('vendor_name'));
		$this->ds->selectColumns($sql,'product_vendor_accounts',array('account_name'));
		$this->ds->selectColumns($sql,'product_vendor_financials',array('balance'));
		$this->ds->joinFrom($sql,'product','product_category','join',true);
		$this->ds->joinFrom($sql,'product','product_vendor','join');
		$this->ds->joinFrom($sql,'product_vendor','product_vendor_financials','join');
		$this->ds->joinFrom($sql,'product_vendor','product_vendor_accounts','join');
		$this->ds->where($sql,'product','price',array('>','5'),true);
		$this->ds->where($sql,'product_vendor_financials','balance',array('AND','>','90'));
		$sql.=' LIMIT 2 ';
		$this->products=$this->ds->eBoundQueryRs($sql);
	

/* 		$dataObject=array(
				'product'=>array(
						'product_id'=>array('AND','=','2'),
						'product_name',
						'price',
						'join'=>array(
								'product_category'=>array(
										'product_category_name'
								),
								'product_vendor'=>array(
										'vendor_name',
										'join'=>array(
												'product_vendor_financials'=>array(
														'balance'=>array(
																'AND',
																'>',
																'20'
														)
												),
												'product_vendor_accounts'=>array(
														'account_name'
												)
										)
								)
						)
				),
				
		);
		
		foreach($dataObject as $index=>$dRowContent){
			echo var_dump($dRowContent).'</br/>';
		}
		exit;
		
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
															),
															'product_vendor_accounts'=>array(
																	'columns'=>array(
																			'account_name'
																	),
																	'join_type'=>'1'
															),
													)
													
											)
									)
									
					),
							
				),
			    '10',
			    null
			);  */
		
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