<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_segment_trait.php'; 

class model_segment_trait extends helper_segment_trait {

public $segment_trait_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $segment_id_ref_validation = array('required','intiger','max'=>20,'min'=>1);

public $trait_id_ref_validation = array('required','intiger','max'=>20,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $segment_trait_id;

public $segment_id_ref;

public $trait_id_ref;

public $columns = array('segment_trait_id','segment_id_ref','trait_id_ref');

}?>