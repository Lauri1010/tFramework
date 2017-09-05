<?php

$array=array(
				'product'=>array(
								'columns'=>array(
									'product_id'=>array(
											'andAbove'=>'2'
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
										)
								)
								
				),
						
			);
			
// echo var_dump($array['product']['columns']['product_id']);

foreach($array as $key => $a){
	
	
	if($key=='product'){
		
		$c=$a['columns'];
		
		foreach($a as $key => $value){
			var_dump($value);
		}
		
	}
	
}


?>