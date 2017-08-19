<div id="layout" class="pure-g">
	<div id="sidebar" class="sidebar pure-u-1 pure-u-md-1-4">
		<div id="header" class="header">
			<h1 class="brand-title">Diimo</h1>
			<h2 class="brand-tagline">Ammattilaiset vastaavat</h2>
			<nav class="nav">
				<ul class="nav-list">
					<li class="nav-item">
						<a class="pure-button" href="">PHP ohjelmointi?</a>
					</li>
					<li class="nav-item">
						<a class="pure-button" href="">Tietoja aiheesta x?</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<div id="content" class="content pure-u-1 pure-u-md-3-4">
		<div>
			<h1>Lorem ipsum</h1>
			<a
			data-tta="true" 
			data-ttal="Testing PP"
			href="http://<?php echo HOST;; ?>/product/test/testing">Testing</a>
			<a href="http://<?php echo HOST;; ?>">Main homepage</a>
			<?php if(isset($_GET['r'])){echo $_GET['r'];}?>
			<?php if(isset($_GET['d'])){echo $_GET['d'];}?>
			<br/>
			<br/>
			<table class="pure-table">
			<thead>
        	<tr>
            	<th>Product id</th>
           	 	<th>Name</th>
           	 	<th>Price</th>
           	 	<th>Type</th>
        	</tr>
    		</thead>
    		<tbody>
			<?php 
			
				foreach($this->af->products as $product){
					echo "<tr>";
					echo "<td>".$product['product_id']."</td>";
					echo "<td>".$product['product_name']."</td>";
					echo "<td>".$product['price']."</td>";
					echo "<td>".$product['product_category_name']."</td>";
					echo "</tr>";
				}
			
			?>
			</tbody>
			</table>
		</div>
	</div>
</div>