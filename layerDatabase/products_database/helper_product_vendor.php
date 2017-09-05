<?php 
namespace tFramework; 

class helper_product_vendor{

public $table_name='product_vendor';

public $table_alias='pv2';

public $vendor_id_sql='pv2.vendor_id';

public $vendor_name_sql='pv2.vendor_name';

public $select_columns_sql='pv2.vendor_id,pv2.vendor_name';

public $product_join_sql=' product p0 ON(pv2.vendor_id=p0.product_vendor_id_ref)';
public $product_vendor_financials_join_sql=' product_vendor_financials pvf3 ON(pv2.vendor_id=pvf3.product_vendor_id_ref)';

public $insert_into_sql='INSERT INTO product_vendor VALUES (:vendor_id, :vendor_name)';

public $update_base_sql='UPDATE product_vendor SET ';

public $update_vendor_id_sql='vendor_id=:vendor_id';

public $update_vendor_name_sql='vendor_name=:vendor_name';

}?>