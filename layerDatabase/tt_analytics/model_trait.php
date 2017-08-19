<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_trait.php'; 

class model_trait extends helper_trait {

public $trait_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $trait_item_validation = array('string','max'=>250,'min'=>1);

public $columns = array('trait_id','trait_item');

public $trait_id;

public $trait_item;

public $insert_sql_statement;

public $update_sql_statement;

}?>

