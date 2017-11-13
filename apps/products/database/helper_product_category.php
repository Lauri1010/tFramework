<?php 
namespace tFramework; 

class helper_product_category{

public $table_name='product_category';

public $table_alias='pc1';

public $product_category_id_sql='pc1.product_category_id';

public $product_category_name_sql='pc1.product_category_name';

public $select_columns_sql='pc1.product_category_id,pc1.product_category_name';

public $product_join_sql=' product p0 ON(pc1.product_category_id=p0.product_category_id_ref)';

public $insert_into_sql='INSERT INTO product_category VALUES (:product_category_id, :product_category_name)';

public $update_base_sql='UPDATE product_category SET ';

public $update_product_category_id_sql='product_category_id=:product_category_id';

public $update_product_category_name_sql='product_category_name=:product_category_name';

}?>