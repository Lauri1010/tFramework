<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_event_type.php'; 

class model_event_type extends helper_event_type {

public $event_type_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $event_type_description_validation = array('required','string','max'=>250,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $event_type_id;

public $event_type_description;

public $columns = array('event_type_id','event_type_description');

}?>