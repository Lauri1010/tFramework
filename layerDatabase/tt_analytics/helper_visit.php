<?php 
namespace tFramework; 

class helper_visit{

public $table_name='visit';

public $table_alias='v13';

public $visit_id_sql='v13.visit_id';

public $visitor_id_ref_sql='v13.visitor_id_ref';

public $select_columns_sql='v13.visit_id,v13.visitor_id_ref';

public $hit_join_sql=' hit h8 ON(v13.visit_id=h8.visitor_id_ref)';
public $visitor_join_sql=' visitor v14 ON(v13.visitor_id_ref=v14.visitor_id)';

public $insert_into_sql='INSERT INTO visit VALUES (:visit_id, :visitor_id_ref)';

public $update_base_sql='UPDATE visit SET ';

public $update_visit_id_sql='visit_id=:visit_id';

public $update_visitor_id_ref_sql='visitor_id_ref=:visitor_id_ref';

}?>