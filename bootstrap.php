<?php
namespace tFramework;
/**
 * Defining global configuration settings.
 * Editing discouraged
 * @author Lauri Turunen
 */
date_default_timezone_set('Europe/Helsinki');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('BWEB', 'htdocs');
define('FRFOLDER','framework');
define('SITES','sites');
if(isset($overWriteSite)){
	if(is_string($overWriteSite)){
		define('SITE',$overWriteSite);
	}
}else{
	define('SITE','products');
}
define('APPSNAME','apps');
define('APPROOT',ROOT.DS.APPSNAME);
define('APPFOLDER',APPROOT.DS.SITE.DS);
define('FRPATH',ROOT.DS.FRFOLDER.DS);
define('FRPATHDB',FRPATH.'layerDatabase');
define('SITEPATH',SITES.DS.SITE);
define('BASEVIEW',APPFOLDER.'baseview'.DS);
define('CFFOLDER',APPFOLDER.'config'.DS);
define('LGFOLDER',APPFOLDER.'logic'.DS);
define('DBFOLDER',APPFOLDER.'database'.DS);
define('PATHSFOLDER',APPFOLDER.'paths'.DS);
define('VIEWSFOLDER',APPFOLDER.'views'.DS);
define('TEMPLATES',VIEWSFOLDER.DS.'templates'.DS);
define('SNIPPLETS',VIEWSFOLDER.DS.'snipplets'.DS);
define('CMS',VIEWSFOLDER.DS.'cms'.DS);
if($webapp){
	define('WDS','/');
	require FRPATH.'lib'.DS.'shared.php';
	if(isset($host)){
		define('HOST',$host);
		define('BASE_PATH',PROTOCOL.$host.WDS);
		define('SITEBASE',PROTOCOL.$host.WDS.SITES.WDS);
		define('jsFolder',SITEBASE.SITE.WDS.'js'.WDS);
		define('cssFolder',SITEBASE.SITE.WDS.'css'.WDS);
		define('imgFolder',SITEBASE.SITE.WDS.'img'.WDS);
		define('fontFolder',SITEBASE.SITE.WDS.'fonts'.WDS);
		
	}
	if(isset($_GET['p']) && isset($_GET['a'])){
		$pRequest=$_GET['p'];
		appdata::set('fReq', false);
	}else{
		appdata::set('fReq', true);
	}
	define('CSS','css/');
	define('JS','js/');
	define('PAGINATE_LIMIT', '5');
	define('DEFAULT_LANGUAGE', 'en');
	if(is_dir(CFFOLDER)){
		require CFFOLDER.'config.php';
		config::init();
		define('DB_NAME',config::getConf('dbName'));
	}
}else if(isset($console)){
	
	if($console){
		if(is_dir(CFFOLDER)){
			require CFFOLDER.'config.php';
			config::init();
			define('DB_NAME',config::getConf('dbName'));
		}
	}

}

