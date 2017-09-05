<?php
namespace tFramework;

$url=$_SERVER['REQUEST_URI'];
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('BWEB', 'htdocs');
define('FRFOLDER','framework');
define('SITE','products');
define('SITES',ROOT.DS.BWEB.DS.'sites');
define('SITESP',SITES.DS.SITE.DS.'protected');

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
	
	require SITESP.DS.'views'.DS.'snipplets'.DS.'headPureBlog.php';

	echo "<body> 
	<div id=\"mContainer\">
	</div>";
	
	require SITESP.DS.'views'.DS.'snipplets'.DS.'footer.php';
	require SITESP.DS.'views'.DS.'snipplets'.DS.'bottom.php';
	
	
}
