<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_raw_click_data.php'; 

class model_raw_click_data extends helper_raw_click_data {

public $click_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $interesting_event_ref_validation = array('intiger','max'=>20,'min'=>1);

public $hit_id_ref_validation = array('required','intiger','max'=>20,'min'=>1);

public $click_html_classes_validation = array('string','max'=>100,'min'=>1);

public $click_html_id_validation = array('string','max'=>100,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $click_id;

public $interesting_event_ref;

public $hit_id_ref;

public $click_html_classes;

public $click_html_id;

public $columns = array('click_id','interesting_event_ref','hit_id_ref','click_html_classes','click_html_id');

}?>