<?php 
namespace tFramework; 

class helper_segment_trait{

public $table_name='segment_trait';

public $table_alias='st11';

public $segment_trait_id_sql='st11.segment_trait_id';

public $segment_id_ref_sql='st11.segment_id_ref';

public $trait_id_ref_sql='st11.trait_id_ref';

public $select_columns_sql='st11.segment_trait_id,st11.segment_id_ref,st11.trait_id_ref';

public $segment_join_sql=' segment s10 ON(st11.segment_id_ref=s10.segment_id)';
public $trait_join_sql=' trait t12 ON(st11.trait_id_ref=t12.trait_id)';

public $insert_into_sql='INSERT INTO segment_trait VALUES (:segment_trait_id, :segment_id_ref, :trait_id_ref)';

public $update_base_sql='UPDATE segment_trait SET ';

public $update_segment_trait_id_sql='segment_trait_id=:segment_trait_id';

public $update_segment_id_ref_sql='segment_id_ref=:segment_id_ref';

public $update_trait_id_ref_sql='trait_id_ref=:trait_id_ref';

}?>