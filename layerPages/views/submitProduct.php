<?php 
namespace tFramework;

$title = "Diimo";
$metad = "Diimo";
require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'views'.DS.'snipplets'.DS.'headInlinePure.php';

?>
<div class="pure-u-1-5"></div>
<div class="pure-u-3-5">
<h1>Submit a product</h1>
<div><?php $this->af->processSubmit('product'); ?></div>
<form enctype="multipart/form-data" class="pure-form pure-form-stacked" action="" method="POST">
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
echo $this->af->dropDown('product','product_type_ref','product_type','product_type_id','product_type_description');
?>
<label>Product store ref</label>
<?php 
echo $this->af->dropDown('product','product_store_ref','store','store_id','store_name');
?>
<label>Image url</label>
<?php 
echo $this->af->textArea('product','image_url');
?>
<br/><br/>
<button type="submit" class="pure-button pure-button-primary">Submit</button>
</form>
</div>
<?php 
require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'views'.DS.'snipplets'.DS.'footer.php';
require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'views'.DS.'snipplets'.DS.'bottom.php';
?>

