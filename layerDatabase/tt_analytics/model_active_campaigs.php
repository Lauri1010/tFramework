<?php 
namespace tFramework; 

require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_active_campaigs.php'; 

class model_active_campaigs extends helper_active_campaigs{

public $campaign_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $segment_if_ref_validation = array('required','intiger','max'=>20,'min'=>1);

public $page_id_ref_validation = array('intiger','max'=>20,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $campaign_id;

public $segment_if_ref;

public $page_id_ref;

public $columns = array('campaign_id','segment_if_ref','page_id_ref');

}?>