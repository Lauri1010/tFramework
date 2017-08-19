<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_engagement.php'; 

class model_engagement extends helper_engagement {

public $e_row_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $page_id_ref_validation = array('required','intiger','max'=>20,'min'=>1);

public $time_spent_in_seconds_validation = array('intiger','max'=>10,'min'=>1);

public $scroll_depth_validation = array('intiger','max'=>10,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $e_row_id;

public $page_id_ref;

public $time_spent_in_seconds;

public $scroll_depth;

public $columns = array('e_row_id','page_id_ref','time_spent_in_seconds','scroll_depth');

}?>