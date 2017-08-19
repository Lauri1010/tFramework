<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_content.php'; 

class model_content extends helper_content {

public $content_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $page_id_ref_validation = array('required','intiger','max'=>20,'min'=>1);

public $content_type_validation = array('required','string','max'=>250,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $content_id;

public $page_id_ref;

public $content_type;

public $columns = array('content_id','page_id_ref','content_type');

}?>