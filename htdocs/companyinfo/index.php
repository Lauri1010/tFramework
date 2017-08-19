<?php

require 'C:/nginx/framework/main.php';
require 'C:/nginx/framework/topCache.php';

// 1. get data from database. The fact that index.php exists means that this is not a static page
// 2. Note that if the index.html is releted by a update process there has been an update. 

$html="<!DOCTYPE html>
<html>
<body>

<h1>Hello</h1><p>";
foreach($rs as $value){
	$html.=" ".$value['product_name'];
}
$html.="</p><p>Company info</p>

</body>
</html>";

require 'C:/nginx/framework/bottomCache.php';


?>