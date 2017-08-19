<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_interesting_event.php'; 

class model_interesting_event extends helper_interesting_event {

public $interesting_event_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $active_validation = array('required','intiger','max'=>3,'min'=>1);

public $event_description_validation = array('required','string','max'=>150,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $interesting_event_id;

public $active;

public $event_description;

public $columns = array('interesting_event_id','active','event_description');

}?>