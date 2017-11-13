<?php 
namespace tFramework; 

class helper_product{

public $table_name='product';

public $table_alias='p0';

public $product_id_sql='p0.product_id';

public $product_category_id_ref_sql='p0.product_category_id_ref';

public $product_store_id_ref_sql='p0.product_store_id_ref';

public $product_vendor_id_ref_sql='p0.product_vendor_id_ref';

public $product_name_sql='p0.product_name';

public $price_sql='p0.price';

public $discount_price_sql='p0.discount_price';

public $image_url_sql='p0.image_url';

public $to_be_removed_sql='p0.to_be_removed';

public $brand_sql='p0.brand';

public $message_sql='p0.message';

public $inventory_sql='p0.inventory';

public $select_columns_sql='p0.product_id,p0.product_category_id_ref,p0.product_store_id_ref,p0.product_vendor_id_ref,p0.product_name,p0.price,p0.discount_price,p0.image_url,p0.to_be_removed,p0.brand,p0.message,p0.inventory';

public $product_category_join_sql=' product_category pc1 ON(p0.product_category_id_ref=pc1.product_category_id)';
public $product_vendor_join_sql=' product_vendor pv2 ON(p0.product_vendor_id_ref=pv2.vendor_id)';
public $store_join_sql=' store s5 ON(p0.product_store_id_ref=s5.store_id)';

public $insert_into_sql='INSERT INTO product VALUES (:product_id, :product_category_id_ref, :product_store_id_ref, :product_vendor_id_ref, :product_name, :price, :discount_price, :image_url, :to_be_removed, :brand, :message, :inventory)';

public $update_base_sql='UPDATE product SET ';

public $update_product_id_sql='product_id=:product_id';

public $update_product_category_id_ref_sql='product_category_id_ref=:product_category_id_ref';

public $update_product_store_id_ref_sql='product_store_id_ref=:product_store_id_ref';

public $update_product_vendor_id_ref_sql='product_vendor_id_ref=:product_vendor_id_ref';

public $update_product_name_sql='product_name=:product_name';

public $update_price_sql='price=:price';

public $update_discount_price_sql='discount_price=:discount_price';

public $update_image_url_sql='image_url=:image_url';

public $update_to_be_removed_sql='to_be_removed=:to_be_removed';

public $update_brand_sql='brand=:brand';

public $update_message_sql='message=:message';

public $update_inventory_sql='inventory=:inventory';

}?>