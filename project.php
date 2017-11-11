<?php 
namespace tFramework;

$webapp=false;
if(isset($projectName)){
$overWriteSite=$projectName;
require 'bootstrap.php';
define('DEVELOPMENT_ENVIRONMENT',true);
define('FRPATHAT',FRPATH.DS.'archtypes'.DS);
define('FRPATHATCF',FRPATHAT.DS.'config'.DS);
define('FRPATHATDB',FRPATHAT.DS.'database'.DS);
define('FRPATHATLG',FRPATHAT.DS.'logic'.DS);
define('FRPATHATPS',FRPATHAT.DS.'paths'.DS);
define('FRPATHATVS',FRPATHAT.DS.'views'.DS);
define('FRPATHATWEB',FRPATHAT.DS.'web'.DS);

require FRPATHAT.'generate.php';
// generateHelpers($datatabaseName,true);
// generateHelpers($datatabaseName,true,true);
}else{
	trigger_error("Dbname has to be defined", E_USER_ERROR);
}
