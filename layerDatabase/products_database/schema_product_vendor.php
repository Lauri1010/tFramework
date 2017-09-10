<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'products_database'.DS.'helper_product_vendor.php'; 

class schema_product_vendor extends helper_product_vendor {

public $vendor_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $vendor_name_validation = array('string','max'=>50,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $vendor_id;

public $vendor_name;

public $columns = array('vendor_id','vendor_name');

}?>