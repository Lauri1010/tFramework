<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_flow.php'; 

class model_flow extends helper_flow {

public $flow_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $previous_page_id_ref_validation = array('required','intiger','max'=>20,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $flow_id;

public $previous_page_id_ref;

public $columns = array('flow_id','previous_page_id_ref');

}?>