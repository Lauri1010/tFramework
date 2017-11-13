<?php 
namespace tFramework; 
require DBFOLDER.'helper_product_vendor_financials.php'; 

class schema_product_vendor_financials extends helper_product_vendor_financials {

public $product_vendor_financials_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $balance_validation = array('decimal','max'=>10,'min'=>1,'decmials'=>2);

public $product_vendor_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $product_vendor_financials_id;

public $balance;

public $product_vendor_id_ref;

public $columns = array('product_vendor_financials_id','balance','product_vendor_id_ref');

}?>