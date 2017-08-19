<?php 
namespace tFramework; 

class helper_trait{

public $table_name='trait';

public $table_alias='t12';

public $trait_id_sql='t12.trait_id';

public $trait_item_sql='t12.trait_item';

public $select_columns_sql='t12.trait_id,t12.trait_item';

public $segment_trait_join_sql=' segment_trait st11 ON(t12.trait_id=st11.trait_id_ref)';

public $insert_into_sql='INSERT INTO trait VALUES (:trait_id, :trait_item)';

public $update_base_sql='UPDATE trait SET ';

public $update_trait_id_sql='trait_id=:trait_id';

public $update_trait_item_sql='trait_item=:trait_item';

}?>