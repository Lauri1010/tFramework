<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_visitor.php'; 

class model_visitor extends helper_visitor {

public $visitor_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $visitor_identity_validation = array('required','string','max'=>250,'min'=>1);

public $columns = array('visitor_id','visitor_identity');

public $visitor_id;

public $visitor_identity;

public $insert_sql_statement;

public $update_sql_statement;

}?>

