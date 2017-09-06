<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'products_database'.DS.'helper_product_vendor_accounts.php'; 

class model_product_vendor_accounts extends helper_product_vendor_accounts {

public $account_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $account_name_validation = array('string','max'=>50,'min'=>1);

public $product_vendor_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $account_id;

public $account_name;

public $product_vendor_id_ref;

public $columns = array('account_id','account_name','product_vendor_id_ref');

}?>