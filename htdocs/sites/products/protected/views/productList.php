<?php 
namespace tFramework;
require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'baseview'.DS.'getHtmElements.php';
generateHead('Submit a product');
?>
<div class="pure-u-1-5"></div>
<div class="pure-u-3-5">
<h1>Product List</h1>
<table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>Product name</th>
            <th>Price</th>
            <th>Store type</th>
            <th>Desc</th>
        </tr>
    </thead>

    <tbody>
    	<?php 
		foreach($data as $product){
			
			$productName=$product['product_name'];
			$price=$product['price'];
			$storeTypeName=$product['store_type_name'];
			$productTypeDescription=$product['product_type_description'];

			echo "<tr>
			 <td>$productName</td>
			 <td>$price</td>
			 <td>$storeTypeName</td>
			 <td>$productTypeDescription</td>
			 </tr>";
			
	
		}



		?>
    </tbody>
</table>
</div>
<div class="pure-u-1-5">
<?php 
generateBottom();
?>
</div>