<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'products_database'.DS.'helper_product_category.php'; 

class schema_product_category extends helper_product_category {

public $product_category_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $product_category_name_validation = array('string','max'=>150,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $product_category_id;

public $product_category_name;

public $columns = array('product_category_id','product_category_name');

}?>