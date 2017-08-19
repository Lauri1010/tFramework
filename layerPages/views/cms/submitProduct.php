<?php 
namespace tFramework;

?>
<div class="pure-u-1-5"></div>
<div class="pure-u-3-5">
<h1>Submit a product</h1>
<div><?php $this->af->processSubmit('product','update','product_id','2'); ?>
<?php // $this->af->processSubmit('product','create'); ?></div>
<form enctype="multipart/form-data" class="pure-form pure-form-stacked" method="POST">
<label>Product name</label>
<?php 
echo $this->af->inputField('product','product_name');
?>
<label>Product price</label>
<?php 
echo $this->af->inputField('product','price');
?>
<label>Product discount price</label>
<?php 
echo $this->af->inputField('product','discount_price');
?>
<label>Product type</label>
<?php 
echo $this->af->dropDown('product','product_category_id_ref','product_category','product_category_id','product_category_name');
?>
<label>Product store ref</label>
<?php 
echo $this->af->dropDown('product','product_store_id_ref','store','store_id','store_name');
?>
<label>Image url</label>
<?php 
echo $this->af->textArea('product','image_url');
?>
<label>Is to be removed</label>
<?php 
echo $this->af->checkBox('product','to_be_removed');
?>
<br/><br/>
<input type="submit" class="pure-button pure-button-primary" value="Submit">
</form>
</div>