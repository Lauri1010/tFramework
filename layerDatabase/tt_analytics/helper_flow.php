<?php 
namespace tFramework; 

class helper_flow{

public $table_name='flow';

public $table_alias='f7';

public $flow_id_sql='f7.flow_id';

public $previous_page_id_ref_sql='f7.previous_page_id_ref';

public $select_columns_sql='f7.flow_id,f7.previous_page_id_ref';

public $hit_page_join_sql=' hit_page hp9 ON(f7.previous_page_id_ref=hp9.page_id)';

public $insert_into_sql='INSERT INTO flow VALUES (:flow_id, :previous_page_id_ref)';

public $update_base_sql='UPDATE flow SET ';

public $update_flow_id_sql='flow_id=:flow_id';

public $update_previous_page_id_ref_sql='previous_page_id_ref=:previous_page_id_ref';

}?>