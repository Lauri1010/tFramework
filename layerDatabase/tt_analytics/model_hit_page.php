<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_hit_page.php'; 

class model_hit_page extends helper_hit_page {

public $page_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $page_title_validation = array('required','string','max'=>100,'min'=>1);

public $page_url_validation = array('required','string','max'=>250,'min'=>1);

public $page_meta_description_validation = array('string','max'=>250,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $page_id;

public $page_title;

public $page_url;

public $page_meta_description;

public $columns = array('page_id','page_title','page_url','page_meta_description');

}?>