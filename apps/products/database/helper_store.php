<?php 
namespace tFramework; 

class helper_store{

public $table_name='store';

public $table_alias='s5';

public $store_id_sql='s5.store_id';

public $store_name_sql='s5.store_name';

public $select_columns_sql='s5.store_id,s5.store_name';

public $product_join_sql=' product p0 ON(s5.store_id=p0.product_store_id_ref)';

public $insert_into_sql='INSERT INTO store VALUES (:store_id, :store_name)';

public $update_base_sql='UPDATE store SET ';

public $update_store_id_sql='store_id=:store_id';

public $update_store_name_sql='store_name=:store_name';

}?>