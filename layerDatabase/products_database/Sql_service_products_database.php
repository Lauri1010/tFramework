<?php 
namespace tFramework;

require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'Sql_service_base.php';

class Sql_service_products_database extends Sql_service_base{

protected $product;

protected $product_category;

protected $store;

protected $user;

public function get_product_model_value($value){

if(!isset($this->product)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'products_database'.DS.'model_product.php';
$this->product=new model_product();
}

return $this->product->$value;
}

public function get_product_category_model_value($value){

if(!isset($this->product_category)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'products_database'.DS.'model_product_category.php';
$this->product_category=new model_product_category();
}

return $this->product_category->$value;
}

public function get_store_model_value($value){

if(!isset($this->store)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'products_database'.DS.'model_store.php';
$this->store=new model_store();
}

return $this->store->$value;
}

public function get_user_model_value($value){

if(!isset($this->user)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'products_database'.DS.'model_user.php';
$this->user=new model_user();
}

return $this->user->$value;
}

public function set_product($column_name,$column_value){

if(!isset($this->product)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'products_database'.DS.'model_product.php';
$this->product=new model_product();
}

$this->product->$column_name=$column_value;
}

public function set_product_category($column_name,$column_value){

if(!isset($this->product_category)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'products_database'.DS.'model_product_category.php';
$this->product_category=new model_product_category();
}

$this->product_category->$column_name=$column_value;
}

public function set_store($column_name,$column_value){

if(!isset($this->store)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'products_database'.DS.'model_store.php';
$this->store=new model_store();
}

$this->store->$column_name=$column_value;
}

public function set_user($column_name,$column_value){

if(!isset($this->user)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'products_database'.DS.'model_user.php';
$this->user=new model_user();
}

$this->user->$column_name=$column_value;
}

}

?>