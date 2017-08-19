<?php 
namespace tFramework; 

class helper_hit_flow{

public $table_name='hit_flow';

public $table_alias='hf8';

public $flow_id_sql='hf8.flow_id';

public $previous_page_id_ref_sql='hf8.previous_page_id_ref';

public $select_columns_sql='hf8.flow_id,hf8.previous_page_id_ref';

public $hit_page_join_sql=' hit_page hp9 ON(hf8.previous_page_id_ref=hp9.page_id)';

public $insert_into_sql='INSERT INTO hit_flow VALUES (:flow_id, :previous_page_id_ref)';

public $update_base_sql='UPDATE hit_flow SET ';

public $update_flow_id_sql='flow_id=:flow_id';

public $update_previous_page_id_ref_sql='previous_page_id_ref=:previous_page_id_ref';

}?>