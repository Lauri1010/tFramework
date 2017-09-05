<?php
namespace tFramework;
require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'baseview'.DS.'getHtmElements.php';
generateHead('One page app');
?>
<div class="pure-g">
    <div class="pure-u-1-3">
    </div>
    <div class="pure-u-1-3">
    <h2>Products</h2>
    <form id="dataSearchForm" class="pure-form" data-model="product" >
    	<input type="text" name="product_name" data-cinput="product:product_name">
    	<button type="submit" class="pure-button pure-button-primary sbutton" >Search</button>
    </form>
    <br/>
    <div class="dataTableContainer">
	    <table class="pure-table dataTable" data-model="product,store,store_type" data-page="1" data-items="10">
	    	<thead>
	    		<tr>
            		<th>Product Id</th>
           	 		<th>Product name</th>
            		<th>Price</th>
            		<th>Store name</th>
            		<th>Store type name</th>
        		</tr>
    		</thead>
	    	<tr>
		    	<td data-column="product:product_id"></td>
		    	<td data-column="product:product_name"></td>
		    	<td data-column="product:price"></td>
		    	<td data-column="store:store_name"></td>
		    	<td data-column="store_type:store_type_name"></td>
	    	</tr>
	    </table>
    </div>
    </div>
    <div class="pure-u-1-3"></div>
</div>
<?php
generateBottom();
?>