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

require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'generate.php';

// generateHelpers($datatabaseName,true);
// generateHelpers($datatabaseName,true,true);
generateHelpersAndModelsAndSqlService(true,true,true);

?>