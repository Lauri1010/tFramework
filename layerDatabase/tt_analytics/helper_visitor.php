<?php 
namespace tFramework; 

class helper_visitor{

public $table_name='visitor';

public $table_alias='v14';

public $visitor_id_sql='v14.visitor_id';

public $visitor_identity_sql='v14.visitor_identity';

public $select_columns_sql='v14.visitor_id,v14.visitor_identity';

public $visit_join_sql=' visit v13 ON(v14.visitor_id=v13.visitor_id_ref)';

public $insert_into_sql='INSERT INTO visitor VALUES (:visitor_id, :visitor_identity)';

public $update_base_sql='UPDATE visitor SET ';

public $update_visitor_id_sql='visitor_id=:visitor_id';

public $update_visitor_identity_sql='visitor_identity=:visitor_identity';

}?>