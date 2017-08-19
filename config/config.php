<?php
namespace tFramework;

$host=$_SERVER['SERVER_NAME'];

define('HOST',$host);

if($host=='localhost'){
	define ('DEVELOPMENT_ENVIRONMENT',true);
}else{
	define ('DEVELOPMENT_ENVIRONMENT',false);
}

if(DEVELOPMENT_ENVIRONMENT){
	define("DB_HOST", "localhost:3307");
	define("DB_USER", "root");
	define("DB_PASS", "password");
	define("DB_NAME", "products_database");
}else{
	define("DB_HOST", "localhost");
	define("DB_USER", "diimofi_main");
	define("DB_PASS", "aS=.&la%MU&C");
	define("DB_NAME", "diimofi_products_database");
	
}

define('BASE_PATH','http://'.$host.'/');

define('CSS','css/');

define('JS','js/');

define('PAGINATE_LIMIT', '5');

define('DEFAULT_LANGUAGE', 'en');

define('SHOST',$_SERVER['HTTP_HOST']);

define('SERVERNAME',$_SERVER['SERVER_NAME']);

// define('timezone','Europe/Helsinki');

date_default_timezone_set('Europe/Helsinki');



?>