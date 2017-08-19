<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'products_database'.DS.'helper_store.php'; 

class model_store extends helper_store {

public $store_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $store_name_validation = array('string','max'=>150,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $store_id;

public $store_name;

public $columns = array('store_id','store_name');

}?>