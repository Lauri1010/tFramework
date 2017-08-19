<?php 
namespace tFramework; 

class helper_segment{

public $table_name='segment';

public $table_alias='s10';

public $segment_id_sql='s10.segment_id';

public $segment_description_sql='s10.segment_description';

public $select_columns_sql='s10.segment_id,s10.segment_description';

public $hit_join_sql=' hit h7 ON(s10.segment_id=h7.hit_segment_id_ref)';
public $segment_trait_join_sql=' segment_trait st11 ON(s10.segment_id=st11.segment_id_ref)';

public $insert_into_sql='INSERT INTO segment VALUES (:segment_id, :segment_description)';

public $update_base_sql='UPDATE segment SET ';

public $update_segment_id_sql='segment_id=:segment_id';

public $update_segment_description_sql='segment_description=:segment_description';

}?>