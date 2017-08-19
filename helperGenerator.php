<?php
namespace tFramework;
$url=$_SERVER['REQUEST_URI'];
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('FRFOLDER','framework');


require ROOT.DS.FRFOLDER.DS.'lib'.DS.'bootstrap.php';

require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'generate.php';

// generateHelpers($datatabaseName,true);
// generateHelpers($datatabaseName,true,true);
generateHelpersAndModelsAndSqlService(true,true,true);

?>