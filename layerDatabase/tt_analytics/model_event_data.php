<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_event_data.php'; 

class model_event_data extends helper_event_data {

public $click_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $event_id_ref_validation = array('intiger','max'=>20,'min'=>1);

public $event_type_id_ref_validation = array('required','intiger','max'=>20,'min'=>1);

public $html_classes_validation = array('string','max'=>100,'min'=>1);

public $html_id_validation = array('string','max'=>100,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $click_id;

public $event_id_ref;

public $event_type_id_ref;

public $html_classes;

public $html_id;

public $columns = array('click_id','event_id_ref','event_type_id_ref','html_classes','html_id');

}?>