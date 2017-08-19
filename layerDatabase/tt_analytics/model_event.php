<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_event.php'; 

class model_event extends helper_event {

public $interesting_event_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $active_validation = array('required','intiger','max'=>3,'min'=>1);

public $page_id_ref_validation = array('required','intiger','max'=>20,'min'=>1);

public $event_description_validation = array('required','string','max'=>150,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $interesting_event_id;

public $active;

public $page_id_ref;

public $event_description;

public $columns = array('interesting_event_id','active','page_id_ref','event_description');

}?>