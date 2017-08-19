<?php
namespace tFramework;

$url=$_SERVER['REQUEST_URI'];
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('FRFOLDER','framework');

require ROOT.DS.FRFOLDER.DS.'lib'.DS.'bootstrap.php';

/**
 * This only occurs when the full application is called
 * 
 * */

if(isset($_GET['p'])){

	$pRequest=$_GET['p'];	
	
	require ROOT.DS.FRFOLDER.DS.'vendor'.DS.'autoload.php';
	// use chep
	// request the correct controller
	require_once ROOT.DS.FRFOLDER.DS.'requestDispatchers'.DS.'baseDispatcher.php';

	
	

}else{

	$title = "Diimo";
	
	$metad = "Diimo";
	
	require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'views'.DS.'snipplets'.DS.'headPureBlog.php';

	echo "<body> 
	<div id=\"mContainer\">
	</div>";
	
	require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'views'.DS.'snipplets'.DS.'footer.php';
	require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'views'.DS.'snipplets'.DS.'bottom.php';
	
	
}
