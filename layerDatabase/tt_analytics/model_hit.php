<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_hit.php'; 

class model_hit extends helper_hit {

public $hit_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $hit_account_id_ref_validation = array('required','intiger','max'=>20,'min'=>1);

public $visit_identity_validation = array('required','string','max'=>250,'min'=>1);

public $visitor_identity_validation = array('required','string','max'=>250,'min'=>1);

public $hit_segment_id_ref_validation = array('intiger','max'=>20,'min'=>1);

public $page_id_ref_validation = array('required','intiger','max'=>20,'min'=>1);

public $request_ip_validation = array('string','max'=>50,'min'=>1);

public $browser_type_validation = array('string','max'=>50,'min'=>1);

public $browser_version_validation = array('string','max'=>25,'min'=>1);

public $is_mobile_validation = array('intiger','max'=>3,'min'=>1);

public $is_tablet_validation = array('intiger','max'=>3,'min'=>1);

public $domain_validation = array('string','max'=>50,'min'=>1);

public $trust_level_validation = array('required','intiger','max'=>3,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $hit_id;

public $hit_account_id_ref;

public $visit_identity;

public $visitor_identity;

public $hit_segment_id_ref;

public $page_id_ref;

public $request_ip;

public $browser_type;

public $browser_version;

public $is_mobile;

public $is_tablet;

public $domain;

public $trust_level;

public $columns = array('hit_id','hit_account_id_ref','visit_identity','visitor_identity','hit_segment_id_ref','page_id_ref','request_ip','browser_type','browser_version','is_mobile','is_tablet','domain','trust_level');

}?>