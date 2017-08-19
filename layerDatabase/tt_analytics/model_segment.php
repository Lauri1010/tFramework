<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_segment.php'; 

class model_segment extends helper_segment {

public $segment_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $segment_description_validation = array('string','max'=>250,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $segment_id;

public $segment_description;

public $columns = array('segment_id','segment_description');

}?>