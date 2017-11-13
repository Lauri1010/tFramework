<?php
namespace tFramework;
if(appdata::get('fReq')){
$title = "Test";
$metad = "Test";
require SNIPPLETS . 'head.php';
}
require SNIPPLETS.'menu.php';
?>
<div id="main">
	<div class="header">
		<h1>Hello world</h1>
		<h2></h2>
	</div>
	<div class="content">
		<a href="http://localhost/data">Next page</a>
	</div>
</div>
<?php
if(appdata::get('fReq')){require SNIPPLETS.'bottom.php';}