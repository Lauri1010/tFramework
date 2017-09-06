<?php 
namespace tFramework; 

class helper_product_vendor_financials{

public $table_name='product_vendor_financials';

public $table_alias='pvf4';

public $product_vendor_financials_id_sql='pvf4.product_vendor_financials_id';

public $balance_sql='pvf4.balance';

public $product_vendor_id_ref_sql='pvf4.product_vendor_id_ref';

public $select_columns_sql='pvf4.product_vendor_financials_id,pvf4.balance,pvf4.product_vendor_id_ref';

public $product_vendor_join_sql=' product_vendor pv2 ON(pvf4.product_vendor_id_ref=pv2.vendor_id)';

public $insert_into_sql='INSERT INTO product_vendor_financials VALUES (:product_vendor_financials_id, :balance, :product_vendor_id_ref)';

public $update_base_sql='UPDATE product_vendor_financials SET ';

public $update_product_vendor_financials_id_sql='product_vendor_financials_id=:product_vendor_financials_id';

public $update_balance_sql='balance=:balance';

public $update_product_vendor_id_ref_sql='product_vendor_id_ref=:product_vendor_id_ref';

}?>