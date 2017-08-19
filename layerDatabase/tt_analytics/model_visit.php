<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_visit.php'; 

class model_visit extends helper_visit {

public $visit_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $visitor_id_ref_validation = array('required','intiger','max'=>20,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $visit_id;

public $visitor_id_ref;

public $columns = array('visit_id','visitor_id_ref');

}?>