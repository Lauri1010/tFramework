<?php 
namespace tFramework; 

require DBFOLDER.'helper_product.php'; 

class schema_product extends helper_product{

public $product_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $product_category_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $product_store_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $product_vendor_id_ref_validation = array('intiger','max'=>10,'min'=>1);

public $product_name_validation = array('string','max'=>150,'min'=>1);

public $price_validation = array('decimal','max'=>7,'min'=>1,'decmials'=>2);

public $discount_price_validation = array('decimal','max'=>7,'min'=>1,'decmials'=>2);

public $image_url_validation = array('string','max'=>150,'min'=>1);

public $to_be_removed_validation = array('intiger','max'=>3,'min'=>1);

public $brand_validation = array('string','max'=>50,'min'=>1);

public $message_validation = array('string','max'=>150,'min'=>1);

public $inventory_validation = array('required','intiger','max'=>10,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $product_id;

public $product_category_id_ref;

public $product_store_id_ref;

public $product_vendor_id_ref;

public $product_name;

public $price;

public $discount_price;

public $image_url;

public $to_be_removed;

public $brand;

public $message;

public $inventory;

public $columns = array('product_id','product_category_id_ref','product_store_id_ref','product_vendor_id_ref','product_name','price','discount_price','image_url','to_be_removed','brand','message','inventory');

}?>