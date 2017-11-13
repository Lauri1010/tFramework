<?php
namespace tFramework;
$webapp=true;
$url=$_SERVER['REQUEST_URI'];
$host=$_SERVER['SERVER_NAME'];
if($host=='localhost'){
	define ('DEVELOPMENT_ENVIRONMENT',true);
	define('PROTOCOL','http://');
}else{
	define ('DEVELOPMENT_ENVIRONMENT',false);
	define('PROTOCOL','https://');
}
define('SHOST',$_SERVER['HTTP_HOST']);
define('SERVERNAME',$_SERVER['SERVER_NAME']);
require 'bootstrap.php';
require FRPATH.'vendor'.DS.'autoload.php';
require FRPATH.'requestDispatchers'.DS.'baseDispatcher.php';
