<?php
namespace tFramework;

/**
 * You can set your config variables here
 *
 */
class config {
	
	static private $conf = array(
			'snipplets'=>SNIPPLETS
	);
	
	static function init(){
		
		if(DEVELOPMENT_ENVIRONMENT){
			self::$conf['dbHost']='';
			self::$conf['dbUser']='';
			self::$conf['dbPass']='';
			self::$conf['dbName']='';
		}else{
			self::$conf['dbHost']='';
			self::$conf['dbUser']='';
			self::$conf['dbPass']='';
			self::$conf['dbName']='';
		}
		
	}

	static function getConf($index) {
		return self::$conf[$index];
	}
	

}
?>