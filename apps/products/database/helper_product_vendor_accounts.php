<?php 
namespace tFramework; 

class helper_product_vendor_accounts{

public $table_name='product_vendor_accounts';

public $table_alias='pva3';

public $account_id_sql='pva3.account_id';

public $account_name_sql='pva3.account_name';

public $product_vendor_id_ref_sql='pva3.product_vendor_id_ref';

public $select_columns_sql='pva3.account_id,pva3.account_name,pva3.product_vendor_id_ref';

public $product_vendor_join_sql=' product_vendor pv2 ON(pva3.product_vendor_id_ref=pv2.vendor_id)';

public $insert_into_sql='INSERT INTO product_vendor_accounts VALUES (:account_id, :account_name, :product_vendor_id_ref)';

public $update_base_sql='UPDATE product_vendor_accounts SET ';

public $update_account_id_sql='account_id=:account_id';

public $update_account_name_sql='account_name=:account_name';

public $update_product_vendor_id_ref_sql='product_vendor_id_ref=:product_vendor_id_ref';

}?>